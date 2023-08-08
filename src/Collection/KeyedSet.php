<?php

namespace Dontdrinkandroot\Common\Collection;

use Closure;

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
     * {@inheritdoc}
     * @return KeyedSet<TKey, T>
     */
    public function filter(Closure $filterFn): KeyedSet;
}
