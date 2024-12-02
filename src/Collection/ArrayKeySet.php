<?php

namespace Dontdrinkandroot\Common\Collection;

use ArrayIterator;
use Closure;
use InvalidArgumentException;
use Override;
use Traversable;

/**
 * @template T of array-key
 * @implements Set<T>
 */
class ArrayKeySet implements Set
{
    /** @var array<T, bool> */
    private array $elements = [];

    public function __construct()
    {
    }

    /**
     * @param iterable<array-key> $iterable
     */
    public static function fromIterable(iterable $iterable, bool $allowDuplicates = false): ArrayKeySet
    {
        $set = new ArrayKeySet();
        foreach ($iterable as $element) {
            if (false === $set->add($element) && !$allowDuplicates) {
                throw new InvalidArgumentException('Duplicate element: ' . $element);
            }
        }

        return $set;
    }

    #[Override]
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    #[Override]
    public function values(): iterable
    {
        return array_keys($this->elements);
    }

    #[Override]
    public function add(mixed $element): bool
    {
        if (isset($this->elements[$element])) {
            return false;
        }

        $this->elements[$element] = true;

        return true;
    }

    #[Override]
    public function remove(mixed $element): bool
    {
        if (isset($this->elements[$element])) {
            unset($this->elements[$element]);

            return true;
        }

        return false;
    }

    #[Override]
    public function contains(mixed $element): bool
    {
        return isset($this->elements[$element]);
    }

    /**
     * @return ArrayKeySet<T>
     */
    #[Override]
    public function filter(Closure $filterFn): ArrayKeySet
    {
        $set = new ArrayKeySet();
        foreach ($this->values() as $value) {
            if ($filterFn($value)) {
                $set->add($value);
            }
        }

        return $set;
    }

    #[Override]
    public function count(): int
    {
        return count($this->elements);
    }

    #[Override]
    public function getIterator(): Traversable
    {
        return new ArrayIterator(array_keys($this->elements));
    }
}
