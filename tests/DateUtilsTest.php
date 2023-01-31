<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use PHPUnit\Framework\TestCase;

class DateUtilsTest extends TestCase
{
    public function testFromAndToMillis(): void
    {
        $millis = DateUtils::toMillis(new DateTime());
        $dateTime = DateUtils::fromMillis($millis);
        self::assertEqualsWithDelta($millis, DateUtils::toMillis($dateTime), 1000);
    }
}
