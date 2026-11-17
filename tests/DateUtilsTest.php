<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class DateUtilsTest extends TestCase
{
    /**
     * @dataProvider millisProvider
     */
    public function testFromAndToMillis(int $millis): void
    {
        $dateTime = DateUtils::fromMillis($millis);

        self::assertSame($millis, DateUtils::toMillis($dateTime));
    }

    /**
     * @return array<string, array{int}>
     */
    public static function millisProvider(): array
    {
        return [
            'epoch' => [0],
            'no remainder' => [1794940406000],
            'one millisecond' => [1794940406001],
            'single digit remainder' => [1794940406006],
            'two digit remainder' => [1794940406012],
            'eighty-five' => [1794940406085],
            'ninety-nine' => [1794940406099],
            'three digit remainder with trailing zeros' => [1794940406100],
            'three digit remainder' => [1794940406123],
            'seven hundred and eighty-nine' => [1794940406789],
            'max remainder' => [1794940406999],
            'previously used test value' => [123456789],
            'one millisecond before epoch' => [-1],
            'pre-1970' => [-1500],
            'pre-1970 with remainder' => [-1999],
            'pre-1970 without remainder' => [-2000],
        ];
    }

    /**
     * The fraction must be rendered as milliseconds, not as a decimal fraction of a second.
     */
    public function testFromMillisRendersExactFraction(): void
    {
        self::assertSame('1794940406.006', DateUtils::fromMillis(1794940406006)->format('U.v'));
        self::assertSame('006000', DateUtils::fromMillis(1794940406006)->format('u'));
        self::assertSame('1794940406.600', DateUtils::fromMillis(1794940406600)->format('U.v'));
        self::assertSame('1970-01-01 00:00:00.000', DateUtils::fromMillis(0)->format('Y-m-d H:i:s.v'));
        self::assertSame('-2.500', DateUtils::fromMillis(-1500)->format('U.v'));
    }

    /**
     * Every remainder below one second must survive the round trip, on both sides of the epoch.
     */
    public function testEveryMillisecondRemainderIsExact(): void
    {
        // 1794940406000 covers the future, -1000 covers the whole second directly before the epoch.
        foreach ([1794940406000, -1000] as $base) {
            for ($offset = 0; $offset < 1000; ++$offset) {
                $millis = $base + $offset;

                self::assertSame($millis, DateUtils::toMillis(DateUtils::fromMillis($millis)));
            }
        }
    }
}
