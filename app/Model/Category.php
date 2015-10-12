<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class Category extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	public $hasMany = array(
        'Work' => array(
            'className' => 'Work',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'order' => ''
        )
    );
	

}
