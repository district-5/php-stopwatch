<?php

namespace District5Tests\TimerTests;

use District5\Timer\Stopwatch;
use PHPUnit\Framework\TestCase;

class StopwatchTest extends TestCase
{
    public function testTimeDifference()
    {
        $stopwatch = new Stopwatch();

        $start = time();
        $stopwatch->start();

        sleep(3);
        $stop = time();
        $secondsPassed = $stopwatch->secondsPassed();

        $this->assertEquals($secondsPassed, $stop - $start);
    }

    public function testTimerMaxTimeHasPassed()
    {
        $stopwatch = new Stopwatch(2);
        $stopwatch->start();

        sleep(3);

        $this->assertTrue($stopwatch->hasMaxTimePassed());
    }

    public function testTimerMaxTimeHasntPassed()
    {
        $stopwatch = new Stopwatch(10);
        $stopwatch->start();

        sleep(3);

        $this->assertFalse($stopwatch->hasMaxTimePassed());
    }
}
