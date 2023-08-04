<?php

namespace Dontdrinkandroot\Common\Collection;

/**
 * @template TKey
 * @template T
 * @extends Map<TKey, T>
 */
class KeyPreservingMap extends Map
{
    /** @array<array-key, TKey> */
    private array $hashedKeys = [];

    /**
     * @param TKey $key
     * @param T $value
     */
    public function put($key, $value): void
    {
        $hash = ($this->hashFunction)($key);
        $this->hashedValues[$hash] = $value;
        $this->hashedKeys[$hash] = $key;
    }

    /**
     * @param TKey $key
     */
    public function remove($key): void
    {
        $hash = ($this->hashFunction)($key);
        unset($this->hashedValues[$hash]);
        unset($this->hashedKeys[$hash]);
    }

    /**
     * @return array<TKey>
     */
    public function keys(): array
    {
        return array_values($this->hashedKeys);
    }
}
