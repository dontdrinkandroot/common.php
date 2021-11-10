<?php

namespace Dontdrinkandroot\Utils;

use Traversable;

class CollectionUtils
{
    /**
     * @template T
     * @template R
     *
     * @param Traversable<T> $collection
     * @param callable(T):R  $collectFunction
     *
     * @return list<R>
     */
    public static function collect(Traversable $collection, callable $collectFunction): array
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
     * @param Traversable<T> $collection
     * @param string         $propertyName
     *
     * @return list<R>
     */
    public static function collectProperty(Traversable $collection, string $propertyName): array
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
