<?php
App::uses('Entree', 'Model');

/**
 * Entree Test Case
 *
 */
class EntreeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entree',
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
		$this->Entree = ClassRegistry::init('Entree');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entree);

		parent::tearDown();
	}

}
