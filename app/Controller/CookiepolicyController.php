<?php
App::uses('AppController', 'Controller');


class CookiePolicyController extends AppController {
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Cookie->time = "1 year";
	}

	public function acceptation() {
		$this->Cookie->write('cok');
		return $this->redirect($this->referer());
	}

}
