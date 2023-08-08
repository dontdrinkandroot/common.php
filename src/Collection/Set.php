<?php

namespace Dontdrinkandroot\Common\Collection;

use Closure;

/**
 * @template T
 * @extends Collection<T>
 */
interface Set extends Collection
{
    /** @param T $element */
    public function add(mixed $element): bool;

    /** @param T $element */
    public function remove(mixed $element): bool;

    /** @param T $element */
    public function contains(mixed $element): bool;

    /**
     * {@inheritdoc}
     * @return Set<T>
     */
    public function filter(Closure $filterFn): Set;
}
