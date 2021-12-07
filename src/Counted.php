<?php

namespace Dontdrinkandroot\Common;

/**
 * @template T
 */
class Counted
{
    /**
     * @param T   $value
     * @param int $count
     */
    public function __construct(
        private $value,
        private int $count
    ) {
    }

    /** @return T */
    public function getValue()
    {
        return $this->value;
    }

    public function getCount(): int
    {
        return $this->count;
    }
}
