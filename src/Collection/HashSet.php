<?php

namespace Dontdrinkandroot\Common\Collection;

use Closure;
use InvalidArgumentException;
use Override;

/**
 * @template T
 * @extends AbstractHashSet<T>
 */
class HashSet extends AbstractHashSet
{
    /**
     * @param Closure(T):array-key $hashFn
     */
    public function __construct(private readonly Closure $hashFn)
    {
    }

    /**
     * @template StaticT
     * @param iterable<StaticT> $iterable
     * @param Closure(StaticT):array-key $hashFn
     * @return HashSet
     */
    public static function fromIterable(iterable $iterable, Closure $hashFn, bool $allowDuplicates = false): HashSet
    {
        $set = new HashSet($hashFn);
        foreach ($iterable as $element) {
            if (false === $set->add($element) && !$allowDuplicates) {
                throw new InvalidArgumentException('Duplicate element for hash: ' . $set->hash($element));
            }
        }

        return $set;
    }

    #[Override]
    public function filter(Closure $filterFn): HashSet
    {
        $filtered = new HashSet($this->hashFn);
        foreach ($this->elements as $element) {
            if ($filterFn($element)) {
                $filtered->add($element);
            }
        }

        return $filtered;
    }

    #[Override]
    protected function hash(mixed $element): int|string
    {
        return ($this->hashFn)($element);
    }
}
