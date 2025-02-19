<?php

namespace Dontdrinkandroot\Common;

use InvalidArgumentException;

class Asserted
{
    /**
     * @template T
     * @param T|null $value
     * @return T
     * @phpstan-assert !null $value
     */
    public static function notNull(mixed $value, ?string $message = null)
    {
        if (null === $value) {
            throw new InvalidArgumentException($message ?? 'Provided value must not be null');
        }

        return $value;
    }

    /**
     * @phpstan-assert !null $value
     */
    public static function string(mixed $value, ?string $message = null): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be a string but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @phpstan-assert string|null $value
     */
    public static function stringOrNull(mixed $value, ?string $message = null): ?string
    {
        if (null === $value) {
            return null;
        }

        return self::string($value, $message);
    }

    /**
     * @return non-empty-string
     * @phpstan-assert non-empty-string $value
     */
    public static function nonEmptyString(mixed $value, ?string $message = null): string
    {
        if (!is_string($value) || '' === $value) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be a non empty string, was ' . gettype($value)
            );
        }

        return $value;
    }

    /**
     * @phpstan-assert int $value
     */
    public static function int(mixed $value, ?string $message = null): int
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be an int but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @phpstan-assert int|null $value
     */
    public static function intOrNull(mixed $value, ?string $message = null): ?int
    {
        if (null === $value) {
            return null;
        }

        return self::int($value, $message);
    }

    /**
     * @return positive-int
     * @phpstan-assert positive-int $value
     */
    public static function positiveInt(mixed $value, ?string $message = null): int
    {
        $intVal = self::int($value);

        if ($intVal < 1) {
            throw new InvalidArgumentException($message ?? 'Provided value must be a positive int');
        }

        return $intVal;
    }

    /**
     * @return positive-int|null
     * @phpstan-assert positive-int|null $value
     */
    public static function positiveIntOrNull(mixed $value, ?string $message = null): ?int
    {
        if (null === $value) {
            return null;
        }

        return self::positiveInt($value, $message);
    }

    public static function integerish(mixed $value, ?string $message = null): int
    {
        $intVal = (int)$value;

        if ((string)$intVal != (string)$value) {
            throw new InvalidArgumentException($message ?? 'Provided value must be integerish');
        }

        return $intVal;
    }

    public static function integerishOrNull(mixed $value, ?string $message = null): ?int
    {
        if (null === $value) {
            return null;
        }

        return self::integerish($value, $message);
    }

    /**
     * @phpstan-assert float $value
     */
    public static function float(mixed $value, ?string $message = null): float
    {
        if (!is_float($value)) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be a float but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @phpstan-assert float|null $value
     */
    public static function floatOrNull(mixed $value, ?string $message = null): ?float
    {
        if (null === $value) {
            return null;
        }

        return self::float($value, $message);
    }

    public static function floatish(mixed $value, ?string $message = null): float
    {
        $floatVal = (float)$value;

        if ((string)$floatVal != (string)$value) {
            throw new InvalidArgumentException($message ?? 'Provided value must be floatish');
        }

        return $floatVal;
    }

    public static function floatishOrNull(mixed $value, ?string $message = null): ?float
    {
        if (null === $value) {
            return null;
        }

        return self::floatish($value, $message);
    }

    /**
     * @phpstan-assert mixed[] $value
     * @return mixed[]
     */
    public static function array(mixed $value, ?string $message = null): array
    {
        if (!is_array($value)) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be an array but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @phpstan-assert mixed[]|null $value
     * @return mixed[]|null
     */
    public static function arrayOrNull(mixed $value, ?string $message = null): ?array
    {
        if (null === $value) {
            return null;
        }

        return self::array($value, $message);
    }

    /**
     * @phpstan-assert bool $value
     */
    public static function bool(mixed $value, ?string $message = null): bool
    {
        if (!is_bool($value)) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be a bool but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @phpstan-assert bool|null $value
     */
    public static function boolOrNull(mixed $value, ?string $message = null): ?bool
    {
        if (null === $value) {
            return null;
        }

        return self::bool($value, $message);
    }

    /**
     * @return iterable<mixed>
     * @phpstan-assert iterable<mixed> $value
     */
    public static function iterable(mixed $value, ?string $message = null): iterable
    {
        if (!is_iterable($value)) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be iterable but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @return iterable<mixed>|null
     * @phpstan-assert iterable<mixed>|null $value
     */
    public static function iterableOrNull(mixed $value, ?string $message = null): ?iterable
    {
        if (null === $value) {
            return null;
        }

        return self::iterable($value, $message);
    }

    /**
     * @template T of object
     * @param class-string<T> $class
     * @return T
     * @phpstan-assert =T $value
     */
    public static function instanceOf(mixed $value, string $class, ?string $message = null): object
    {
        if (!$value instanceof $class) {
            throw new InvalidArgumentException(
                $message ?? 'Provided value must be of class ' . $class . ' but was ' . TypeUtils::getType($value)
            );
        }

        return $value;
    }

    /**
     * @template T of object
     * @param mixed $value
     * @param class-string<T> $class
     * @return T|null
     * @phpstan-assert ?T $value
     */
    public static function instanceOfOrNull(mixed $value, string $class, ?string $message = null): ?object
    {
        if (null === $value) {
            return null;
        }

        return self::instanceOf($value, $class, $message);
    }

    /**
     * @template T
     * @param T|false $value
     * @return T
     * @phpstan-assert !false $value
     */
    public static function notFalse(mixed $value, ?string $message = null): mixed
    {
        if (false === $value) {
            throw new InvalidArgumentException($message ?? 'Provided value must not be false');
        }

        return $value;
    }
}
