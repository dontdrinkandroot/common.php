<?php

namespace Dontdrinkandroot\Common;

/**
 * @template T
 */
class Counted
{
    /**
     * @param T $value
     * @param int $count
     */
    public function __construct(
        public readonly mixed $value,
        public readonly int $count
    ) {
    }
}
