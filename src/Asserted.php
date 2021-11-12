<?php

namespace Dontdrinkandroot\Common;

use RuntimeException;

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
            throw new RuntimeException('Provided value must not be null');
        }

        return $value;
    }

    /** @param mixed $value */
    public static function string($value): string
    {
        if (!is_string($value)) {
            throw new RuntimeException('Provided value must be a string');
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

    /**
     * @template T of object
     *
     * @param T               $value
     * @param class-string<T> $class
     *
     * @return T
     */
    public static function instanceOf(object $value, string $class): object
    {
        if (!$value instanceof $class) {
            throw new RuntimeException('Provided value must not be of class ' . $class);
        }

        return $value;
    }

    /**
     * @template T of object
     *
     * @param T|null          $value
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
