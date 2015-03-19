<?php namespace Garbee\TranslateCron;

class CronTest extends \PHPUnit_Framework_TestCase {

    /**
     * @covers \Garbee\TranslateCron\Cron::__construct
     * @expectedException \Garbee\TranslateCron\Exceptions\InvalidExpression
     */
    public function testExceptionIsRaisedForInvalidCronArgument() {
        new Cron('* *');
    }
}
