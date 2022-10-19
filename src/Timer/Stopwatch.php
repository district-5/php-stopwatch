<?php

/**
 * District5 Timer Library
 *
 * @author      District5 <hello@district5.co.uk>
 * @copyright   District5 <hello@district5.co.uk>
 * @link        https://www.district5.co.uk
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace District5\Timer;

/**
 * Stopwatch
 *
 * A pseudo stopwatch object for working with second resolution timing
 */
class Stopwatch
{
    protected $maxTimeSeconds = null;
    protected $startTime = -1;
    protected $isRunning = false;
    protected $pausedCumulative = 0;

    /**
     * Creates a new instance of Stopwatch
     *
     * @param int|null $maxTimeSeconds
     */
    public function __construct(int $maxTimeSeconds = null)
    {
        $this->reset($maxTimeSeconds);
    }

    /**
     * Checks if this stopwatch is running.
     *
     * @return bool
     */
    public function isRunning(): bool
    {
        return $this->isRunning;
    }

    /**
     * Starts this stopwatch.
     *
     * @return void
     */
    public function start(): void
    {
        if ($this->isRunning === true) {
            return;
        }

        $this->startTime = $this->getSecondsSinceEpoch();
        $this->isRunning = true;
    }

    /**
     * Pauses this stopwatch.
     *
     * @return void
     */
    public function pause(): void
    {
        if ($this->isRunning === false) {
            return;
        }

        $now = $this->getSecondsSinceEpoch();
        $timePassedSeconds = $now - $this->startTime;
        $this->pausedCumulative += $timePassedSeconds;

        $this->startTime = -1;
        $this->isRunning = false;
    }

    /**
     * Resets this stopwatch for reuse.
     *
     * @param int|null $maxTimeSeconds
     *
     * @return void
     */
    public function reset(int $maxTimeSeconds = null)
    {
        $this->startTime = -1;
        $this->isRunning = false;
        $this->maxTimeSeconds = $maxTimeSeconds;
        $this->pausedCumulative = 0;
    }

    /**
     * Checks how many seconds have passed on this stopwatch.
     *
     * @return int The number of seconds passed.
     */
    public function secondsPassed(): int
    {
        $now = $this->getSecondsSinceEpoch();
        $timePassedSeconds = $now - $this->startTime;

        return $this->pausedCumulative + $timePassedSeconds;
    }

    /**
     * Checks if this stopwatch has passed its max time
     *
     * NOTE: if a max time was not set when creating or last resetting the stopwatch, this will always return false
     *
     * @return bool True if the max time has passed, false otherwise
     */
    public function hasMaxTimePassed(): bool
    {
        if ($this->maxTimeSeconds === null) {
            return false;
        }

        return $this->secondsPassed() > $this->maxTimeSeconds;
    }

    /**
     * Gets the number of seconds since the epoch.
     *
     * @return int The number of seconds since the epoch.
     */
    private function getSecondsSinceEpoch(): int
    {
        return time();
    }
}
