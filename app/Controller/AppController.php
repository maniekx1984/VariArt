<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {
	
	//public $theme = 'Light';
	
	public $components = array(
	    'Cookie',
	    'Session',
	    'RequestHandler',
	    'Auth' => array(
	        'authenticate' => array('Form' => array(
                'passwordHasher' => array(
                    'className' => 'Simple',
                    'hashType' => 'md5'
                )
            )
	        )
	    )
		//'Auth'
	);
	
	public $helpers = array ('Js');
	
	public function beforeFilter() {
		
		
		
        $this->Auth->allow();
		$this->set('user_id', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
		$this->set('level', $this->Auth->user('level'));
		$this->set('master_level', $this->Auth->user('master_level'));
		$this->set('is_avatar', $this->Auth->user('is_avatar'));
		$this->set('name', $this->Auth->user('name'));
		$this->set('surname', $this->Auth->user('surname'));
		$this->set('is_of_age', $this->Auth->user('is_of_age'));
		$this->set('blocked', $this->Auth->user('blocked'));
		$this->set('cookiepolicy', $this->Cookie->read('cok'));
		
		if($this->Auth->user('id') > 0){
			$this->loadModel('User');
			$last_visit = date('Y-m-d H:i:s');
			$this->User->updateAll(
			    array('User.last_visit' => '"'.$last_visit.'"'),
			    array('User.id' => $this->Auth->user('id'))
			);
		}
    }
}
