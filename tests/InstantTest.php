<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use PHPUnit\Framework\TestCase;

class InstantTest extends TestCase
{
    public function testNow(): void
    {
        $instant = Instant::now();
        $this->assertLessThanOrEqual(DateUtils::currentMillis(), $instant->getTimestamp());
    }

    public function testFromTimestamp(): void
    {
        $timestamp = 123456789;
        $instant = Instant::fromTimestamp($timestamp);
        $this->assertEquals($timestamp, $instant->getTimestamp());
    }

    public function testAdd(): void
    {
        $instant = Instant::fromTimestamp(123456789);
        $instant->add(1, TimeUnit::SECOND);
        $this->assertEquals(123456789 + 1000, $instant->getTimestamp());
    }

    public function testSub(): void
    {
        $instant = Instant::fromTimestamp(123456789);
        $instant->sub(2, TimeUnit::MINUTE);
        $this->assertEquals(123456789 - (2 * 60 * 1000), $instant->getTimestamp());
    }

    public function testPlus(): void
    {
        $instant = Instant::fromTimestamp(123456789);
        $instant = $instant->plus(3, TimeUnit::HOUR);
        $this->assertEquals(123456789 + (3 * 60 * 60 * 1000), $instant->getTimestamp());
    }

    public function testMinus(): void
    {
        $instant = Instant::fromTimestamp(123456789);
        $instant = $instant->minus(4, TimeUnit::DAY);
        $this->assertEquals(123456789 - (4 * 24 * 60 * 60 * 1000), $instant->getTimestamp());
    }

    public function testGetDateTime(): void
    {
        $instant = Instant::fromTimestamp(123456789);
        $dateTime = $instant->getDateTime();
        $this->assertEquals(123456789, DateUtils::toMillis($dateTime));
    }

    public function testGetUnixTimestamp(): void
    {
        $instant = Instant::fromTimestamp(123456789);
        $this->assertEquals(123456, $instant->getUnixTimestamp());
    }

    public function testFromDateTime(): void
    {
        $dateTime = new DateTime('2021-01-01 12:34:56.789');
        $instant = Instant::fromDateTime($dateTime);
        $this->assertEquals(1609504496789, $instant->getTimestamp());
    }
}
