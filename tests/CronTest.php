<?php namespace Garbee\TranslateCron;

class CronTest extends \PHPUnit_Framework_TestCase {

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     * @expectedException \Garbee\TranslateCron\Exceptions\InvalidExpression
     */
    public function testExceptionIsRaisedForInvalidCronArgument() {
        new Cron('* *');
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     */
    public function testObjectCanBeConstructedWithValidArgument() {
        $cron = new Cron('*, *, 3, *, *');

        $this->assertInstanceOf(Cron::class, $cron);

        return $cron;
    }

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     */
    public function testObjectCanBeConstructedWithValidArgument2() {
        $cron = new Cron('*, *, *, *, *, *');

        $this->assertInstanceOf(Cron::class, $cron);

        return $cron;
    }
}
