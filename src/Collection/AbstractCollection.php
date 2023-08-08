<?php

namespace Dontdrinkandroot\Common\Collection;

use ArrayIterator;
use Traversable;

/**
 * @template T
 * @implements Collection<T>
 */
abstract class AbstractCollection implements Collection
{
    /** @var array<array-key, T> */
    protected array $elements = [];

    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function values(): array
    {
        return array_values($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function count(): int
    {
        return count($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}
