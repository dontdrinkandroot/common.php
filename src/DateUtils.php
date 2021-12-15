<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use DateTimeInterface;

class DateUtils
{
    public static function currentMillis(): int
    {
        $microtime = explode(' ', microtime());
        return ((int)$microtime[1]) * 1000 + ((int)round(((float)$microtime[0]) * 1000));
    }

    public static function fromMillis(int $millis): DateTimeInterface
    {
        return DateTime::createFromFormat('U.v', ((int)($millis / 1000)) . "." . ($millis % 1000));
    }

    public static function toMillis(DateTimeInterface $dateTime): int
    {
        return (((int)$dateTime->format('U')) * 1000) + ((int)$dateTime->format('v'));
    }
}
