<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use Dontdrinkandroot\Common\Model\InheritedSimplePopo;
use Dontdrinkandroot\Common\Model\SimplePopo;
use Dontdrinkandroot\Common\Model\SimpleTrait;
use PHPUnit\Framework\TestCase;

class ReflectionUtilsTest extends TestCase
{
    public function testSetPropertyValue(): void
    {
        $simplePopo = new SimplePopo('foo', 42);
        ReflectionUtils::setPropertyValue($simplePopo, 'stringProperty', 'bar');
        ReflectionUtils::setPropertyValue($simplePopo, 'intProperty', 43);
        ReflectionUtils::setPropertyValue($simplePopo, 'protectedProperty', true);
        ReflectionUtils::setPropertyValue($simplePopo, 'privateProperty', true);
        self::assertEquals('bar', $simplePopo->getStringProperty());
        self::assertEquals(43, $simplePopo->getIntProperty());
        self::assertTrue($simplePopo->getProtectedProperty());
        self::assertTrue($simplePopo->getPrivateProperty());
    }

    public function testUsesTrait(): void
    {
        $simplePopo = new SimplePopo('foo', 42);
        self::assertTrue(ReflectionUtils::usesTrait($simplePopo, SimpleTrait::class));
        self::assertTrue(ReflectionUtils::usesTrait(InheritedSimplePopo::class, SimpleTrait::class));
        self::assertFalse(ReflectionUtils::usesTrait($simplePopo, DateTime::class));
    }
}
