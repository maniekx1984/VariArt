<?php
/**
 * NewsFileFixture
 *
 */
class NewsFileFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'news_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'w' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'h' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'author_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'time' => array('type' => 'time', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'author_id' => array('column' => 'author_id', 'unique' => 0),
			'news_id' => array('column' => 'news_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'news_id' => 1,
			'w' => 1,
			'h' => 1,
			'author_id' => 1,
			'date' => '2014-08-08',
			'time' => '20:27:47'
		),
	);

}
