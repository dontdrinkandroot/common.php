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
        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        self::assertTrue(StringUtils::isEmpty(null));
        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        self::assertTrue(StringUtils::isEmpty(''));
        /** @phpstan-ignore staticMethod.impossibleType */
        self::assertFalse(StringUtils::isEmpty('NotEmpty'));
    }

    public function testIsNotEmpty(): void
    {
        /** @phpstan-ignore staticMethod.impossibleType */
        self::assertFalse(StringUtils::isNotEmpty(null));
        /** @phpstan-ignore staticMethod.impossibleType */
        self::assertFalse(StringUtils::isNotEmpty(''));
        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        self::assertTrue(StringUtils::isNotEmpty('NotEmpty'));
    }

    public function testUnderscoreLower(): void
    {
        self::assertEquals('lower_case', StringUtils::underscore('lowerCase'));
    }

    public function testUnderscoreUpper(): void
    {
        self::assertEquals('UPPER_CASE', StringUtils::underscore('UpperCase', CASE_UPPER));
    }
}
