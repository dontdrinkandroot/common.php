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

    public static function string(mixed $value): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException('Provided value must be a string');
        }

        return $value;
    }

    public static function stringOrNull(mixed $value): ?string
    {
        if (null === $value) {
            return null;
        }

        return self::string($value);
    }

    public static function int(mixed $value, ?string $message = null): int
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException($message ?? 'Provided value must be a int');
        }

        return $value;
    }

    public static function intOrNull(mixed $value, ?string $message = null): ?int
    {
        if (null === $value) {
            return null;
        }

        return self::int($value, $message);
    }

    public static function integerish(mixed $value): int
    {
        $intVal = (int)$value;

        if ((string)$intVal != (string)$value) {
            throw new InvalidArgumentException('Provided value must be integerish');
        }

        return $intVal;
    }

    public static function integerishOrNull(mixed $value): ?int
    {
        if (null === $value) {
            return null;
        }

        return self::integerish($value);
    }

    public static function float(mixed $value, ?string $message = null): float
    {
        if (!is_float($value)) {
            throw new InvalidArgumentException($message ?? 'Provided value must be a float');
        }

        return $value;
    }

    public static function floatOrNull(mixed $value, ?string $message = null): ?float
    {
        if (null === $value) {
            return null;
        }

        return self::float($value, $message);
    }

    public static function floatish(mixed $value): float
    {
        $floatVal = (float)$value;

        if ((string)$floatVal != (string)$value) {
            throw new InvalidArgumentException('Provided value must be floatish');
        }

        return $floatVal;
    }

    public static function floatishOrNull(mixed $value): ?float
    {
        if (null === $value) {
            return null;
        }

        return self::floatish($value);
    }

    public static function array(mixed $value, ?string $message = null): array
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException($message ?? 'Provided value must be an array');
        }

        return $value;
    }

    public static function arrayOrNull(mixed $value, ?string $message = null): ?array
    {
        if (null === $value) {
            return null;
        }

        return self::array($value, $message);
    }

    public static function bool(mixed $value, ?string $message = null): bool
    {
        if (!is_bool($value)) {
            throw new InvalidArgumentException($message ?? 'Provided value must be a bool');
        }

        return $value;
    }

    public static function boolOrNull(mixed $value, ?string $message = null): ?bool
    {
        if (null === $value) {
            return null;
        }

        return self::bool($value, $message);
    }

    /**
     * @template T of object
     *
     * @param mixed           $value
     * @param class-string<T> $class
     *
     * @return T
     */
    public static function instanceOf(mixed $value, string $class): object
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
