<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class RandomTest extends TestCase
{
    public function testString(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $string = Random::string(5, 10);
            self::assertGreaterThanOrEqual(5, strlen($string));
            self::assertLessThanOrEqual(10, strlen($string));
        }

        self::assertEquals('ä', mb_substr('ä', 0, 1));
        self::assertEquals('ööööö', Random::string(5, 5, 'ö'));
    }

    public function testDateTimeBetween(): void
    {
        $start = new DateTime('-3 Month');
        $end = new DateTime('+1 week');
        for ($i = 0; $i < 100; $i++) {
            $date = Random::dateTimeBetween($start, $end);
            self::assertGreaterThanOrEqual($start, $date);
            self::assertLessThanOrEqual($end, $date);
        }
    }

    public function testDateTimeBetweenEndBeforeStart(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('End must be after start');
        Random::dateTimeBetween(new DateTime('+1 week'), new DateTime('-1 week'));
    }
}
