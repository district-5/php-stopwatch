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
}
