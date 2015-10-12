<?php
App::uses('NewsFile', 'Model');

/**
 * NewsFile Test Case
 *
 */
class NewsFileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_file',
		'app.news',
		'app.user',
		'app.news_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsFile = ClassRegistry::init('NewsFile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsFile);

		parent::tearDown();
	}

}
