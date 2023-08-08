<?php

namespace Dontdrinkandroot\Common\Collection;

use Countable;
use IteratorAggregate;

/**
 * @template T
 * @extends IteratorAggregate<array-key,T>
 */
interface Collection extends Countable, IteratorAggregate
{
    public function isEmpty(): bool;

    /** @return iterable<T> */
    public function values(): iterable;

//    /**
//     * @param Closure(T):bool $filterFn
//     * @return Collection<T>
//     */
//    public function filter(\Closure $filterFn): Collection;
}
