<?php
App::uses('AppModel', 'Model');
/**
 * ForumSection Model
 *
 * @property ForumForum $Forum
 */
class Forum extends AppModel {


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
    );
	
	public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'forum_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        ),
        'Topic' => array(
            'className' => 'Topic',
            'foreignKey' => 'forum_id',
            'dependent' => false,
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'exclusive' => '',
            'finderQuery' => '',
            'counterQuery' => ''
        )
    );


}
