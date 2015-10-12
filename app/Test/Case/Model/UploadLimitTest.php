<?php
App::uses('UploadLimit', 'Model');

/**
 * UploadLimit Test Case
 *
 */
class UploadLimitTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.upload_limit',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->UploadLimit = ClassRegistry::init('UploadLimit');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->UploadLimit);

		parent::tearDown();
	}

}
