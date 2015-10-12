<?php
App::uses('AppModel', 'Model');
/**
 * NewsFile Model
 *
 * @property News $News
 * @property User $Author
 */
class NewsFile extends AppModel {

	public function beforeSave($options = array()) {
        $this->data['NewsFile']['date'] = date('Y-m-d');
		$this->data['NewsFile']['time'] = date('H:i:s');
		$this->data['NewsFile']['author_id'] = AuthComponent::user('id');
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
