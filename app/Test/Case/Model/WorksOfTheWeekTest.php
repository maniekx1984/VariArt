<?php
App::uses('WorksOfTheWeek', 'Model');

/**
 * WorksOfTheWeek Test Case
 *
 */
class WorksOfTheWeekTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.works_of_the_week',
		'app.work',
		'app.user',
		'app.category',
		'app.gallery',
		'app.works_of_the_weeks_week'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->WorksOfTheWeek = ClassRegistry::init('WorksOfTheWeek');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->WorksOfTheWeek);

		parent::tearDown();
	}

}
