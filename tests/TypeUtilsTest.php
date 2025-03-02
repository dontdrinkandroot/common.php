<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Model\SimplePopo;
use PHPUnit\Framework\TestCase;

class TypeUtilsTest extends TestCase
{
    public function testIntegerOrNull(): void
    {
        self::assertNull(TypeUtils::integerOrNull(''));
        self::assertNull(TypeUtils::integerOrNull('1.2'));
        self::assertNull(TypeUtils::integerOrNull('bla'));
        self::assertNull(TypeUtils::integerOrNull(null));
        self::assertNull(TypeUtils::integerOrNull([]));
        self::assertNull(TypeUtils::integerOrNull(['b', 'la']));
        self::assertNull(TypeUtils::integerOrNull(true));
        self::assertNull(TypeUtils::integerOrNull(false));

        self::assertEquals(0, TypeUtils::integerOrNull(0));
        self::assertEquals(0, TypeUtils::integerOrNull(""));

        self::assertEquals(1, TypeUtils::integerOrNull(1));
        self::assertEquals(1, TypeUtils::integerOrNull("1"));
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
