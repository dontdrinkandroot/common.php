<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Model\SimplePopo;
use PHPUnit\Framework\TestCase;

class TypeUtilsTest extends TestCase
{
    public function testIntegerOrNull(): void
    {
        $this->assertNull(TypeUtils::integerOrNull(''));
        $this->assertNull(TypeUtils::integerOrNull('1.2'));
        $this->assertNull(TypeUtils::integerOrNull('bla'));
        $this->assertNull(TypeUtils::integerOrNull(null));
        $this->assertNull(TypeUtils::integerOrNull([]));
        $this->assertNull(TypeUtils::integerOrNull(['b', 'la']));
        $this->assertNull(TypeUtils::integerOrNull(true));
        $this->assertNull(TypeUtils::integerOrNull(false));

        $this->assertEquals(0, TypeUtils::integerOrNull(0));
        $this->assertEquals(0, TypeUtils::integerOrNull(""));

        $this->assertEquals(1, TypeUtils::integerOrNull(1));
        $this->assertEquals(1, TypeUtils::integerOrNull("1"));
    }

    public function testGetType(): void
    {
        self::assertEquals('NULL', TypeUtils::getType(null));
        self::assertEquals('string', TypeUtils::getType('adsf'));
        self::assertEquals('integer', TypeUtils::getType(1));
        self::assertEquals('double', TypeUtils::getType(1.1));
        self::assertEquals('array', TypeUtils::getType([]));
        self::assertEquals('boolean', TypeUtils::getType(true));
        self::assertEquals(SimplePopo::class, TypeUtils::getType(new SimplePopo('asdf', 3)));
    }
}
