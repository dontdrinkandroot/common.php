<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use DateTimeInterface;
use InvalidArgumentException;

class Random
{
    final public const string STR_LOWER = 'abcdefghijklmnopqrstuvwxyz';
    final public const string STR_UPPER = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    final public const string STR_DIGIT = '0123456789';
    final public const string STR_ALNUM = self::STR_LOWER . self::STR_UPPER . self::STR_DIGIT;

    /**
     * @param non-negative-int $minLength
     * @param non-negative-int $maxLength
     * @param non-empty-string $characters
     */
    public static function string(
        int $minLength,
        int $maxLength,
        string $characters = self::STR_ALNUM
    ): string {
        /** @var positive-int $charactersLength */
        $charactersLength = mb_strlen($characters);
        $randomString = '';
        if ($minLength > $maxLength) {
            throw new InvalidArgumentException('Min length must be less than or equal to max length');
        }
        /** @phpstan-ignore argument.type */
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
