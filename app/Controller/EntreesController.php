<?php
App::uses('AppController', 'Controller');
/**
 * Entrees Controller
 *
 * @property Entree $Entree
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class EntreesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Qimage');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Entree->recursive = 2;
		$this->Paginator->settings = array('conditions' => array('Entree.is_waiting' => '0'), 'limit' => 42, 'order' => array('Entree.id' => 'desc'));
		$this->set('entrees', $this->Paginator->paginate());
	}
	
	public function moderatorIndex() {
		if($this->Auth->user('level') > 2) {
			$this->Entree->recursive = 2;
			$this->Paginator->settings = array('limit' => 20, 'order' => array('Entree.id' => 'desc'));
			$entrees = $this->Paginator->paginate();
			
			$options = array('conditions' => array('Entree.is_waiting' => '1'));
			$entreesWaitingCount = $this->Entree->find('count', $options);
			
			$this->set(compact('entrees', 'entreesWaitingCount'));
		}
	}
	
	public function moderatorHeaderNoEntrees() {
		$options = array('conditions' => array('Entree.is_waiting' => '1'));
		$moderatorHeaderNoEntrees = $this->Entree->find('count', $options);
		if (isset($this->params['requested'])){
			return $moderatorHeaderNoEntrees;
		}
	}
	
	public function headerEntree() {
		$entree = Cache::read('headerEntree', 'three');
		if(!$entree){
			$this->Entree->recursive = 2;
			$options = array('conditions' => array('Entree.is_waiting' => '0'), 'order' => array('Entree.id' => 'desc'), 'limit' => 1);
			$entree = $this->Entree->find('first', $options);
			Cache::write('headerEntree', $entree, 'three');
		}
		if (isset($this->params['requested'])){
			return $entree;
		}
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		if($this->Auth->user('level') > 2){
			if ($this->request->is('post')) {
				$this->Entree->create();
				
				$this->Qimage->cronDG($this->data['Entree']['user_id'], $this->data['Entree']['file_name']);
				$this->Qimage->cronDGBIG($this->data['Entree']['user_id'], $this->data['Entree']['file_name']);
				
				if ($this->Entree->save($this->request->data)) {
					$this->Entree->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'DODANIE DG', 'WORK ID: ".$this->data['Entree']['work_id']."', '".date('Y-m-d')."', '".date('H:i:s')."')");
                  	$this->Session->setFlash(__('The entree has been saved.'));
					return $this->redirect(array('controller' => 'works', 'action' => 'view', $this->data['Entree']['work_id']));
				} else {
					$this->Session->setFlash(__('The entree could not be saved. Please, try again.'));
				}
			}
		}
		/*$works = $this->Entree->Work->find('list');
		$moderators = $this->Entree->Moderator->find('list');
		$this->set(compact('works', 'moderators'));*/
	}



/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Entree->id = $id;
		if (!$this->Entree->exists()) {
			throw new NotFoundException(__('Invalid entree'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Entree->delete()) {
			$this->Entree->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'ENTREE REMOVAL', 'ENTREE ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
			$this->Session->setFlash(__('The entree has been deleted.'));
			return $this->redirect($this->referer());
		} else {
			$this->Session->setFlash(__('The entree could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
