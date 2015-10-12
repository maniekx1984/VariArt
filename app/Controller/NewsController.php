<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * @property News $News
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NewsController extends AppController {
	
	public function beforeFilter() {
        parent::beforeFilter();
    }
	
	
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
		$this->Paginator->settings = array('conditions' => array('News.is_activated' => 1), 'limit' => 20, 'order' => array('News.id' => 'desc'));
		$this->set('news', $this->Paginator->paginate());
	}
	
	public function moderatorIndexWaiting() {
		$this->Paginator->settings = array('conditions' => array('News.is_activated' => 0), 'limit' => 20, 'order' => array('News.id' => 'desc'));
		$this->set('news', $this->Paginator->paginate());
	}
	
	public function moderatorHeaderWaiting() {
		$options = array('conditions' => array('News.is_activated' => 0));
		$moderatorHeaderWaiting = $this->News->find('count', $options);
		if (isset($this->params['requested'])){
			return $moderatorHeaderWaiting;
		}
	}
	
	public function moderatorIndexNotActivated() {
		$this->Paginator->settings = array('conditions' => array('News.is_activated' => 2), 'limit' => 20, 'order' => array('News.id' => 'desc'));
		$this->set('news', $this->Paginator->paginate());
	}
	
	public function moderatorIndexActivated() {
		$this->Paginator->settings = array('conditions' => array('News.is_activated' => 1), 'limit' => 20, 'order' => array('News.id' => 'desc'));
		$this->set('news', $this->Paginator->paginate());
	}
	
	public function indexMy() {
		if($this->Auth->user('id') > 0){
		$this->Paginator->settings = array('conditions' => array('News.author_id' => $this->Auth->user('id')), 'limit' => 20, 'order' => array('News.id' => 'desc'));
		$this->set('news', $this->Paginator->paginate());
		}
	}
	
	public function latestNews() {
		$latestNews = Cache::read('latestNews', 'veryshort');
		if (!$latestNews) {
            $options = array('conditions' => array('News.is_activated' => 1), 'limit' => 6, 'order' => array('News.id' => 'desc'));
			$latestNews = $this->News->find('all', $options);
            Cache::write('latestNews', $latestNews, 'veryshort');
        }
		
		if (isset($this->params['requested'])){
			return $latestNews;
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
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		
		
		$this->loadModel('NewsComment');
		$this->NewsComment->updateAll(
		    array('NewsComment.is_read' => '1'),
		    array('NewsComment.news_id' => $id, 'News.author_id' => $this->Auth->user('id'))
		);
		
		$this->Paginator->settings = array('conditions' => array('NewsComment.news_id' => $id, 'NewsComment.is_active' => '1'), 'limit' => 5, 'order' => array('NewsComment.id' => 'desc'));
		$newsComments = $this->Paginator->paginate('NewsComment');
		
		$options = array('conditions' => array('NewsFile.news_id' => $id));
		$newsFiles = $this->News->NewsFile->find('all', $options);
		$newsFilesCount = $this->News->NewsFile->find('count', $options);
		
		$options = array('conditions' => array('News.is_activated' => 1, 'News.' . $this->News->primaryKey => $id));
		$news = $this->News->find('first', $options);
		$this->set(compact('news', 'newsComments', 'newsFiles', 'newsFilesCount'));
		
		
	}
	
	public function moderatorView($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		
		
		
		
		$this->Paginator->settings = array('conditions' => array('NewsComment.news_id' => $id, 'NewsComment.is_active' => '1'), 'limit' => 5, 'order' => array('NewsComment.id' => 'desc'));
		$newsComments = $this->Paginator->paginate('NewsComment');
		
		$options = array('conditions' => array('NewsFile.news_id' => $id));
		$newsFiles = $this->News->NewsFile->find('all', $options);
		$newsFilesCount = $this->News->NewsFile->find('count', $options);
		
		$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
		$news = $this->News->find('first', $options);
		$this->set(compact('news', 'newsComments', 'newsFiles', 'newsFilesCount'));
		
		
	}
	
	public function moderatorActivation($id = null, $action = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		
		if($action == null){
			throw new NotFoundException(__('Invalid action'));
		}
		
		if($this->Auth->user('level') > 2){
			$this->News->updateAll(
			    array('News.is_activated' => $action),
			    array('News.id' => $id)
			);
		}
		
		if($action == 1){
			$this->News->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'NEWS ACCEPTATION', 'NEWS ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
			return $this->redirect(array('action' => 'moderatorIndexActivated'));
		} elseif ($action == 2){
			$this->News->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'NEWS REMOVAL', 'NEWS ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
			return $this->redirect(array('action' => 'moderatorIndexNotActivated'));
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->News->create();
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('<div class="alert alert-success" role="alert">News has been saved - after verification it will be published.<br /><br />During acceptation process you can add up to 2 photos - go to your news section".</div>'));
				return $this->redirect(array('action' => 'add'));
			} else {
				$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
			}
		}
		$authors = $this->News->Author->find('list');
		$this->set(compact('authors'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		if($this->Auth->user('level') > 2){
			if ($this->request->is(array('post', 'put'))) {
				if ($this->News->save($this->request->data)) {
					//$this->Session->setFlash(__('The news has been saved.'));
					$this->News->query("INSERT INTO newva_register VALUES (NULL, '".$this->Auth->user('id')."', 'NEWS EDITION', 'NEWS ID: ".$id."', '".date('Y-m-d')."', '".date('H:i:s')."')");
					return $this->redirect(array('action' => 'moderatorView', $id));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				}
			} else {
				$options = array('conditions' => array('News.' . $this->News->primaryKey => $id));
				$this->request->data = $this->News->find('first', $options);
			}
		}
	}



}
