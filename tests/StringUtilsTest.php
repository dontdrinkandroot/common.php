<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase
{
    public function testStartsWith(): void
    {
        $this->assertTrue(StringUtils::startsWith('bla', ''));
        $this->assertTrue(StringUtils::startsWith('bla', 'bl'));
        $this->assertfalse(StringUtils::startsWith('bla', 'la'));
    }

    public function testEndsWith(): void
    {
        $this->assertTrue(StringUtils::endsWith('bla', ''));
        $this->assertTrue(StringUtils::endsWith('bla', 'la'));
        $this->assertfalse(StringUtils::endsWith('bla', 'bl'));
    }

    public function testGetFirstChar(): void
    {
        $this->assertNull(StringUtils::getFirstChar(''));
        $this->assertEquals('b', StringUtils::getFirstChar('bla'));
    }

    public function testGetLastChar(): void
    {
        $this->assertNull(StringUtils::getLastChar(''));
        $this->assertEquals('a', StringUtils::getLastChar('bla'));
    }

    public function testIsEmpty(): void
    {
        self::assertTrue(StringUtils::isEmpty(null));
        self::assertTrue(StringUtils::isEmpty(''));
        self::assertFalse(StringUtils::isEmpty('NotEmpty'));
    }

    public function testIsNotEmpty(): void
    {
        self::assertFalse(StringUtils::isNotEmpty(null));
        self::assertFalse(StringUtils::isNotEmpty(''));
        self::assertTrue(StringUtils::isNotEmpty('NotEmpty'));
    }
}
