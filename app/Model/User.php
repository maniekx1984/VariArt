<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
App::uses('Folder', 'Utility');

/**
 * User Model
 *
 */
class User extends AppModel {

	
	public function beforeSave($options = array()) {
        if (!empty($this->data[$this->alias]['password'])) {
            //$this->data[$this->alias]['password'] = iconv("UTF-8", "ISO-8859-2//TRANSLIT", $this->data[$this->alias]['password']);
            //$this->data[$this->alias]['password'] = md5($this->data[$this->alias]['password']);
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'md5'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }
	
	public function afterSave($created, $options = array()) {
		new Folder(WWW_ROOT.'/img/works/'.$this->data['User']['id'].'', true, 0777);
		new Folder(WWW_ROOT.'/img/works/minis/mini/'.$this->data['User']['id'].'', true, 0777);
		new Folder(WWW_ROOT.'/img/works/minis/supermini/'.$this->data['User']['id'].'', true, 0777);
    }

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Email can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'unique' => array(
	            'rule'    => 'isUnique',
	            'message' => 'Ten email już istnieje w serwisie VariArt.org.',
	            'on' => 'create'
	        )
		),
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Username can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Username must contein only letters and digits.',
                'on' => 'create'
            ),
            'unique' => array(
	            'rule'    => 'isUnique',
	            'message' => 'This Username is already in use.',
	            'on' => 'create'
	        )
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Password can\'t be blank.',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				'on' => 'create'
			),
		),
	);
	
	
	//UWAGA - dododac inne hasmany
	
	public $hasMany = array(
        'Post' => array(
            'className' => 'Post',
            'foreignKey' => 'user_id',
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
            'foreignKey' => 'user_id',
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
