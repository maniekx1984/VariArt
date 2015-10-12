<?php
App::uses('Work', 'Model');

/**
 * Work Test Case
 *
 */
class WorkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.work',
		'app.user',
		'app.category',
		'app.gallery'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Work = ClassRegistry::init('Work');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Work);

		parent::tearDown();
	}

}
