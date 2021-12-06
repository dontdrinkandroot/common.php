<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Pagination\Pagination;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AssertedTest extends TestCase
{
    public function testIntegerish(): void
    {
        self::assertEquals(3, Asserted::integerish(3));
        self::assertEquals(3, Asserted::integerish('3'));
        self::assertEquals(3, Asserted::integerish('3.0'));
    }

    public function testIntegerishOrNull(): void
    {
        self::assertEquals(3, Asserted::integerishOrNull(3));
        self::assertEquals(3, Asserted::integerishOrNull('3'));
        self::assertEquals(3, Asserted::integerishOrNull('3.0'));
        self::assertNull(Asserted::integerishOrNull(null));
    }

    public function testIntegerishFailsOnNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::integerish(null);
    }

    public function testIntegerishFailsOnString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::integerish('asdf');
    }

    public function testIntegerishFailsOnFloat(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::integerish('3.14');
    }

    public function testFloatish(): void
    {
        self::assertEquals(3.0, Asserted::floatish(3));
        self::assertEquals(3.0, Asserted::floatish('3'));
        self::assertEquals(3.1, Asserted::floatish('3.1'));
    }

    public function testFloatishOrNull(): void
    {
        self::assertEquals(3.0, Asserted::floatishOrNull(3));
        self::assertEquals(3.0, Asserted::floatishOrNull('3'));
        self::assertEquals(3.1, Asserted::floatishOrNull('3.1'));
        self::assertNull(Asserted::floatishOrNull(null));
    }

    public function testFloatishFailsOnNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::floatish(null);
    }

    public function testFloatishFailsOnString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::floatish('asdf');
    }

    public function testNotNull(): void
    {
        self::assertEquals('test', Asserted::notNull('test'));
        self::assertEquals(3, Asserted::notNull(3));
    }

    public function testNotNullFailsNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::notNull(null);
    }

    public function testString(): void
    {
        self::assertEquals('test', Asserted::string('test'));
    }

    public function testStringFailsInt(): void
    {
        $this->expectException(InvalidArgumentException::class);
        self::assertEquals('test', Asserted::string(3));
    }

    public function testStringFailsNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        self::assertEquals('test', Asserted::string(null));
    }

    public function testStringOrNull(): void
    {
        self::assertEquals(null, Asserted::stringOrNull(null));
        self::assertEquals('test', Asserted::stringOrNull('test'));

        $this->expectException(InvalidArgumentException::class);
        self::assertEquals('test', Asserted::stringOrNull(3));
    }

    public function testInstanceOf(): void
    {
        $popo = new SimplePopo('string', 7);
        self::assertEquals($popo, Asserted::instanceOf($popo, SimplePopo::class));

        $this->expectException(InvalidArgumentException::class);
        self::assertEquals($popo, Asserted::instanceOf($popo, Pagination::class));
    }

    public function testInstanceOfOrNull(): void
    {
        $popo = new SimplePopo('string', 7);
        self::assertEquals($popo, Asserted::instanceOfOrNull($popo, SimplePopo::class));
        self::assertEquals(null, Asserted::instanceOfOrNull(null, SimplePopo::class));

        $this->expectException(InvalidArgumentException::class);
        self::assertEquals($popo, Asserted::instanceOfOrNull($popo, Pagination::class));
    }
}
