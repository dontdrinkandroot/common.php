<?php

namespace Dontdrinkandroot\Common;

class CollectionUtils
{
    /**
     * @template T
     * @template R
     *
     * @param iterable<T> $collection
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
     * @template R
     *
     * @param iterable<T> $collection
     * @param string      $propertyName
     *
     * @return list<R>
     */
    public static function collectProperty(iterable $collection, string $propertyName): array
    {
        $results = [];
        foreach ($collection as $element) {
            /** @var R $element */
            $element = $element->{$propertyName};
            $results[] = $element;
        }

        return $results;
    }
}
