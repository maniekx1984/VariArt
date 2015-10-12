<?php
App::uses('Online', 'Model');

/**
 * Online Test Case
 *
 */
class OnlineTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.online',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Online = ClassRegistry::init('Online');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Online);

		parent::tearDown();
	}

}
