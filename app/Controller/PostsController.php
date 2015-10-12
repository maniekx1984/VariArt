<?php
App::uses('AppController', 'Controller');
/**
 * ForumPosts Controller
 *
 * @property ForumPost $ForumPost
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PostsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	
	
	public function add($topicId = null) {
        if($this->Auth->user('id') !== NULL){
	        if ($this->request->is('post')) {
	            $this->request->data['Post']['user_id'] = $this->Auth->user('id');
	             
	            if ($this->Post->save($this->request->data)) {
	                $this->Session->setFlash(__('Post has been created.'));
	                $this->redirect(array('controller'=>'topics', 'action' => 'view', $this->request->data['Post']['topic_id']));
	            }
	        } else {
	            if (!$this->Post->Topic->exists($topicId)) {
	                throw new NotFoundException(__('Invalid topic'));
	            }
	            $this->Post->Topic->recursive = -1;
	            $topic = $this->Post->Topic->read(null, $topicId);
	             
	            $this->Post->Forum->recursive = -1;
	            $forum = $this->Post->Forum->read(null, $topic['Topic']['forum_id']);
	            $this->set('topic', $topic);
	            $this->set('forum', $forum);
	        }
		}
    }

	public function sidePosts(){
		$lastPosts = Cache::read('lastPosts', 'veryshort');
		if (!$lastPosts) {
            $options = array('order' => array('Post.' . $this->Post->primaryKey => 'DESC'), 'limit' => '10');
			$lastPosts = $this->Post->find('all', $options);
            Cache::write('lastPosts', $lastPosts, 'veryshort');
        }
		
		if (isset($this->params['requested'])){
			return $lastPosts;
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
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The forum post has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum post could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
		$topics = $this->Post->Topic->find('list');
		$users = $this->Post->User->find('list');
		$this->set(compact('topics', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid forum post'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('The forum post has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum post could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
