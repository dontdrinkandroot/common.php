<?php

namespace Dontdrinkandroot\Common;

use InvalidArgumentException;

class Asserted
{
    /**
     * @template T
     *
     * @param T|null $value
     *
     * @return T
     */
    public static function notNull($value)
    {
        if (null === $value) {
            throw new InvalidArgumentException('Provided value must not be null');
        }

        return $value;
    }

    /** @param mixed $value */
    public static function string($value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Provided value must be a string');
        }

        return $value;
    }

    /** @param mixed $value */
    public static function stringOrNull($value): ?string
    {
        if (null === $value) {
            return null;
        }

        return self::string($value);
    }

    /** @param mixed $value */
    public static function integerish($value): int
    {
        $intVal = (int)$value;

        if ((string)$intVal != (string)$value) {
            throw new InvalidArgumentException('Provided value must be integerish');
        }

        return $intVal;
    }

    /** @param mixed $value */
    public static function integerishOrNull($value): ?int
    {
        if (null === $value) {
            return null;
        }

        return self::integerish($value);
    }

    /** @param mixed $value */
    public static function floatish($value): float
    {
        $floatVal = (float)$value;

        if ((string)$floatVal != (string)$value) {
            throw new InvalidArgumentException('Provided value must be floatish');
        }

        return $floatVal;
    }

    /** @param mixed $value */
    public static function floatishOrNull($value): ?float
    {
        if (null === $value) {
            return null;
        }

        return self::floatish($value);
    }

    /**
     * @template T of object
     *
     * @param mixed           $value
     * @param class-string<T> $class
     *
     * @return T
     */
    public static function instanceOf(object $value, string $class): object
    {
        if (!$value instanceof $class) {
            throw new InvalidArgumentException('Provided value must not be of class ' . $class);
        }

        return $value;
    }

    /**
     * @template T of object
     *
     * @param mixed|null      $value
     * @param class-string<T> $class
     *
     * @return T|null
     */
    public static function instanceOfOrNull(?object $value, string $class): ?object
    {
        if (null === $value) {
            return null;
        }

        return self::instanceOf($value, $class);
    }
}
