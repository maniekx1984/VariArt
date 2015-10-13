<?php
App::uses('AppController', 'Controller');
/**
 * Works Controller
 *
 * @property Work $Work
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WorksController extends AppController {

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
		$this->Work->recursive = 0;
		$this->set('works', $this->Paginator->paginate());
	}
	
	public function search() {
		$this->Work->recursive = 0;
		$word = $this->request->query['search'];
		$this->Paginator->settings = array('conditions' => array('OR' => array('Work.title LIKE' => '%'.$word.'%', 'Work.description LIKE' => '%'.$word.'%')),
		'limit' => 42,
		'order' => array('Work.title' => 'asc'));
		$this->set('works', $this->Paginator->paginate());
	}

// index by user
	public function user($user_id = null) {
		$this->Work->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('Work.user_id' => $user_id), 'limit' => 24, 'order' => array('Work.id' => 'desc'));
		$works = $this->Paginator->paginate();
		
		$this->loadModel('User');
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $user_id));
		$user = $this->User->find('first', $options);
		
		$this->set(compact('user', 'works'));
	}

	public function main() {
		$this->Work->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('User.level !=' => '0'), 'limit' => 42, 'order' => array('Work.id' => 'desc'));
		$this->set('works', $this->Paginator->paginate());
	}
	
	public function initial() {
		$this->Work->recursive = 0;
		$this->Paginator->settings = array('conditions' => array('User.level =' => '0'), 'limit' => 42, 'order' => array('Work.id' => 'desc'));
		$this->set('works', $this->Paginator->paginate());
	}
	
	public function homeNewWorks() {
		$options = array('conditions' => array('User.level !=' => '0'), 'limit' => 6, 'order' => array('Work.id' => 'desc'));
		$works = $this->Work->find('all', $options);
		if (isset($this->params['requested'])){
			return $works;
		}
	}
	
	public function homeInteresting($user_id = null) {
		$works = Cache::read('homeInterestingWorks', 'short');
		if (!$works) {
			$options = array('conditions' => array('User.id' => $user_id), 'limit' => 6, 'order' => 'rand()');
			$works = $this->Work->find('all', $options);
			Cache::write('homeInterestingWorks', $works, 'short');
		}
		if (isset($this->params['requested'])){
			return $works;
		}
	}
	
	public function homeInitial() {
		$options = array('conditions' => array('User.level =' => '0'), 'limit' => 6, 'order' => array('Work.id' => 'desc'));
		$works = $this->Work->find('all', $options);
		if (isset($this->params['requested'])){
			return $works;
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
		if (!$this->Work->exists($id)) {
			throw new NotFoundException(__('Invalid work'));
		}
		
		//$options = array('conditions' => array('Work.' . $this->Work->primaryKey => $id));
		//$this->set('work', $this->Work->find('first', $options));
		
		$this->Paginator->settings = array('conditions' => array('WorksComment.work_id' => $id, 'WorksComment.is_active' => '1'), 'limit' => 5, 'order' => array('WorksComment.id' => 'desc'));
		$workComments = $this->Paginator->paginate('WorksComment');
		
		$options = array('conditions' => array('Entree.work_id' => $id));
		$entree = $this->Work->Entree->find('first', $options);
		
		$options = array('conditions' => array('Work.' . $this->Work->primaryKey => $id));
		$work = $this->Work->find('first', $options);
		
		$this->Work->updateAll(
		    array('Work.work_views' => 'Work.work_views+1'),
		    array('Work.id' => $id)
		);
		
		$this->loadModel('WorksComment');
		$this->WorksComment->updateAll(
		    array('WorksComment.is_read' => '1'),
		    array('WorksComment.work_id' => $id, 'Work.user_id' => $this->Auth->user('id'))
		);
		
		$this->loadModel('NewWorksInLikeGallery');
		$this->NewWorksInLikeGallery->deleteAll(
			array('NewWorksInLikeGallery.user_id' => $this->Auth->user('id'), 'NewWorksInLikeGallery.work_id' => $id)
		);
		
		$this->loadModel('WorksOfTheWeeksWeek');
		$options = array('order' => array('WorksOfTheWeeksWeek.id' => 'desc'));
		$wotw_week = $this->WorksOfTheWeeksWeek->find('first', $options);
		
		$this->loadModel('WorksOfTheWeek');
		
		$options = array('conditions' => array('WorksOfTheWeek.voter_id' => $this->Auth->user('id'), 'WorksOfTheWeek.date' => date('Y-m-d')));
		$user_votes_count = $this->WorksOfTheWeek->find('count', $options);
		
		$options = array('conditions' => array('WorksOfTheWeek.voter_id' => $this->Auth->user('id'), 'WorksOfTheWeek.work_id' => $id));
		$user_votes_count_for_this_work = $this->WorksOfTheWeek->find('count', $options);
		
		$options = array('conditions' => array('WorksOfTheWeek.votes >' => '0', 'WorksOfTheWeek.work_id' => $id));
		$work_votes = $this->WorksOfTheWeek->find('first', $options);
		
		$this->loadModel('User');
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $work['User']['id']));
		$user = $this->User->find('first', $options);
		
		$options = array('conditions' => array('Work.id <' => $id, 'Work.user_id' => $work['User']['id']), 'order' => array('Work.id' => 'desc'));
		$prev = $this->Work->find('first', $options);
		
		$options = array('conditions' => array('Work.id >' => $id, 'Work.user_id' => $work['User']['id']));
		$next = $this->Work->find('first', $options);
		
		$options = array('order' => array('Work.id' => 'asc'), 'conditions' => array('Work.user_id' => $work['User']['id']));
		$first = $this->Work->find('first', $options);
		
		$options = array('order' => array('Work.id' => 'desc'), 'conditions' => array('Work.user_id' => $work['User']['id']));
		$last = $this->Work->find('first', $options);
		
		$this->set(compact('work', 'workComments', 'entree', 'wotw_week', 'user_votes_count', 'user_votes_count_for_this_work', 'work_votes', 'user', 'prev', 'next', 'first', 'last'));
		
	}
	
	public function findPrev($id = null, $user_id = null){
		$options = array('conditions' => array('Work.id <' => $id, 'Work.user_id' => $user_id), 'order' => array('Work.id' => 'desc'));
		$prev = $this->Work->find('first', $options);
		if (isset($this->params['requested'])){
			return $prev;
		}
	}
	
	public function findNext($id = null, $user_id = null){
		$options = array('conditions' => array('Work.id >' => $id, 'Work.user_id' => $user_id));
		$next = $this->Work->find('first', $options);
		if (isset($this->params['requested'])){
			return $next;
		}
	}
	
	public function findFirst($user_id = null){
		$options = array('order' => array('Work.id' => 'asc'), 'conditions' => array('Work.user_id' => $user_id));
		$first = $this->Work->find('first', $options);
		if (isset($this->params['requested'])){
			return $first;
		}
	}

	public function findLast($user_id = null){
		$options = array('order' => array('Work.id' => 'desc'), 'conditions' => array('Work.user_id' => $user_id));
		$last = $this->Work->find('first', $options);
		if (isset($this->params['requested'])){
			return $last;
		}
	}


	public function viewFromUserId($user_id = null) {
		$this->Paginator->settings = array('conditions' => array('Work.user_id' => $user_id), 'limit' => 12, 'order' => array('Work.id' => 'desc'));
		$works = $this->Paginator->paginate('Work');
		if (isset($this->params['requested'])){
			return $works;
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Work->create();
			$file_name = false;
			if(!(empty($this->request->data['Work']['file']['name'])) AND !(empty($this->request->data['Work']['title']))){
				//Qimage
				$file_name = $this->Qimage->uploadWork($this->Auth->user('id'), $this->request->data['Work']['file']);
			}
			$this->request->data['Work']['file_name'] = $file_name;
			$this->request->data['Work']['date'] = date('Y-m-d');
			$this->request->data['Work']['time'] = date('H:i:s');
			$this->request->data['Work']['user_id'] = $this->Auth->user('id');
			
			if(!($file_name == false)){
				if ($this->Work->save($this->request->data)) {
					
					$this->loadModel('NewWorksInLikeGallery');
					$this->loadModel('LikeGallery');
					
					$options = array('conditions' => array('LikeGallery.like_id' => $this->Auth->user('id')));
					$likeGalleries = $this->LikeGallery->find('all', $options);
					
					foreach ($likeGalleries as $likeGallery):
					
						$newNewWorkInLikeGallery['NewWorksInLikeGallery']['user_id'] = $likeGallery['LikeGallery']['user_id'];
						$newNewWorkInLikeGallery['NewWorksInLikeGallery']['work_id'] = $this->Work->id;
						$this->NewWorksInLikeGallery->create();
						$this->NewWorksInLikeGallery->save($newNewWorkInLikeGallery);
						
					endforeach;
					
					return $this->redirect(array('controller' => 'works', 'action' => 'user', $this->Auth->user('id')));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">The work has not been saved - please verify provided informations.</div>'));
				}
			} else {
				$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">The work has not been saved - please verify provided informations.</div>'));
			}
		}
		$categories = $this->Work->Category->find('list', array('order' => array('Category.order_number' => 'asc')));
		$user = $this->Work->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
		$currentDate = date('Y-m-d');
		$todayWorks = $this->Work->find('count', array('conditions' => array('User.id' => $this->Auth->user('id'), 'date' => $currentDate)));
		$allWorks = $this->Work->find('count', array('conditions' => array('User.id' => $this->Auth->user('id'))));
		$this->set(compact('categories', 'user', 'todayWorks', 'allWorks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Work->exists($id)) {
			throw new NotFoundException(__('Invalid work'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$options = array('conditions' => array('Work.' . $this->Work->primaryKey => $id));
			$workUser = $this->Work->find('first', $options);
			$file_name = $workUser['Work']['file_name'];
			
			if($workUser['User']['id'] == $this->Auth->user('id')) {
				//$file_name = false;
				if(!(empty($this->request->data['Work']['file']['name']))){
					//Qimage
					$file_name = $this->Qimage->uploadWork($this->Auth->user('id'), $this->request->data['Work']['file']);
					$this->request->data['Work']['file_name'] = $file_name;
					if(!($file_name == false)){
						$this->Qimage->deleteWork($this->Auth->user('id'), $workUser['Work']['file_name']);
					}
				}
				if(!($file_name == false)){
					if ($this->Work->save($this->request->data)) {
						//$this->Session->setFlash(__('The work has been saved.'));
						
						return $this->redirect(array('controller' => 'works', 'action' => 'user', $this->Auth->user('id')));
					} else {
						$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">The work has not been saved - please verify provided informations.</div>'));
					}
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">The work has not been saved - please verify provided informations.</div>'));
				}
			}
		} else {
			$options = array('conditions' => array('Work.' . $this->Work->primaryKey => $id));
			$this->request->data = $this->Work->find('first', $options);
		}
		$work = $this->Work->find('first', array('conditions' => array('Work.' . $this->Work->primaryKey => $id)));
		$user = $this->Work->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
		$categories = $this->Work->Category->find('list');
		$this->set(compact('user', 'categories', 'work'));
	}
	

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
			$this->Work->id = $id;
			if (!$this->Work->exists()) {
				throw new NotFoundException(__('Invalid work'));
			}
			$this->request->allowMethod('post', 'delete');
			
			$options = array('conditions' => array('Work.' . $this->Work->primaryKey => $id));
			$work = $this->Work->find('first', $options);
			
			if($this->Auth->user('level') > 2 OR $work['User']['id'] == $this->Auth->user('id')) {
				if ($this->Work->delete()) {
					//$this->Session->setFlash(__('The work has been deleted.'));
					if($this->Auth->user('level') > 2){
						$this->User->query("INSERT INTO va_register VALUES (NULL, '".$this->Auth->user('id')."', 'WORK REMOVAL', 'WORK ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
						
						$this->loadModel('Message');
						$newMessage['Message']['m_to'] = $work['User']['id'];
						$newMessage['Message']['title'] = "Work removal";
						$newMessage['Message']['m_text'] = "Your work ".$work['Work']['title']." has been romoved. In order to get more information, please reply to this message.";
						$this->Message->create();
						$this->Message->save($newMessage);
					}
					
					$this->Qimage->deleteWork($work['User']['id'], $work['Work']['file_name']);
				} else {
					
				}
			}
		return $this->redirect($this->referer());
	}

}
