<?php
App::uses('NewsComment', 'Model');

/**
 * NewsComment Test Case
 *
 */
class NewsCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.news_comment',
		'app.news',
		'app.user',
		'app.news_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NewsComment = ClassRegistry::init('NewsComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewsComment);

		parent::tearDown();
	}

}
