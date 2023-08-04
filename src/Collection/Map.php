<?php

namespace Dontdrinkandroot\Common\Collection;

use OutOfBoundsException;

/**
 * @template TKey
 * @template T
 * @extends Collection<T>
 */
class Map extends Collection
{
    /** @var callable(TKey):array-key */
    protected $hashFunction;

    /**
     * @param callable(TKey):array-key $hashFunction
     */
    public function __construct(callable $hashFunction)
    {
        $this->hashFunction = $hashFunction;
    }

    /**
     * @psalm-suppress MixedReturnTypeCoercion
     * @template ArrayTKey of array-key
     * @return Map<ArrayTKey, T>
     */
    public static function arrayMap(): Map
    {
        return new Map(fn(string|int $key): string|int => $key);
    }

    /**
     * @param TKey $key
     * @param T $value
     */
    public function put($key, $value): void
    {
        $hash = ($this->hashFunction)($key);
        $this->hashedValues[$hash] = $value;
    }

    /**
     * @param TKey $key
     */
    public function has(mixed $key): bool
    {
        $hash = ($this->hashFunction)($key);
        return isset($this->hashedValues[$hash]);
    }

    /**
     * @param TKey $key
     * @return ?T
     */
    public function get(mixed $key): mixed
    {
        $hash = ($this->hashFunction)($key);
        return $this->hashedValues[$hash] ?? null;
    }

    /**
     * @param TKey $key
     * @return ?T
     */
    public function fetch($key): mixed
    {
        return $this->get($key) ?? throw new OutOfBoundsException();
    }

    /**
     * @param TKey $key
     */
    public function remove($key): void
    {
        $hash = ($this->hashFunction)($key);
        unset($this->hashedValues[$hash]);
    }
}
