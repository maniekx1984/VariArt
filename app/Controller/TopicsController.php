<?php
App::uses('AppController', 'Controller');
/**
 * ForumTopics Controller
 *
 * @property ForumTopic $ForumTopic
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class TopicsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index','view');
    }
/**
 * index method
 *
 * @return void
 */
	/*public function index() {
		$this->Topic->recursive = 0;
		$this->set('topics', $this->Paginator->paginate());
	}*/
	
	public function index($forumId = null) {
        if (!$this->Topic->Forum->exists($forumId)) {
            throw new NotFoundException(__('Invalid forum'));
        }
        $forum = $this->Topic->Forum->read(null, $forumId);
        $this->set('forum', $forum);
        $this->Paginator->settings['contain'] = array('User', 'Post' => array('User'));
		$this->Paginator->settings['conditions'] = array('Topic.forum_id' => $forumId);
		$this->Paginator->settings['order'] = array('Topic.id' => 'DESC');
		//$this->Paginator->settings['order'] = array('Post.id' => 'DESC');
        $this->set('topics', $this->Paginator->paginate());
    }
	


	
	
	public function add() {
        if($this->Auth->user('id') !== NULL){
	        $forums = $this->Topic->Forum->find('list');
	        
			$this->loadModel('Post');
			
	        if ($this->request->is('post')) {
	            $this->request->data['Topic']['user_id'] = $this->Auth->user('id');
				$newPost['Post']['content'] = $this->request->data['Topic']['content'];
				$this->request->data['Topic']['content'] = "";
				$newPost['Post']['forum_id'] = $this->request->data['Topic']['forum_id'];
	            if ($this->Topic->save($this->request->data)) {
	                
	                
	                $newPost['Post']['topic_id'] = $this->Topic->id;
					$newPost['Post']['user_id'] = $this->Auth->user('id');
					$newPost['Post']['created'] = date("Y-m-d");
					
					$this->Post->create();
					$this->Post->save($newPost);
	                
					$this->redirect(array('controller' => 'forums', 'action' => 'index'));
	            }
	        }
	        $this->set('forums',$forums);
        }
    }

    public function view($id) {
        if (!$this->Topic->exists($id)) {
            throw new NotFoundException(__('Invalid topic'));
        }
        $topic = $this->Topic->read(null,$id);
        $forum = $this->Topic->Forum->read(null,$topic['Topic']['forum_id']);
        
        
        $options = array('conditions' => array('Post.topic_id'=>$topic['Topic']['id']), 'order' => array('Post.id'=>'asc'), 'order' => array('Post.id'=>'asc'));
		$posts = $this->Topic->Post->find('all', $options);
        
        $this->set('topic', $topic);
        $this->set('forum', $forum);
		$this->set('posts', $posts);
        
    }
	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Topic->exists($id)) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Topic->save($this->request->data)) {
				$this->Session->setFlash(__('The forum topic has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum topic could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Topic.' . $this->Topic->primaryKey => $id));
			$this->request->data = $this->Topic->find('first', $options);
		}
		$users = $this->Topic->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Topic->id = $id;
		if (!$this->Topic->exists()) {
			throw new NotFoundException(__('Invalid forum topic'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Topic->delete()) {
			$this->Session->setFlash(__('The forum topic has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum topic could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
