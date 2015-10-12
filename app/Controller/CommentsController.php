<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CommentsController extends AppController {

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('view', 'viewFromUserId');
    }

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Comment->recursive = 0;
		$this->set('comments', $this->Paginator->paginate());
	}
	
	public function homeNewMessages() {
		$options = array('conditions' => array('Comment.gallery_id' => $this->Auth->user('id'), 'Comment.is_read' => '0', 'Comment.is_active' => '1'));
		$count = $this->Comment->find('count', $options);
		if (isset($this->params['requested'])){
			return $count;
		}
	}

//comments in user gallery (by user Id)

	public function viewFromUserId($user_id = null) {
		$this->Paginator->settings = array('conditions' => array('Comment.gallery_id' => $user_id, 'Comment.is_active' => '1'), 'limit' => 10, 'order' => array('Comment.id' => 'desc'));
		$comments = $this->Paginator->paginate('Comment');
		if (isset($this->params['requested'])){
			$this->Comment->updateAll(
			    array('Comment.is_read' => '1'),
			    array('Comment.gallery_id' => $user_id, 'Gallery.id' => $this->Auth->user('id'))
			);
			
			return $comments;
		}
	}
	

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
		$this->set('comment', $this->Comment->find('first', $options));
	}

// index by user
	public function user($user_id = null) {
		$this->Comment->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('Comment.gallery_id' => $user_id, 'Comment.is_active' => '1'), 'limit' => 10, 'order' => array('Comment.id' => 'desc'));
		
		$this->Comment->updateAll(
		    array('Comment.is_read' => '1'),
		    array('Comment.gallery_id' => $user_id, 'Gallery.id' => $this->Auth->user('id'))
		);
		$comments = $this->Paginator->paginate();
		
		$this->loadModel('User');
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $user_id));
		$user = $this->User->find('first', $options);
		
		$this->set(compact('user', 'comments'));
	}


/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post') AND !($this->Auth->user('id') == null)) {
			
			$this->loadModel('DontLikeGallery');
			$options = array('conditions' => array('DontLikeGallery.user_id' => $this->data['Comment']['gallery_id'], 'DontLikeGallery.dontlike_id' => $this->Auth->user('id')));
			if($this->DontLikeGallery->find('count', $options) == 0) {
				
				$this->Comment->create();
				if ($this->Comment->save($this->request->data)) {
					//$this->Session->setFlash(__('The comment has been saved.'));
					return $this->redirect($this->referer());
				} else {
					//$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
				}
			} else {
				return $this->redirect($this->referer());
			}
		} else {
			return $this->redirect($this->referer());
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Comment->exists($id)) {
			throw new NotFoundException(__('Invalid comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('The comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
			$this->request->data = $this->Comment->find('first', $options);
		}
		$authors = $this->Comment->Author->find('list');
		$galleries = $this->Comment->Gallery->find('list');
		$this->set(compact('authors', 'galleries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if($this->Auth->user('level') > 2) {
			
			if($this->request->allowMethod('post', 'delete')) {
				
				$options = array('conditions' => array('Comment.id' => $id));
				$fnc = $this->Comment->find('first', $options);
				$this->Comment->data = $this->data;
				$this->Comment->data['Comment']['id'] = $fnc['Comment']['id'];
				$this->Comment->data['Comment']['date'] = $fnc['Comment']['date'];
				$this->Comment->data['Comment']['time'] = $fnc['Comment']['time'];
				$this->Comment->data['Comment']['author_id'] = $fnc['Comment']['author_id'];
				$this->Comment->data['Comment']['is_read'] = $fnc['Comment']['is_read'];
				$this->Comment->data['Comment']['is_active'] = "2";
				
				if($this->Comment->save($this->Comment->data)){
					$this->User->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'COMMENT REMOVAL (USER)', 'COMMENT ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
				}
				
			}
			
		}
		return $this->redirect($this->referer());
	}

}