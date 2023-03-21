<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Util\InheritedSimplePopo;
use Dontdrinkandroot\Common\Util\SimplePopo;
use Dontdrinkandroot\Common\Util\SimpleTrait;
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
        $this->assertEquals('bar', $simplePopo->getStringProperty());
        $this->assertEquals(43, $simplePopo->getIntProperty());
        $this->assertTrue($simplePopo->getProtectedProperty());
        $this->assertTrue($simplePopo->getPrivateProperty());
    }

    public function testUsesTrait(): void
    {
        $simplePopo = new SimplePopo('foo', 42);
        $this->assertTrue(ReflectionUtils::usesTrait($simplePopo, SimpleTrait::class));
        $this->assertTrue(ReflectionUtils::usesTrait(InheritedSimplePopo::class, SimpleTrait::class));
        $this->assertFalse(ReflectionUtils::usesTrait($simplePopo, \DateTime::class));
    }
}
