<?php namespace Garbee\TranslateCron;


class RecurringTimeCronTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Cron
     */
    protected $cron;

    protected function setUp() {
        $this->cron = new Cron('*/5 */2 */2 */3 0/2 */8');
    }

    public function testMinutes(){
        $this->assertEquals('Every 5 minutes', $this->cron->minutes()[0]);
    }

    public function testHours(){
        $this->assertEquals('Every 2 hours', $this->cron->hours()[0]);
    }

    public function testDaysOfMonth(){
        $this->assertEquals('Every 2 days of the month', $this->cron->daysOfMonth()[0]);
    }

    public function testMonths(){
        $this->assertEquals('Every 3 months', $this->cron->months()[0]);
    }

    //public function testDaysOfWeek(){}

    public function testYears(){
        $this->assertEquals('Every 8 years', $this->cron->years()[0]);
    }
}
