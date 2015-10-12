<?php
App::uses('RecommendedGallery', 'Model');

/**
 * RecommendedGallery Test Case
 *
 */
class RecommendedGalleryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recommended_gallery',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RecommendedGallery = ClassRegistry::init('RecommendedGallery');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RecommendedGallery);

		parent::tearDown();
	}

}
