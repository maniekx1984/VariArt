<?php
App::uses('AppController', 'Controller');
/**
 * Messages Controller
 *
 * @property Message $Message
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class MessagesController extends AppController {

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
	public function inbox() {
		$this->Message->recursive = 0;
		if($this->Auth->user('id') != null) {
			$this->Paginator->settings = array('conditions' => array('Message.m_to' => $this->Auth->user('id')), 'limit' => 20, 'order' => array('Message.date' => 'desc', 'Message.time' => 'desc'));
			$this->set('messages', $this->Paginator->paginate());
		}
	}
	
	public function sent() {
		$this->Message->recursive = 0;
		if($this->Auth->user('id') != null) {
			$this->Paginator->settings = array('conditions' => array('Message.m_from' => $this->Auth->user('id')), 'limit' => 20, 'order' => array('Message.date' => 'desc', 'Message.time' => 'desc'));
			$this->set('messages', $this->Paginator->paginate());
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
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		
		if($this->Auth->user('id') != null) {
			$this->Message->updateAll(
			    array('Message.is_read' => '1'),
			    array('Message.id' => $id, 'Message.m_to' => $this->Auth->user('id'))
			);
			
			//$this->Message->query("UPDATE newva_messages SET is_read = '1' WHERE id = '".$id."' AND m_to = '".$this->Auth->user('id')."'");
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id, 'Message.m_to' => $this->Auth->user('id')));
			$this->set('message', $this->Message->find('first', $options));
		}
	}
	
	public function viewSent($id = null) {
		if (!$this->Message->exists($id)) {
			throw new NotFoundException(__('Invalid message'));
		}
		if($this->Auth->user('id') != null) {
			$options = array('conditions' => array('Message.' . $this->Message->primaryKey => $id, 'Message.m_from' => $this->Auth->user('id')));
			$this->set('message', $this->Message->find('first', $options));
		}
	}
	
	public function homeNewMessages() {
		$options = array('conditions' => array('Message.m_to' => $this->Auth->user('id'), 'Message.is_read' => '0'));
		$messages = $this->Message->find('count', $options);
		if (isset($this->params['requested'])){
			return $messages;
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			
			$this->loadModel('DontLikeGallery');
			$options = array('conditions' => array('DontLikeGallery.user_id' => $this->data['Message']['mtos'], 'DontLikeGallery.dontlike_id' => $this->Auth->user('id')));
			if($this->DontLikeGallery->find('count', $options) == 0) {
				
				$this->Message->create();
				if ($this->Message->save($this->request->data)) {
					$this->Session->setFlash(__('<div class="alert alert-success" role="alert">The message has been sent.</div>'));
					return $this->redirect(array('action' => 'inbox'));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				}
			} else {
				$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
			}
		}
		//$mfroms = $this->Message->Mfrom->find('list');
		$mtos = $this->User->find('list', array('order' => array('User.username' => 'asc')));
		$this->set(compact('mtos'));
	}


/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Message->id = $id;
		if (!$this->Message->exists()) {
			throw new NotFoundException(__('Invalid message'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Message->delete()) {
			//$this->Session->setFlash(__('The message has been deleted.'));
		} else {
			//$this->Session->setFlash(__('The message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'inbox'));
	}

}
