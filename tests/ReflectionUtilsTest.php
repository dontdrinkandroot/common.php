<?php

namespace Dontdrinkandroot\Common;

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
}
