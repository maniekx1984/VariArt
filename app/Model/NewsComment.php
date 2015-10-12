<?php
App::uses('AppModel', 'Model');
/**
 * NewsComment Model
 *
 * @property News $News
 * @property User $Author
 */
class NewsComment extends AppModel {

	public function beforeSave($options = array()) {
        if(empty($this->data['NewsComment']['date']) AND empty($this->data['NewsComment']['time']) AND empty($this->data['NewsComment']['author_id'])){
	        $this->data['NewsComment']['date'] = date('Y-m-d');
			$this->data['NewsComment']['time'] = date('H:i:s');
			$this->data['NewsComment']['author_id'] = AuthComponent::user('id');
			$this->data['NewsComment']['is_active'] = "1";
			$this->data['NewsComment']['is_read'] = "0";
		}
		return true;
    }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'News' => array(
			'className' => 'News',
			'foreignKey' => 'news_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
