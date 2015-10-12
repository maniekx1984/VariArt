<?php
App::uses('ArchiveOfMessage', 'Model');

/**
 * ArchiveOfMessage Test Case
 *
 */
class ArchiveOfMessageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.archive_of_message',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ArchiveOfMessage = ClassRegistry::init('ArchiveOfMessage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ArchiveOfMessage);

		parent::tearDown();
	}

}
