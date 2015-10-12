<?php
App::uses('NewsCategory', 'Model');

/**
 * NewsCategory Test Case
 *
 */
class NewsCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsCategory = ClassRegistry::init('NewsCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsCategory);

		parent::tearDown();
	}

}
