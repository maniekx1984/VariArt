<?php
App::uses('DontLikeGallery', 'Model');

/**
 * DontLikeGallery Test Case
 *
 */
class DontLikeGalleryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dont_like_gallery',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DontLikeGallery = ClassRegistry::init('DontLikeGallery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DontLikeGallery);

		parent::tearDown();
	}

}
