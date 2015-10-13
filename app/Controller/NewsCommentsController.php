<?php
App::uses('AppController', 'Controller');
/**
 * NewsComments Controller
 *
 * @property NewsComment $NewsComment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NewsCommentsController extends AppController {


/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');
	public $helpers = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->NewsComment->recursive = 0;
		$this->set('newsComments', $this->Paginator->paginate());
	}
	
	public function homeNewMessages() {
		$options = array('conditions' => array('News.author_id' => $this->Auth->user('id'), 'NewsComment.is_read' => '0', 'NewsComment.is_active' => '1'), 'group' => array('News.id'));
		$newNewsComments = $this->NewsComment->find('all', $options);
		if (isset($this->params['requested'])){
			return $newNewsComments;
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
		if (!$this->NewsComment->exists($id)) {
			throw new NotFoundException(__('Invalid news comment'));
		}
		$options = array('conditions' => array('NewsComment.' . $this->NewsComment->primaryKey => $id));
		$this->set('newsComment', $this->NewsComment->find('first', $options));
	}
	
	
	public function viewFromNewsId($news_id = null) {
		$this->NewsComment->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('NewsComment.news_id' => $news_id, 'NewsComment.is_active' => '1'), 'limit' => 5, 'order' => array('NewsComment.id' => 'desc'));
		$newsComments = $this->Paginator->paginate('NewsComment');
		if (isset($this->params['requested'])){
			return $newsComments;
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post') AND !($this->Auth->user('id') == null)) {
			
			$this->loadModel('DontLikeGallery');
			$options = array('conditions' => array('DontLikeGallery.user_id' => $this->data['NewsComment']['news_author_id'], 'DontLikeGallery.dontlike_id' => $this->Auth->user('id')));
			if($this->DontLikeGallery->find('count', $options) == 0) {
				
				$this->NewsComment->create();
				if ($this->NewsComment->save($this->request->data)) {
					//$this->Session->setFlash(__('The news comment has been saved.'));
					return $this->redirect($this->referer());
				} else {
					//$this->Session->setFlash(__('The news comment could not be saved. Please, try again.'));
				}
			} else {
				return $this->redirect($this->referer());
			}
		}
		return $this->redirect($this->referer());
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->NewsComment->exists($id)) {
			throw new NotFoundException(__('Invalid news comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->NewsComment->save($this->request->data)) {
				$this->Session->setFlash(__('The news comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('NewsComment.' . $this->NewsComment->primaryKey => $id));
			$this->request->data = $this->NewsComment->find('first', $options);
		}
		$news = $this->NewsComment->News->find('list');
		$authors = $this->NewsComment->Author->find('list');
		$this->set(compact('news', 'authors'));
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
				
				$options = array('conditions' => array('NewsComment.id' => $id));
				$fnc = $this->NewsComment->find('first', $options);
				$this->NewsComment->data = $this->data;
				$this->NewsComment->data['NewsComment']['id'] = $fnc['NewsComment']['id'];
				$this->NewsComment->data['NewsComment']['date'] = $fnc['NewsComment']['date'];
				$this->NewsComment->data['NewsComment']['time'] = $fnc['NewsComment']['time'];
				$this->NewsComment->data['NewsComment']['author_id'] = $fnc['NewsComment']['author_id'];
				$this->NewsComment->data['NewsComment']['is_read'] = $fnc['NewsComment']['is_read'];
				$this->NewsComment->data['NewsComment']['is_active'] = "2";
				
				if($this->NewsComment->save($this->NewsComment->data)){
					$this->User->query("INSERT INTO va_register VALUES (NULL, '".$this->Auth->user('id')."', 'COMMENT REMOVAL (NEWS)', 'COMMENT ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
				}
				
			}
			
		}
		return $this->redirect($this->referer());
	}
}