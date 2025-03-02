<?php

namespace Dontdrinkandroot\Common;

class ArrayUtils
{
    /**
     * @param mixed[] $array
     * @phpstan-assert-if-false non-empty-array<mixed> $array
     */
    public static function isEmpty(array $array): bool
    {
        return 0 === count($array);
    }
}
