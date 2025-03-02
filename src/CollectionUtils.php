<?php

namespace Dontdrinkandroot\Common;

use Exception;

class CollectionUtils
{
    /**
     * @template T
     * @template R
     *
     * @param iterable<T>   $collection
     * @param callable(T):R $collectFunction
     *
     * @return list<R>
     */
    public static function collect(iterable $collection, callable $collectFunction): array
    {
        $results = [];
        foreach ($collection as $element) {
            $results[] = $collectFunction($element);
        }

        return $results;
    }

    /**
     * @template T
     * @template P of string&key-of T
     *
     * @param iterable<T> $collection
     * @param P $propertyName
     *
     * @return list<T[P]>
     */
    public static function collectProperty(iterable $collection, string $propertyName): array
    {
        $results = [];
        foreach ($collection as $element) {
            /**
             * @var T[P] $element
             * @phpstan-ignore property.dynamicName
             */
            $element = $element->{$propertyName};
            $results[] = $element;
        }

        return $results;
    }

    /**
     * @template T
     *
     * @param iterable<T>           $collection
     * @param callable(T):array-key $hashFunction
     *
     * @return array<array-key,T>
     */
    public static function hash(
        iterable $collection,
        callable $hashFunction,
        bool $overrideExisting = false
    ): array {
        $results = [];
        foreach ($collection as $element) {
            $hashKey = $hashFunction($element);
            if (!$overrideExisting && array_key_exists($hashKey, $results)) {
                throw new Exception('HashKey "' . $hashKey . '" already exists.');
            }
            $results[$hashKey] = $element;
        }

        return $results;
    }

    /**
     * @template T
     *
     * @param iterable<T> $collection
     *
     * @return array<array-key,T>
     */
    public static function hashByProperty(
        iterable $collection,
        string $propertyName,
        bool $overrideExisting = false
    ): array {
        $results = [];
        foreach ($collection as $element) {
            /** @phpstan-ignore property.dynamicName */
            $hashKey = $element->{$propertyName};
            if (!is_string($hashKey) && !is_int($hashKey)) {
                throw new Exception(((string)$hashKey) . ' is not a valid array-key');
            }
            if (!$overrideExisting && array_key_exists($hashKey, $results)) {
                throw new Exception('HashKey "' . $hashKey . '" already exists.');
            }
            $results[$hashKey] = $element;
        }

        return $results;
    }

    /**
     * @template T of array<array-key,mixed>
     *
     * @param array<array-key, T> $arr
     * @param array-key $key
     * @return array<array-key, T>
     */
    public static function hashByKey(array $arr, int|string $key, bool $overrideExisting = false): array
    {
        $results = [];
        foreach ($arr as $element) {
            $hashKey = $element[$key];
            if (!is_string($hashKey) && !is_int($hashKey)) {
                throw new Exception(((string)$hashKey) . ' is not a valid array-key');
            }
            if (!$overrideExisting && array_key_exists($hashKey, $results)) {
                throw new Exception('HashKey "' . $hashKey . '" already exists.');
            }
            $results[$hashKey] = $element;
        }

        return $results;
    }
}
