<?php

namespace Dontdrinkandroot\Common\Collection;

/**
 * @template T
 * @extends AbstractCollection<T>
 * @implements Set<T>
 */
abstract class AbstractHashSet extends AbstractCollection implements Set
{
    /**
     * {@inheritdoc}
     */
    public function add(mixed $element): bool
    {
        $hash = $this->hash($element);
        if (isset($this->elements[$hash])) {
            return false;
        }

        $this->elements[$hash] = $element;
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(mixed $element): bool
    {
        $hash = $this->hash($element);
        if (isset($this->elements[$hash])) {
            unset($this->elements[$hash]);
            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function contains(mixed $element): bool
    {
        $hash = $this->hash($element);
        return isset($this->elements[$hash]);
    }

    /**
     * @param T $element
     * @return array-key
     */
    protected abstract function hash(mixed $element): int|string;
}
