<?php
App::uses('AppModel', 'Model');
/**
 * Message Model
 *
 * @property User $Mfrom
 * @property User $Mto
 */
class Message extends AppModel {

	public function beforeSave($options = array()) {
        if(empty($this->data['Message']['date']) AND empty($this->data['Message']['time']) AND empty($this->data['Message']['m_from']) AND empty($this->data['Message']['is_read'])){
	        $this->data['Message']['date'] = date('Y-m-d');
			$this->data['Message']['time'] = date('H:i:s');
			$this->data['Message']['m_from'] = AuthComponent::user('id');
			$this->data['Message']['is_read'] = "0";
		}
		if(isset($this->data['Message']['mtos'])){
			$this->data['Message']['m_to'] = $this->data['Message']['mtos'];
		}
		return true;
    }


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';



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
		'm_text' => array(
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
		'Mfrom' => array(
			'className' => 'User',
			'foreignKey' => 'm_from',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Mto' => array(
			'className' => 'User',
			'foreignKey' => 'm_to',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
