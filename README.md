Timer
========================================

## About

This library supports timer functionality.

## Installing

This library requires no other libraries.

```
composer require district5/timer
```

### Running Unit Tests:
```
$ composer install --dev
$ ./vendor/bin/phpunit
```


## Usage

### Stopwatch
The stopwatch class can be instantiated and used to measure time at intervals from stopwatch start:
```php
$stopwatch = new \District5\Timer\Stopwatch();
$stopwatch->start();

...

$secondsPassed = $stopwatch->secondsPassed();
```

You can also set a max time so a boolean check can be made to see if that time has passed. This is useful when working with cron tasks where there is a maximum execution time.
```php
$maxTimeSeconds = 300;

$stopwatch = new \District5\Timer\Stopwatch($maxTimeSeconds);
$stopwatch->start();

while (!$stopwatch->hasMaxTimePassed())
{
    // do some work
}
```
In the above example you should take into account how long an item could take to process an iteration in the while loop to set the max seconds allowed less than the `max time a cron can run` - `time to process 1 loop iteration`.


## Issues
Log a bug report!
