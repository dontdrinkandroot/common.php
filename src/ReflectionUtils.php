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
}
