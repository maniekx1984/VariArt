<?php
App::uses('AppController', 'Controller');
/**
 * NewsFiles Controller
 *
 * @property NewsFile $NewsFile
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class NewsFilesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session', 'Qimage');



/**
 * add method
 *
 * @return void
 */
	public function add($news_id) {
		if ($this->request->is('post')) {
			$this->NewsFile->create();
			
			$file_name = true;
			if(!(empty($this->request->data['NewsFiles']['file']['name']))) {
				$file_name = $this->Qimage->newsPhoto($this->request->data['NewsFiles']['file']);
			}
			
			if($file_name == false) {
				$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
			} else {
				$this->request->data['NewsFile']['news_id'] = $news_id;
				$this->request->data['NewsFile']['file_name'] = $file_name;
				if ($this->NewsFile->save($this->request->data)) {
					
					$this->Session->setFlash(__('Choosen file has been saved.<br /><br />'));
					return $this->redirect(array('action' => 'add', $news_id));
				} else {
					$this->Session->setFlash(__('<div class="alert alert-danger" role="alert">Please verify provided information.</div>'));
				}
			}
		}
		$options = array('conditions' => array('NewsFile.news_id' => $news_id));
		$newsFilesCount = $this->NewsFile->find('count', $options);
		$options = array('conditions' => array('News.id' => $news_id));
		$news = $this->NewsFile->News->find('first', $options);
		$this->set(compact('newsFilesCount', 'news'));
	}



}
