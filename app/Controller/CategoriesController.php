<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class CategoriesController extends AppController {

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
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->Paginator->settings = array('conditions' => array('Work.category_id' => $id), 'limit' => 42, 'order' => array('Work.id' => 'desc'));
		$works = $this->Paginator->paginate('Work');
		
		
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
		$category = $this->Category->find('first', $options);
		$this->set(compact('category', 'works'));
	}



// sideCategories
	public function sideCategories() {
		$this->Category->recursive = -1;
		$categories = Cache::read('sideCategories', 'verylong');
		if (!$categories) {
            $categories = $this->Category->find('all', array('fields' => array('Category.id', 'Category.title'), 'conditions' => array('Category.is_activated' => '1'), 'order' => array('Category.order_number asc')));
            Cache::write('sideCategories', $categories, 'verylong');
        }
		if (isset($this->params['requested'])){
			return $categories;
		}
		
		
	}
}
