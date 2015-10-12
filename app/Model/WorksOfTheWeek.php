<?php
App::uses('AppModel', 'Model');
/**
 * WorksOfTheWeek Model
 *
 * @property Work $Work
 * @property WorksOfTheWeeksWeek $Week
 */
class WorksOfTheWeek extends AppModel {

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
		'Week' => array(
			'className' => 'WorksOfTheWeeksWeek',
			'foreignKey' => 'week_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Voter' => array(
			'className' => 'User',
			'foreignKey' => 'voter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
