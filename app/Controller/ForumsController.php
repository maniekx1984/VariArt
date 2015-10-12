<?php
App::uses('AppController', 'Controller');
/**
 * ForumSections Controller
 *
 * @property ForumSection $ForumSection
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ForumsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();
    }
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Forum->recursive = 1;
		//$this->Paginator->settings['contain'] = array('Topic', 'Post' => array('User','Topic'));
		
		$options = array('order' => array('Forum.order_number ASC'));
		$forums = $this->Forum->find('all', $options);
		$this->set(compact('forums'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum section'));
		}
		$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
		$this->set('forum', $this->Forum->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Forum->create();
			if ($this->Forum->save($this->request->data)) {
				$this->Session->setFlash(__('The forum section has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum section could not be saved. Please, try again.'));
			}
		}
		$forums = $this->Forum->Forum->find('list');
		$this->set(compact('forums'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Forum->exists($id)) {
			throw new NotFoundException(__('Invalid forum section'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Forum->save($this->request->data)) {
				$this->Session->setFlash(__('The forum section has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The forum section could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Forum.' . $this->Forum->primaryKey => $id));
			$this->request->data = $this->Forum->find('first', $options);
		}
		$forums = $this->Forum->Forum->find('list');
		$this->set(compact('forums'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Forum->id = $id;
		if (!$this->Forum->exists()) {
			throw new NotFoundException(__('Invalid forum section'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Forum->delete()) {
			$this->Session->setFlash(__('The forum section has been deleted.'));
		} else {
			$this->Session->setFlash(__('The forum section could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
