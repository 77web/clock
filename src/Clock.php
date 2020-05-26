<?php

namespace Nanaweb\Clock;

class Clock
{
    /**
     * @var string
     */
    private $timezone;

    /**
     * @param ?string $timezone
     */
    public function __construct(?string $timezone = null)
    {
        $this->timezone = $timezone ?? 'Asia/Tokyo';
    }


    public function today()
    {
        return $this->now()->setTime(0,0,0);
    }

    public function now()
    {
        return new \DateTimeImmutable('', new \DateTimeZone($this->timezone));
    }
}
