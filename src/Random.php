<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use DateTimeInterface;
use InvalidArgumentException;

class Random
{
    public const STR_LOWER = 'abcdefghijklmnopqrstuvwxyz';
    public const STR_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    public const STR_DIGIT = '0123456789';
    public const STR_ALNUM = self::STR_LOWER . self::STR_UPPER . self::STR_DIGIT;

    public static function string(
        int $minLength,
        int $maxLength,
        string $characters = self::STR_ALNUM
    ): string {
        $charactersLength = mb_strlen($characters);
        $randomString = '';
        $targetLength = random_int($minLength, $maxLength);
        for ($i = 0; $i < $targetLength; $i++) {
            $randomString .= mb_substr($characters, random_int(0, $charactersLength - 1), 1);
        }
        return $randomString;
    }

    public static function dateTimeBetween(DateTimeInterface $start, DateTimeInterface $end): DateTime
    {
        $startTimestamp = $start->getTimestamp();
        $endTimestamp = $end->getTimestamp();
        if ($endTimestamp < $startTimestamp) {
            throw new InvalidArgumentException('End must be after start');
        }
        return (new DateTime())->setTimestamp(random_int($startTimestamp, $endTimestamp));
    }
}
