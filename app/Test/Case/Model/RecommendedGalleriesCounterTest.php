<?php
App::uses('RecommendedGalleriesCounter', 'Model');

/**
 * RecommendedGalleriesCounter Test Case
 *
 */
class RecommendedGalleriesCounterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.recommended_galleries_counter',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RecommendedGalleriesCounter = ClassRegistry::init('RecommendedGalleriesCounter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RecommendedGalleriesCounter);

		parent::tearDown();
	}

}
