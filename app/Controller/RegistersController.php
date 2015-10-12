<?php
App::uses('AppController', 'Controller');
/**
 * Registers Controller
 *
 * @property Register $Register
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RegistersController extends AppController {

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
		if($this->Auth->user('level') > 2){
			$this->Paginator->settings = array('limit' => 50, 'order' => array('Register.id' => 'desc'));
			$this->set('registers', $this->Paginator->paginate());
		}
	}



}
