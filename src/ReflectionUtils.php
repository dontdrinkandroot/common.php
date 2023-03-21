<?php

namespace Dontdrinkandroot\Common;

use ReflectionClass;

class ReflectionUtils
{
    public static function setPropertyValue(object $object, string $propertyName, mixed $value): void
    {
        $reflectionClass = new ReflectionClass($object);
        $reflectionProperty = $reflectionClass->getProperty($propertyName);
        $reflectionProperty->setValue($object, $value);
    }

    /**
     * @template T
     * @param object|class-string $object
     * @param class-string<T> $trait
     * @return bool
     */
    public static function usesTrait(object|string $object, string $trait): bool
    {
        if (in_array($trait, class_uses($object))) {
            return true;
        }

        $parentClass = get_parent_class($object);
        if ($parentClass !== false) {
            return self::usesTrait($parentClass, $trait);
        }

        return false;
    }
}
