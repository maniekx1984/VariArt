<?php
App::uses('Atelier', 'Model');

/**
 * Atelier Test Case
 *
 */
class AtelierTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->Atelier = ClassRegistry::init('Atelier');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Atelier);

		parent::tearDown();
	}

}
