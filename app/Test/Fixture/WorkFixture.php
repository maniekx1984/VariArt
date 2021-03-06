<?php
/**
 * WorkFixture
 *
 */
class WorkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'file_name' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'w' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'h' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'w_m' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'h_m' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'w_sm' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'h_sm' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'title' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'gallery_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'time' => array('type' => 'time', 'null' => false, 'default' => null),
		'rate' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'work_views' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'is_for_of_age' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'category' => array('column' => 'category_id', 'unique' => 0),
			'user_gallery' => array('column' => 'gallery_id', 'unique' => 0),
			'user_id' => array('column' => 'user_id', 'unique' => 0)
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
			'user_id' => 1,
			'file_name' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'w' => 1,
			'h' => 1,
			'w_m' => 1,
			'h_m' => 1,
			'w_sm' => 1,
			'h_sm' => 1,
			'title' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'category_id' => 1,
			'gallery_id' => 1,
			'date' => '2014-08-01',
			'time' => '22:38:29',
			'rate' => 1,
			'work_views' => 1,
			'is_for_of_age' => 1
		),
	);

}
