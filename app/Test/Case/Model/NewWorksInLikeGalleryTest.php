<?php
App::uses('NewWorksInLikeGallery', 'Model');

/**
 * NewWorksInLikeGallery Test Case
 *
 */
class NewWorksInLikeGalleryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.new_works_in_like_gallery',
		'app.user',
		'app.work',
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
		$this->NewWorksInLikeGallery = ClassRegistry::init('NewWorksInLikeGallery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NewWorksInLikeGallery);

		parent::tearDown();
	}

}
