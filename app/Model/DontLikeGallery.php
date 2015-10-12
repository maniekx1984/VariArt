<?php
App::uses('AppModel', 'Model');
/**
 * DontLikeGallery Model
 *
 * @property User $User
 * @property User $Dontlike
 */
class DontLikeGallery extends AppModel {

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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Dontlike' => array(
			'className' => 'User',
			'foreignKey' => 'dontlike_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
