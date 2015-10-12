<?php
App::uses('ForumTopic', 'Model');

/**
 * ForumTopic Test Case
 *
 */
class ForumTopicTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->ForumTopic = ClassRegistry::init('ForumTopic');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ForumTopic);

		parent::tearDown();
	}

}
