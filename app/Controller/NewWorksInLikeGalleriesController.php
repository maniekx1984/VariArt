<?php
App::uses('AppController', 'Controller');
/**
 * NewWorksInLikeGalleries Controller
 *
 * @property NewWorksInLikeGallery $NewWorksInLikeGallery
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NewWorksInLikeGalleriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');


	public function homeNewMessages() {
		//$this->User->recursive = 1;
		$options = array('conditions' => array('NewWorksInLikeGallery.user_id' => $this->Auth->user('id')));
		$newNewWorksInLikeGalleries = $this->NewWorksInLikeGallery->find('all', $options);
		if (isset($this->params['requested'])){
			return $newNewWorksInLikeGalleries;
		}
	}



}
