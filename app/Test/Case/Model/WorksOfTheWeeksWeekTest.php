<?php
App::uses('WorksOfTheWeeksWeek', 'Model');

/**
 * WorksOfTheWeeksWeek Test Case
 *
 */
class WorksOfTheWeeksWeekTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.works_of_the_weeks_week'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WorksOfTheWeeksWeek = ClassRegistry::init('WorksOfTheWeeksWeek');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorksOfTheWeeksWeek);

		parent::tearDown();
	}

}
