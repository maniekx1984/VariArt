<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Qimage', 'Email');


	public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('register', 'logout', 'login');
    }
	
	public function homeInteresting() {
		$user = Cache::read('homeInterestingUser', 'long');
		if (!$user) {
			$options = array('conditions' => array('User.master_level' => '1'), 'order' => 'rand()');
			$user = $this->User->find('first', $options);
			Cache::write('homeInterestingUser', $user, 'long');
		}
		if (isset($this->params['requested'])){
			return $user;
		}
	}
	
	public function online() {
		$two_minutes_ago = date('Y-m-d H:i:s', strtotime('-5 minutes', strtotime(date('Y-m-d H:i:s'))));
		
		$options = array('conditions' => array('User.last_visit >=' => $two_minutes_ago), 'order' => array('User.username' => 'asc'));
		$users = $this->User->find('all', $options);
		if (isset($this->params['requested'])){
			return $users;
		}
	}
	
	public function login() {
	    if ($this->request->is('post')) {
	        
	        if ($this->Auth->login()) {
				
	            return $this->redirect($this->referer());
	        } else {
	            $this->Session->setFlash(
	                __('<div class="alert alert-danger" role="alert">Incorrect username or password.</div>'),
	                'default',
	                array(),
	                'auth'
	            );
	        }
	    }
	}

	public function logout() {
	    //$this->Cookie->delete('rememberMe');
	    return $this->redirect($this->Auth->logout());
	}


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->Paginator->settings = array('limit' => 50, 'order' => array('User.username' => 'asc'));
		$this->set('users', $this->Paginator->paginate());
	}
	
	public function moderatorIndex() {
		if($this->Auth->user('level') > 2){
			$mtos = $this->User->find('list', array('order' => array('User.username' => 'asc')));
			
			$this->Paginator->settings = array('limit' => 50, 'order' => array('User.username' => 'asc'));
			
			$users = $this->Paginator->paginate();
			
			
			
			if ($this->request->is(array('post', 'put'))) {
				return $this->redirect(array('controller' => 'users', 'action' => 'moderatorEdit', $this->data['User']['mtos']));
			} else {
				$this->set(compact('users', 'mtos'));
			}
		}
	}
	
	public function search() {
		$this->User->recursive = 0;
		$word = $this->request->query['search'];
		$this->Paginator->settings = array('conditions' => array('OR' => array('User.username LIKE' => '%'.$word.'%', 'User.name LIKE' => '%'.$word.'%', 'User.surname LIKE' => '%'.$word.'%')),
		'limit' => 50,
		'order' => array('User.username' => 'asc'));
		
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$user = $this->User->find('first', $options);
		
		$this->loadModel('Comment');
		$options = array('conditions' => array('Comment.gallery_id' => $id, 'Comment.is_active' => '1'), 'limit' => 10, 'order' => array('Comment.id' => 'desc'));
		$comments = $this->Comment->find('all', $options);
		
		$this->Comment->updateAll(
		    array('Comment.is_read' => '1'),
		    array('Comment.gallery_id' => $id, 'Gallery.id' => $this->Auth->user('id'))
		);
		
		$this->loadModel('Work');
		$options = array('conditions' => array('Work.user_id' => $id), 'limit' => 12, 'order' => array('Work.id' => 'desc'));
		$works = $this->Work->find('all', $options);
		
		$this->set(compact('user', 'comments', 'works'));
	}

