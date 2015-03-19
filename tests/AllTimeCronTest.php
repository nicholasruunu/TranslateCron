<?php namespace Garbee\TranslateCron;


class AllTimeCronTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var \Garbee\TranslateCron\Cron
     */
    protected $cron;

    protected function setUp() {
        $this->cron = new Cron('* * * * * *');
    }

    /**
     * @covers Garbee\TranslateCron\Cron::minutes
     */
    public function testAllMinutes() {
        $this->assertEquals('Every minute', $this->cron->minutes()[0]);
    }
    /**
     * @covers Garbee\TranslateCron\Cron::hours
     */
    public function testAllHours() {
        $this->assertEquals('Every hour', $this->cron->hours()[0]);
    }

    /**
     * @covers Garbee\TranslateCron\Cron::years
     */
    public function testAllYears() {
        $this->assertEquals('Every year', $this->cron->years()[0]);
    }

    /**
     * @covers Garbee\TranslateCron\Cron::months
     */
    public function testAllMonths() {
        $this->assertEquals('Every month', $this->cron->months()[0]);
    }

    /**
     * @covers Garbee\TranslateCron\Cron::daysOfWeek
     */
    public function testAllDaysOfWeek() {
        $this->assertEquals('Every day of the week', $this->cron->daysOfWeek()[0]);
    }

    /**
     * @covers Garbee\TranslateCron\Cron::daysOfMonth
     */
    public function testAllDaysOfTheMonth() {
        $this->assertEquals('Every day of the month', $this->cron->daysOfMonth()[0]);
    }

}
