<?php
App::uses('AppModel', 'Model');
/**
 * News Model
 *
 * @property User $Author
 * @property NewsCategory $Category
 */
class News extends AppModel {

	public function beforeSave($options = array()) {
        if(empty($this->data['News']['date']) AND empty($this->data['News']['time']) AND empty($this->data['News']['author_id'])){
	        $this->data['News']['date'] = date('Y-m-d');
			$this->data['News']['time'] = date('H:i:s');
			$this->data['News']['author_id'] = AuthComponent::user('id');
		}
		return true;
    }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'title' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'lead' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'n_text' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'source' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'This field can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	

	
/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Author' => array(
			'className' => 'User',
			'foreignKey' => 'author_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
        'NewsComment' => array(
            'className' => 'NewsComment',
            'foreignKey' => 'news_id',
            'conditions' => '',
            'order' => ''
        ),
        'NewsFile' => array(
            'className' => 'NewsFile',
            'foreignKey' => 'news_id',
            'conditions' => '',
            'order' => ''
        )
    );
}
