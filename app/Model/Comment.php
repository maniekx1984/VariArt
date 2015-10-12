<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property User $Author
 * @property User $Gallery
 */
class Comment extends AppModel {

	public function beforeSave($options = array()) {
        if(empty($this->data['Comment']['date']) AND empty($this->data['Comment']['time']) AND empty($this->data['Comment']['author_id'])){
	        $this->data['Comment']['date'] = date('Y-m-d');
			$this->data['Comment']['time'] = date('H:i:s');
			$this->data['Comment']['author_id'] = AuthComponent::user('id');
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
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gallery' => array(
			'className' => 'User',
			'foreignKey' => 'gallery_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
