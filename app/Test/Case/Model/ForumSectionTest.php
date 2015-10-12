<?php
App::uses('ForumSection', 'Model');

/**
 * ForumSection Test Case
 *
 */
class ForumSectionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.forum_section',
		'app.forum_forum'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ForumSection = ClassRegistry::init('ForumSection');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ForumSection);

		parent::tearDown();
	}

}
