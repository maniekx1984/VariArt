<?php
App::uses('AppController', 'Controller');
/**
 * DontLikeGalleries Controller
 *
 * @property DontLikeGallery $DontLikeGallery
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DontLikeGalleriesController extends AppController {

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
	/*public function index() {
		$this->DontLikeGallery->recursive = 0;
		$this->set('dontLikeGalleries', $this->Paginator->paginate());
	}*/

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view() {
		
		$this->Paginator->settings = array('conditions' => array('DontLikeGallery.user_id'  => $this->Auth->user('id')), 'limit' => 20, 'order' => array('Dontlike.username' => 'asc'));
		$this->set('dontLikeGalleries', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add($dontlike_id = null) {
		if ($this->request->is(array('post', 'put'))) {
			
			
			$this->DontLikeGallery->create();
			
			$this->request->data['DontLikeGallery']['user_id'] = $this->Auth->user('id');
			$this->request->data['DontLikeGallery']['dontlike_id'] = $dontlike_id;
			
			if ($this->DontLikeGallery->save($this->request->data)) {
				//$this->Session->setFlash(__('The like gallery has been saved.'));
				return $this->redirect(array('action' => 'view'));
			} else {
				//$this->Session->setFlash(__('The like gallery could not be saved. Please, try again.'));
				return $this->redirect($this->referer());
			}
		}
		
	}
	
	
	public function checkIfDontLike($dontlike_id = null){
		$options = array('conditions' => array('DontLikeGallery.dontlike_id' => $dontlike_id, 'DontLikeGallery.user_id' => $this->Auth->user('id')));
		$dontLikeGalleries = $this->DontLikeGallery->find('count', $options);
		if (isset($this->params['requested'])){
			return $dontLikeGalleries;
		}
	}
	



/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DontLikeGallery->id = $id;
		if (!$this->DontLikeGallery->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$this->request->allowMethod('post', 'delete');
		
		$options = array('conditions' => array('DontLikeGallery.' . $this->DontLikeGallery->primaryKey => $id));
		$dontLikeGallery = $this->DontLikeGallery->find('first', $options);
		if($dontLikeGallery['DontLikeGallery']['user_id'] == $this->Auth->user('id')){
			if ($this->DontLikeGallery->delete()) {
				//$this->Session->setFlash(__('The like gallery has been deleted.'));
			} else {
				//$this->Session->setFlash(__('The like gallery could not be deleted. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'view'));
	}

}
