<?php
App::uses('AppController', 'Controller');
/**
 * LikeGalleries Controller
 *
 * @property LikeGallery $LikeGallery
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class LikeGalleriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view() {
		
		$this->Paginator->settings = array('conditions' => array('LikeGallery.user_id'  => $this->Auth->user('id')), 'limit' => 20, 'order' => array('Like.username' => 'asc'));
		$this->set('likeGalleries', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add($like_id = null) {
		if ($this->request->is(array('post', 'put'))) {
			
			
			$this->LikeGallery->create();
			
			$this->request->data['LikeGallery']['user_id'] = $this->Auth->user('id');
			$this->request->data['LikeGallery']['like_id'] = $like_id;
			
			if ($this->LikeGallery->save($this->request->data)) {
				//$this->Session->setFlash(__('The like gallery has been saved.'));
				return $this->redirect(array('action' => 'view'));
			} else {
				//$this->Session->setFlash(__('The like gallery could not be saved. Please, try again.'));
				return $this->redirect($this->referer());
			}
		}
		
	}
	
	public function checkIfLike($like_id = null){
		$options = array('conditions' => array('LikeGallery.like_id' => $like_id, 'LikeGallery.user_id' => $this->Auth->user('id')));
		$likeGalleries = $this->LikeGallery->find('count', $options);
		if (isset($this->params['requested'])){
			return $likeGalleries;
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
		$this->LikeGallery->id = $id;
		if (!$this->LikeGallery->exists()) {
			throw new NotFoundException(__('Invalid gallery'));
		}
		$this->request->allowMethod('post', 'delete');
		
		$options = array('conditions' => array('LikeGallery.' . $this->LikeGallery->primaryKey => $id));
		$likeGallery = $this->LikeGallery->find('first', $options);
		if($likeGallery['LikeGallery']['user_id'] == $this->Auth->user('id')){
			if ($this->LikeGallery->delete()) {
				//$this->Session->setFlash(__('The like gallery has been deleted.'));
			} else {
				//$this->Session->setFlash(__('The like gallery could not be deleted. Please, try again.'));
			}
		}
		return $this->redirect(array('action' => 'view'));
	}

}
