# nanaweb/clock

## Install

```bash
$ composer require nanaweb/clock
```

## Usage

### now()

Inject to classes that needs current timestamp, and call `$this->clock->now()` to get current timestamp.

```php
<?php

class SomeClass
{
    private $clock;

    public function __construct(\Nanaweb\Clock $clock)
    {
        $this->clock = $clock;
    }

    public function getFiveHourLater()
    {
        /** @var \DateTimeImmutable $now */
        $now = $this->clock->now();

        return $now->add(new \DateInterval('PT5H')); //
    }
}
```

### today()

Inject to classes that needs current date, and call `$this->clock->today()` to get current date.

```php
<?php

class SomeClass2
{
    private $clock;

    public function __construct(\Nanaweb\Clock $clock)
    {
        $this->clock = $clock;
    }

    public function getFiveDaysAgo()
    {
        /** @var \DateTimeImmutable $today */
        $today = $this->clock->today();

        return $today->sub(new \DateInterval('P5D')); // 00:00:00 of five days ago
    }
}
```

### why should I use Clock?

To test time-sensitive classes.

```php
<?php

class SomeClassTest extends TestCase
{
    public function test_fiveHoursAgo()
    {
        $clockP = $this->prophesize(\Nanaweb\Clock::class);
        $clockP->now()->willReturn(new \DateTimeImmutable('2020-05-16 10:00:00'))->shouldBeCalled();

        $SUT = new SomeClass($clockP->reveal());
        $this->assertEquals('2020-05-16 15:00:00', $SUT->getFiveHoursLater());
    }
}
```
