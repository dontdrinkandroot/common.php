<?php

namespace Dontdrinkandroot\Common;

class TypeUtils
{
    /**
     * Asserts that the input is an integerish, otherwise null will be returned.
     */
    public static function integerOrNull(mixed $value): ?int
    {
        $intVal = (int)$value;

        if (
            is_object($value)
            /** @phpstan-ignore notEqual.notAllowed */
            || (string)$intVal != $value
            || is_bool($value)
            || is_null($value)
        ) {
            return null;
        }

        return $intVal;
    }

    public static function getType(mixed $value): string
    {
        if (is_object($value)) {
            return $value::class;
        }

        return gettype($value);
    }
}
