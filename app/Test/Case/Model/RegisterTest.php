<?php
App::uses('Register', 'Model');

/**
 * Register Test Case
 *
 */
class RegisterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.register',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Register = ClassRegistry::init('Register');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Register);

		parent::tearDown();
	}

}
