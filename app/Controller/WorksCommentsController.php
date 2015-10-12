<?php
App::uses('AppController', 'Controller');
/**
 * WorksComments Controller
 *
 * @property WorksComment $WorksComment
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WorksCommentsController extends AppController {

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
		$this->WorksComment->recursive = 0;
		$this->set('worksComments', $this->Paginator->paginate());
	}
	
	public function homeNewMessages() {
		$options = array('conditions' => array('Work.user_id' => $this->Auth->user('id'), 'WorksComment.is_read' => '0', 'WorksComment.is_active' => '1'), 'group' => array('Work.id'));
		$newWorksComments = $this->WorksComment->find('all', $options);
		if (isset($this->params['requested'])){
			return $newWorksComments;
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
		if (!$this->WorksComment->exists($id)) {
			throw new NotFoundException(__('Invalid works comment'));
		}
		$options = array('conditions' => array('WorksComment.' . $this->WorksComment->primaryKey => $id));
		$this->set('worksComment', $this->WorksComment->find('first', $options));
	}
	
	public function viewFromWorkId($work_id = null) {
		$this->WorksComment->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('WorksComment.work_id' => $work_id, 'WorksComment.is_active' => '1'), 'limit' => 5, 'order' => array('WorksComment.id' => 'desc'));
		$workComments = $this->Paginator->paginate('WorksComment');
		if (isset($this->params['requested'])){
			return $workComments;
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
			$options = array('conditions' => array('DontLikeGallery.user_id' => $this->data['WorksComment']['work_user_id'], 'DontLikeGallery.dontlike_id' => $this->Auth->user('id')));
				if($this->DontLikeGallery->find('count', $options) == 0) {
				
				$this->WorksComment->create();
				if ($this->WorksComment->save($this->request->data)) {
					
					return $this->redirect($this->referer());
				} else {
					
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
		if (!$this->WorksComment->exists($id)) {
			throw new NotFoundException(__('Invalid works comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->WorksComment->save($this->request->data)) {
				$this->Session->setFlash(__('The works comment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The works comment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('WorksComment.' . $this->WorksComment->primaryKey => $id));
			$this->request->data = $this->WorksComment->find('first', $options);
		}
		$works = $this->WorksComment->Work->find('list');
		$authors = $this->WorksComment->Author->find('list');
		$this->set(compact('works', 'authors'));
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
				
				$options = array('conditions' => array('WorksComment.id' => $id));
				$fnc = $this->WorksComment->find('first', $options);
				$this->WorksComment->data = $this->data;
				$this->WorksComment->data['WorksComment']['id'] = $fnc['WorksComment']['id'];
				$this->WorksComment->data['WorksComment']['date'] = $fnc['WorksComment']['date'];
				$this->WorksComment->data['WorksComment']['time'] = $fnc['WorksComment']['time'];
				$this->WorksComment->data['WorksComment']['author_id'] = $fnc['WorksComment']['author_id'];
				$this->WorksComment->data['WorksComment']['is_read'] = $fnc['WorksComment']['is_read'];
				$this->WorksComment->data['WorksComment']['is_active'] = "2";
				
				if($this->WorksComment->save($this->WorksComment->data)){
					$this->User->query("INSERT INTO va_register VALUES (NULL, '".$this->Auth->user('id')."', 'COMMENT REMOVAL - WORK', 'COMMENT ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
				}
				
			}
			
		}
		return $this->redirect($this->referer());
	}


}