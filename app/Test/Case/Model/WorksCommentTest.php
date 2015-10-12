<?php
App::uses('WorksComment', 'Model');

/**
 * WorksComment Test Case
 *
 */
class WorksCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.works_comment',
		'app.work',
		'app.user',
		'app.category',
		'app.gallery'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WorksComment = ClassRegistry::init('WorksComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorksComment);

		parent::tearDown();
	}

}
