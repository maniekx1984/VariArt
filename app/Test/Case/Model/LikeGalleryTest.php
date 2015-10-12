<?php
App::uses('LikeGallery', 'Model');

/**
 * LikeGallery Test Case
 *
 */
class LikeGalleryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.like_gallery',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LikeGallery = ClassRegistry::init('LikeGallery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LikeGallery);

		parent::tearDown();
	}

}
