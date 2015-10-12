<?php
App::uses('AppModel', 'Model');
/**
 * ForumTopic Model
 *
 * @property ForumSection $Section
 * @property User $Author
 */
class Topic extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'This field can\'t be blank.'
            ),
        ),
        'forum_id' => array(
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
	
	
	public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'topic_id',
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
