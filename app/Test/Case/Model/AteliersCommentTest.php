<?php
App::uses('AteliersComment', 'Model');

/**
 * AteliersComment Test Case
 *
 */
class AteliersCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ateliers_comment',
		'app.atelier',
		'app.user',
		'app.ateliers_comments'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AteliersComment = ClassRegistry::init('AteliersComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AteliersComment);

		parent::tearDown();
	}

}
