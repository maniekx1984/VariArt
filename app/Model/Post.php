<?php
App::uses('AppModel', 'Model');
/**
 * ForumPost Model
 *
 * @property ForumTopic $Topic
 * @property User $Author
 */
class Post extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	public $validate = array(
        'topic_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),
        'forum_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),
        'content' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty')
            ),
        ),
        'user_id' => array(
            'numeric' => array(
                'rule' => array('numeric')
            ),
        ),
    );


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Topic' => array(
			'className' => 'Topic',
			'foreignKey' => 'topic_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Forum' => array(
			'className' => 'Forum',
			'foreignKey' => 'forum_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
