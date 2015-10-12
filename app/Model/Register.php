<?php
App::uses('AppModel', 'Model');
/**
 * Register Model
 *
 * @property User $Moderator
 */
class Register extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'register';

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
		'Moderator' => array(
			'className' => 'User',
			'foreignKey' => 'moderator_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
