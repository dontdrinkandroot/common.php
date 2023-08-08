<?php

namespace Dontdrinkandroot\Common\Collection;

use ArrayIterator;
use Closure;
use InvalidArgumentException;
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

    /**
     * {@inheritdoc}
     */
    public function isEmpty(): bool
    {
        return empty($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function values(): iterable
    {
        return array_keys($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function add(mixed $element): bool
    {
        if (isset($this->elements[$element])) {
            return false;
        }

        $this->elements[$element] = true;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function remove(mixed $element): bool
    {
        if (isset($this->elements[$element])) {
            unset($this->elements[$element]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function contains(mixed $element): bool
    {
        return isset($this->elements[$element]);
    }

    /**
     * {@inheritdoc}
     * @return ArrayKeySet<T>
     */
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
        return new ArrayIterator(array_keys($this->elements));
    }
}
