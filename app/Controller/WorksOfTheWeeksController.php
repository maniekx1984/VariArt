<?php
App::uses('AppController', 'Controller');
/**
 * WorksOfTheWeeks Controller
 *
 * @property WorksOfTheWeek $WorksOfTheWeek
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class WorksOfTheWeeksController extends AppController {

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
		
		$this->WorksOfTheWeek->recursive = 2;
		$this->Paginator->settings = array('conditions' => array('WorksOfTheWeek.votes >' => '0'), 'limit' => 42, 'order' => array('WorksOfTheWeek.date' => 'desc', 'WorksOfTheWeek.votes' => 'desc', 'WorksOfTheWeek.id' => 'asc'));
		$this->set('worksOfTheWeeks', $this->Paginator->paginate());
	}
	
	public function nominations() {
		
		$this->WorksOfTheWeek->recursive = 2;
		$this->Paginator->settings = array('conditions' => array('WorksOfTheWeek.votes' => '0', 'not' => array('WorksOfTheWeek.week_id' => 'NULL')), 'group' => array('WorksOfTheWeek.work_id'), 'limit' => 42, 'order' => array('WorksOfTheWeek.id' => 'desc'));
		$this->set('worksOfTheWeeks', $this->Paginator->paginate());
	}

	
	public function homeWorksOfTheWeek() {
		$this->WorksOfTheWeek->recursive = 2;
		$homeWorksOfTheWeeks = Cache::read('homeWorksOfTheWeek', 'three');
		if (!$homeWorksOfTheWeeks) {
			$options = array('conditions' => array('WorksOfTheWeek.votes >' => '0'), 'limit' => 4, 'order' => array('WorksOfTheWeek.date' => 'desc', 'WorksOfTheWeek.votes' => 'desc', 'WorksOfTheWeek.id' => 'asc'));
			$homeWorksOfTheWeeks = $this->WorksOfTheWeek->find('all', $options);
			Cache::write('homeWorksOfTheWeek', $homeWorksOfTheWeeks, 'three');
		}
		if (isset($this->params['requested'])){
			return $homeWorksOfTheWeeks;
		}
	}



/**
 * add method
 *
 * @return void
 */
	public function add($wotw_id) {
		
		if ($this->request->is(array('post', 'put'))) {
			
			
			$this->loadModel('WorksOfTheWeeksWeek');
			$options = array('order' => array('WorksOfTheWeeksWeek.id' => 'desc'));
			$wotw_week = $this->WorksOfTheWeeksWeek->find('first', $options);
			
			$this->loadModel('Work');
			$options = array('conditions' => array('Work.id' => $wotw_id));
			$work = $this->Work->find('first', $options);
			
			$options = array('conditions' => array('WorksOfTheWeek.voter_id' => $this->Auth->user('id'), 'WorksOfTheWeek.date' => date('Y-m-d')));
			$user_votes_count = $this->WorksOfTheWeek->find('count', $options);
			
			$options = array('conditions' => array('WorksOfTheWeek.voter_id' => $this->Auth->user('id'), 'WorksOfTheWeek.work_id' => $wotw_id));
			$user_votes_count_for_this_work = $this->WorksOfTheWeek->find('count', $options);
			
			if($work['Work']['date'] >= $wotw_week['WorksOfTheWeeksWeek']['date_start'] AND 
				$work['Work']['date'] <= $wotw_week['WorksOfTheWeeksWeek']['date_end'] AND 
				$user_votes_count < 3 AND 
				$user_votes_count_for_this_work == 0 AND
				$work['User']['id'] <> $this->Auth->user('id')) {
				
				$this->WorksOfTheWeek->create();
				
				$this->request->data['WorksOfTheWeek']['voter_id'] = $this->Auth->user('id');
				$this->request->data['WorksOfTheWeek']['work_id'] = $wotw_id;
				$this->request->data['WorksOfTheWeek']['week_id'] = $wotw_week['WorksOfTheWeeksWeek']['id'];
				$this->request->data['WorksOfTheWeek']['date'] = date('Y-m-d');
				
				if ($this->WorksOfTheWeek->save($this->request->data)) {
					
					return $this->redirect($this->referer());
				} else {
					
					return $this->redirect($this->referer());
				}
				
			} else {
				return $this->redirect($this->referer());
			}
		}
	}


}
