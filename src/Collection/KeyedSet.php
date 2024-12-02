<?php

namespace Dontdrinkandroot\Common\Collection;

use Closure;
use Override;

/**
 * @template TKey
 * @template T
 * @extends Set<T>
 */
interface KeyedSet extends Set
{
    /**
     * @param TKey $key
     * @return T|null
     */
    public function getByKey(mixed $key): mixed;

    /**
     * @param TKey $key
     * @return T
     */
    public function fetchByKey(mixed $key): mixed;

    /** @param TKey $key */
    public function containsKey(mixed $key): bool;

    /** @param TKey $key */
    public function removeByKey(mixed $key): bool;

    /**
     * @return KeyedSet<TKey, T>
     */
    #[Override]
    public function filter(Closure $filterFn): KeyedSet;
}
