<?php

namespace Dontdrinkandroot\Common\Collection;

/**
 * @template T
 */
abstract class Collection
{
    /** @var array<array-key, T> */
    protected array $hashedValues = [];

    public function isEmpty(): bool
    {
        return empty($this->hashedValues);
    }

    /**
     * @return list<T>
     */
    public function values(): array
    {
        return array_values($this->hashedValues);
    }

    /**
     * @param callable(T):void $forEachFunction
     */
    public function forEach(callable $forEachFunction): void
    {
        foreach ($this->hashedValues as $value) {
            $forEachFunction($value);
        }
    }

//    /**
//     * @param callable(T):bool $filterFunction
//     *
//     * @return static<T>
//     */
//    public abstract function filter(callable $filterFunction): Collection;
}
