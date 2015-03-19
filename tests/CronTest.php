<?php namespace Garbee\TranslateCron;

class CronTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     * @expectedException \Garbee\TranslateCron\Exceptions\InvalidExpression
     */
    public function testExceptionIsRaisedForInvalidCronArgument()
    {
        new Cron('* *');
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     */
    public function testObjectCanBeConstructedWithValidArgument()
    {
        $cron = new Cron('5 6 3 2 2');;

        $this->assertInstanceOf(Cron::class, $cron);
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     */
    public function testObjectCanBeConstructedWithValidArgument2()
    {
        $cron = new Cron('* * * * * *');

        $this->assertInstanceOf(Cron::class, $cron);
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::minutes
     */
    public function testMinutesCanBeRetrieved()
    {
        $cron = new Cron('5 6 3 2 2 2019');
        $this->assertEquals('5', $cron->minutes()[0]);
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::hours
     */
    public function testHoursCanBeRetrieved()
    {
        $cron = new Cron('5 6 3 2 2 2019');
        $this->assertEquals('6', $cron->hours()[0]);
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::daysOfMonth
     */
    public function testDaysOfMonthCanBeRetrieved()
    {
        $cron = new Cron('5 6 3 2 2 2019');
        $this->assertEquals('3', $cron->daysOfMonth()[0]);
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::months
     */
    public function testMonthsCanBeRetrieved()
    {
        $cron = new Cron('5 6 3 2 2 2019');
        $this->assertEquals('February', $cron->months()[0]);
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::daysOfWeek
     */
    public function testDaysOfWeekCanBeRetrieved()
    {
        $cron = new Cron('5 6 3 2 2 2019');
        $this->assertEquals('Tuesday', $cron->daysOfWeek()[0]);
    }

}
