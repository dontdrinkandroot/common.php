<?php

namespace Dontdrinkandroot\Common\Collection;

use Closure;
use InvalidArgumentException;
use OutOfBoundsException;

/**
 * @template TKey
 * @template T
 * @extends AbstractHashSet<T>
 * @implements KeyedSet<TKey, T>
 */
class KeyedHashSet extends AbstractHashSet implements KeyedSet
{
    /**
     * @param Closure(T):TKey $elementHashFn
     * @param Closure(TKey):array-key $keyHashFn
     */
    public function __construct(private readonly Closure $elementHashFn, private readonly Closure $keyHashFn)
    {
    }

    /**
     * @template StaticTKey
     * @template StaticT
     * @param iterable<StaticT> $iterable
     * @param Closure(StaticT):StaticTKey $elementHashFn
     * @param Closure(StaticTKey):array-key $keyHashFn
     * @param bool $allowDuplicates
     * @return KeyedHashSet<StaticTKey, StaticT>
     */
    public static function fromIterable(
        iterable $iterable,
        Closure $elementHashFn,
        Closure $keyHashFn,
        bool $allowDuplicates = false
    ): KeyedHashSet {
        $set = new KeyedHashSet($elementHashFn, $keyHashFn);
        foreach ($iterable as $element) {
            if (false === $set->add($element) && !$allowDuplicates) {
                throw new InvalidArgumentException('Duplicate element for hash: ' . $set->hash($element));
            }
        }

        return $set;
    }

    /**
     * {@inheritdoc}
     */
    public function getByKey(mixed $key): mixed
    {
        return $this->elements[($this->keyHashFn)($key)] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function fetchByKey(mixed $key): mixed
    {
        return $this->getByKey($key) ?? throw new OutOfBoundsException('No element for hash: ' . ($this->keyHashFn)($key));
    }

    /**
     * {@inheritdoc}
     */
    public function containsKey(mixed $key): bool
    {
        return isset($this->elements[($this->keyHashFn)($key)]);
    }

    /**
     * {@inheritdoc}
     */
    public function removeByKey(mixed $key): bool
    {
        $hash = ($this->keyHashFn)($key);
        if (isset($this->elements[$hash])) {
            unset($this->elements[$hash]);

            return true;
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function filter(Closure $filterFn): KeyedHashSet
    {
        $filtered = new KeyedHashSet($this->elementHashFn, $this->keyHashFn);
        foreach ($this->elements as $key => $element) {
            if ($filterFn($element)) {
                $filtered->elements[$key] = $element;
            }
        }

        return $filtered;
    }

    /**
     * {@inheritdoc}
     */
    protected function hash(mixed $element): int|string
    {
        return ($this->keyHashFn)(($this->elementHashFn)($element));
    }
}
