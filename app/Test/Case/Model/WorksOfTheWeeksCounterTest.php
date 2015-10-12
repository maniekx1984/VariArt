<?php
App::uses('WorksOfTheWeeksCounter', 'Model');

/**
 * WorksOfTheWeeksCounter Test Case
 *
 */
class WorksOfTheWeeksCounterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.works_of_the_weeks_counter',
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
		$this->WorksOfTheWeeksCounter = ClassRegistry::init('WorksOfTheWeeksCounter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorksOfTheWeeksCounter);

		parent::tearDown();
	}

}
