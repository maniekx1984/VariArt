<?php
App::uses('ForumPost', 'Model');

/**
 * ForumPost Test Case
 *
 */
class ForumPostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.forum_post',
		'app.forum_topic',
		'app.forum_section',
		'app.forum_forum',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ForumPost = ClassRegistry::init('ForumPost');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ForumPost);

		parent::tearDown();
	}

}