/**
 * add method
 *
 * @return void
 */
	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->request->data['User']['people_verification'] == 2) {
				if ($this->request->data['User']['password'] == $this->request->data['User']['confirm_password']) {
					if ($this->User->save($this->request->data)) {
						$this->Session->setFlash(__('<br /><br />'));
						return $this->redirect(array('controller' => 'pages', 'action' => 'register_confirmation'));
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
					}
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please provide correct password.</div>'));
				}
			} else {
				$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->data['User']['id'] == $this->Auth->user('id')){
				if ($this->User->save($this->request->data)) {
					
					
					
					$this->Session->setFlash(__('<div class="alert alert-success" role="alert">Your profile has been saved.</div>'));
					$this->Session->write('Auth.User', array_merge(AuthComponent::User(), $this->request->data['User']) );
					return $this->redirect(array('action' => 'edit', $id));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function moderatorEdit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->Auth->user('level') > 2){
				if ($this->User->save($this->request->data)) {
					
					if ($this->Auth->user('level') > 2) {
						$this->User->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'USER EDIT', 'USER ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
					}
					
					$this->Session->setFlash(__('<div class="alert alert-success" role="alert">The profile has been saved.</div>'));
					return $this->redirect(array('action' => 'moderatorEdit', $id));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function editPassword($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$user = $this->User->find('first', $options);
			$passwordHasher = new SimplePasswordHasher(array('hashType' => 'md5'));
            if($this->data['User']['id'] == $this->Auth->user('id')){
	            if($user['User']['password'] == $passwordHasher->hash($this->data['User']['old_password'])){
					if ($this->data['User']['password'] == $this->data['User']['confirm_password']) {
						if ($this->User->save($this->request->data)) {
							$this->Session->setFlash(__('<div class="alert alert-success" role="alert">The password has been saved.</div>'));
							return $this->redirect(array('action' => 'editPassword', $id));
						} else {
							$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
						}
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
					}
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function passwordRecovery() {
		$this->User->recursive = -1;
		
		if(!empty($this->data)) {
			if(empty($this->data['User']['username'])) {
				$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Your password can not be recovered - please verify provided information.</div>'));
			} else {
				$options = array('conditions' => array('User.username' => $this->data['User']['username']));
				$fuser = $this->User->find('first', $options);
				if($fuser != null){
					$this->User->data = $this->data;
					$this->User->data['User']['id'] = $fuser['User']['id'];
					$this->User->data['User']['email'] = $fuser['User']['email'];
				}
				
				
	            
				$newPassword = uniqid();
				
				$this->User->data['User']['password'] = $newPassword;
				
				if($this->User->save($this->User->data)){
					$this->Email->smtpOptions = array(
					'port'=>'25',
					'timeout'=>'30',
					'host' => 'smtp.example.com',
					'username'=>'example@example.com',
					'password'=>'password'
					);
					$this->Email->template = 'passwordRecovery';
					$this->Email->from = 'VariArt <kexample@example.com>';
					$this->Email->to = $fuser['User']['username'].'<'.$fuser['User']['email'].'>';
					$this->Email->subject = 'New password';
					$this->Email->sendAs = 'both';
					$this->Email->delivery = 'smtp';
					$this->set('newPassword', $newPassword);
					$this->Email->send();
					//$this->set('smtp_errors', $this->Email->smtpError);
					$this->Session->setFlash(__('<div class="alert alert-success" role="alert">New password has been sent to your mail.</div>'));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Your password can not be recovered - please verify provided information.</div>'));
				}
			}
		} else {
			
		}
	}

	public function editAvatar($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->data['User']['id'] == $this->Auth->user('id')){
				$this->request->data['User']['is_avatar'] = 0;
				$ext = $this->Qimage->avatar($this->request->data['User'], $this->request->data['User']['id']);
				if($ext == false) {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				} else {
					if($ext == "jpg"){
						$this->request->data['User']['is_avatar'] = 1;
					} else if($ext == "gif"){
						$this->request->data['User']['is_avatar'] = 2;
					}
	
					if ($this->User->save($this->request->data)) {
						$this->Session->write('Auth.User', array_merge(AuthComponent::User(), $this->request->data['User']) );
						$this->Session->setFlash(__('<div class="alert alert-success" role="alert">The profile has been saved.</div>'));
						return $this->redirect(array('action' => 'editAvatar', $id));
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
					}
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function deleteAvatar($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if($this->data['User']['id'] == $this->Auth->user('id')){
				$this->request->data['User']['is_avatar'] = 0;
				if ($this->User->save($this->request->data)) {
					$this->Session->write('Auth.User', array_merge(AuthComponent::User(), $this->request->data['User']) );
					//$this->Session->setFlash(__('Dane zostały prawidłowo zapisane.<br /><br />'));
					return $this->redirect(array('action' => 'editAvatar', $id));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
					return $this->redirect(array('action' => 'editAvatar', $id));
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}
	
	public function editPhoto($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if($this->data['User']['id'] == $this->Auth->user('id')){
				$this->request->data['User']['is_photo'] = 0;
				$ext = $this->Qimage->photo($this->request->data['User'], $this->request->data['User']['id']);
				if($ext == false) {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				} else {
					if($ext == "jpg"){
						$this->request->data['User']['is_photo'] = 1;
					}
	
					if ($this->User->save($this->request->data)) {
						$this->Session->write('Auth.User', array_merge(AuthComponent::User(), $this->request->data['User']) );
						$this->Session->setFlash(__('<div class="alert alert-success" role="alert">The profile has been saved.</div>'));
						return $this->redirect(array('action' => 'editPhoto', $id));
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
					}
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

	public function deletePhoto($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is(array('post', 'put'))) {
			if($this->data['User']['id'] == $this->Auth->user('id')){
				$this->request->data['User']['is_photo'] = 0;
				if ($this->User->save($this->request->data)) {
					$this->Session->write('Auth.User', array_merge(AuthComponent::User(), $this->request->data['User']) );
					//$this->Session->setFlash(__('Dane zostały prawidłowo zapisane.<br /><br />'));
					return $this->redirect(array('action' => 'editPhoto', $id));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
					return $this->redirect(array('action' => 'editPhoto', $id));
				}
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/

}
