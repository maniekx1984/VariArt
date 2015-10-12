<?php
App::uses('AteliersPhoto', 'Model');

/**
 * AteliersPhoto Test Case
 *
 */
class AteliersPhotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ateliers_photo',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AteliersPhoto = ClassRegistry::init('AteliersPhoto');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AteliersPhoto);

		parent::tearDown();
	}

}
