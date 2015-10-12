<?php
App::uses('Galery', 'Model');

/**
 * Galery Test Case
 *
 */
class GaleryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.galery',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Galery = ClassRegistry::init('Galery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Galery);

		parent::tearDown();
	}

}
