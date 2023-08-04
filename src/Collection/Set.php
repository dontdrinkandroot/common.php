<?php

namespace Dontdrinkandroot\Common\Collection;

/**
 * @template T
 * @extends Collection<T>
 */
class Set extends Collection
{
    /** @var callable(T):array-key */
    private $hashFunction;

    /**
     * @param callable(T):array-key $hashFunction
     */
    public function __construct(callable $hashFunction)
    {
        $this->hashFunction = $hashFunction;
    }

    /**
     * @psalm-suppress MixedReturnTypeCoercion
     * @template ArrayTKey of array-key
     * @return Set<ArrayTKey>
     */
    public static function arraySet(): Set
    {
        return new Set(fn(string|int $value): string|int => $value);
    }

    /**
     * @param T $value
     */
    public function add($value): void
    {
        $hash = ($this->hashFunction)($value);
        $this->hashedValues[$hash] = $value;
    }

    /**
     * @param T $value
     */
    public function remove($value): void
    {
        $hash = ($this->hashFunction)($value);
        unset($this->hashedValues[$hash]);
    }

    /**
     * @param T $value
     */
    public function has($value): bool
    {
        $hash = ($this->hashFunction)($value);
        return isset($this->hashedValues[$hash]);
    }
}
