<?php
/**
 * RecommendedGalleryFixture
 *
 */
class RecommendedGalleryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'moderator_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'time' => array('type' => 'time', 'null' => false, 'default' => null),
		'gallery_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'is_show' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 1, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'moderator_id' => array('column' => 'moderator_id', 'unique' => 0),
			'gallery_id' => array('column' => 'gallery_id', 'unique' => 0)
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
			'moderator_id' => 1,
			'date' => '2014-08-08',
			'time' => '20:34:47',
			'gallery_id' => 1,
			'is_show' => 1
		),
	);

}
