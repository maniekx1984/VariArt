<?php
App::uses('AppModel', 'Model');
/**
 * Entree Model
 *
 * @property Work $Work
 * @property User $Moderator
 */
class Entree extends AppModel {

	public function beforeSave($options = array()) {
        if(empty($this->data['Entree']['date']) AND empty($this->data['Entree']['time'])){
	        $this->data['Entree']['date'] = date('Y-m-d');
			$this->data['Entree']['time'] = date('H:i:s');
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
		'Moderator' => array(
			'className' => 'User',
			'foreignKey' => 'moderator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
