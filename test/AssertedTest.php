<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Pagination\Pagination;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class AssertedTest extends TestCase
{
    public function testNotNull(): void
    {
        self::assertEquals('test', Asserted::notNull('test'));
        self::assertEquals(3, Asserted::notNull(3));
    }

    public function testNotNullFailsNull(): void
    {
        $this->expectException(RuntimeException::class);
        Asserted::notNull(null);
    }

    public function testString(): void
    {
        self::assertEquals('test', Asserted::string('test'));
    }

    public function testStringFailsInt(): void
    {
        $this->expectException(RuntimeException::class);
        self::assertEquals('test', Asserted::string(3));
    }

    public function testStringFailsNull(): void
    {
        $this->expectException(RuntimeException::class);
        self::assertEquals('test', Asserted::string(null));
    }

    public function testStringOrNull(): void
    {
        self::assertEquals(null, Asserted::stringOrNull(null));
        self::assertEquals('test', Asserted::stringOrNull('test'));

        $this->expectException(RuntimeException::class);
        self::assertEquals('test', Asserted::stringOrNull(3));
    }

    public function testInstanceOf(): void
    {
        $popo = new SimplePopo('string', 7);
        self::assertEquals($popo, Asserted::instanceOf($popo, SimplePopo::class));

        $this->expectException(RuntimeException::class);
        self::assertEquals($popo, Asserted::instanceOf($popo, Pagination::class));
    }

    public function testInstanceOfOrNull(): void
    {
        $popo = new SimplePopo('string', 7);
        self::assertEquals($popo, Asserted::instanceOfOrNull($popo, SimplePopo::class));
        self::assertEquals(null, Asserted::instanceOfOrNull(null, SimplePopo::class));

        $this->expectException(RuntimeException::class);
        self::assertEquals($popo, Asserted::instanceOfOrNull($popo, Pagination::class));
    }
}
