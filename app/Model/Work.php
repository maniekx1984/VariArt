<?php
App::uses('AppModel', 'Model');
/**
 * Work Model
 *
 * @property User $User
 * @property Category $Category
 * @property Gallery $Gallery
 */
class Work extends AppModel {


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
        'WorksComment' => array(
            'className' => 'WorksComment',
            'foreignKey' => 'work_id',
            'conditions' => '',
            'order' => ''
        ),
        'Entree' => array(
            'className' => 'Entree',
            'foreignKey' => 'work_id',
            'conditions' => '',
            'order' => ''
        )
    );
}
