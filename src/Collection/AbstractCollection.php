<?php

namespace Dontdrinkandroot\Common\Collection;

use ArrayIterator;
use Dontdrinkandroot\Common\ArrayUtils;
use Override;
use Traversable;

/**
 * @template T
 * @implements Collection<T>
 */
abstract class AbstractCollection implements Collection
{
    /** @var array<array-key, T> */
    protected array $elements = [];

    #[Override]
    public function isEmpty(): bool
    {
        return ArrayUtils::isEmpty($this->elements);
    }

    /** @return T[] */
    #[Override]
    public function values(): array
    {
        return array_values($this->elements);
    }

    #[Override]
    public function count(): int
    {
        return count($this->elements);
    }

    #[Override]
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->elements);
    }
}
