<?php
App::uses('ForumForum', 'Model');

/**
 * ForumForum Test Case
 *
 */
class ForumForumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.forum_forum'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ForumForum = ClassRegistry::init('ForumForum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ForumForum);

		parent::tearDown();
	}

}
