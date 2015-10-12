<?php
App::uses('AppModel', 'Model');
/**
 * WorksComment Model
 *
 * @property Work $Work
 * @property User $Author
 */
class WorksComment extends AppModel {

	public function beforeSave($options = array()) {
        if(empty($this->data['WorksComment']['date']) AND empty($this->data['WorksComment']['time']) AND empty($this->data['WorksComment']['author_id'])){
	        $this->data['WorksComment']['date'] = date('Y-m-d');
			$this->data['WorksComment']['time'] = date('H:i:s');
			$this->data['WorksComment']['author_id'] = AuthComponent::user('id');
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
		'Work' => array(
			'className' => 'Work',
			'foreignKey' => 'work_id',
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
