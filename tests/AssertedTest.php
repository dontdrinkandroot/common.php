<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Model\SimplePopo;
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

    /**
     * @psalm-suppress RedundantCondition
     */
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

    /**
     * @psalm-suppress RedundantCondition
     */
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

    public function testNonEmptyStringWithValidValues(): void
    {
        self::assertEquals('test', Asserted::nonEmptyString('test'));
        self::assertEquals(' ', Asserted::nonEmptyString(' '));
    }

    public function testNonEmptyStringWithNullValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::nonEmptyString(null);
    }

    public function testNonEmptyStringWithEmptyString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::nonEmptyString('');
    }

    /**
     * @psalm-suppress RedundantCondition
     */
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
    }

    public function testInstanceOfWithWrongClass(): void
    {
        /** @var object $popo */
        $popo = new SimplePopo('string', 7);
        $this->expectException(InvalidArgumentException::class);
        self::assertEquals($popo, Asserted::instanceOf($popo, Pagination::class));
    }

    public function testInstanceOfOrNull(): void
    {
        /** @var object|null $popo */
        $popo = new SimplePopo('string', 7);
        self::assertEquals($popo, Asserted::instanceOfOrNull($popo, SimplePopo::class));
        self::assertEquals(null, Asserted::instanceOfOrNull(null, SimplePopo::class));
    }

    public function testInstanceOfOrNullWithWrongClass(): void
    {
        /** @var object|null $popo */
        $popo = new SimplePopo('string', 7);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Provided value must be of class Dontdrinkandroot\Common\Pagination\Pagination but was Dontdrinkandroot\Common\Model\SimplePopo'
        );
        self::assertEquals($popo, Asserted::instanceOfOrNull($popo, Pagination::class));
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testIntWithValidValue(): void
    {
        self::assertEquals(3, Asserted::int(3));
    }

    public function testIntWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::int('3');
    }

    public function testIntFailsOnNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::int(null);
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testIntOrNullWithValidValue(): void
    {
        self::assertEquals(3, Asserted::intOrNull(3));
        self::assertNull(Asserted::intOrNull(null));
    }

    public function testIntOrNullWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::intOrNull('3');
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testFloatWithValidValue(): void
    {
        self::assertEquals(3.0, Asserted::float(3.0));
        self::assertEquals(3.1, Asserted::float(3.1));
    }

    public function testFloatWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::float('3');
    }

    public function testFloatFailsOnNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::float(null);
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testFloatOrNullWithValidValue(): void
    {
        self::assertEquals(3.0, Asserted::floatOrNull(3.0));
        self::assertEquals(3.1, Asserted::floatOrNull(3.1));
        self::assertNull(Asserted::floatOrNull(null));
    }

    public function testFloatOrNullWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Provided value must be a float but was string');
        Asserted::floatOrNull('3');
    }

    public function testArrayFailsOnNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::array(null);
    }

    public function testArrayFailsOnString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::array('test');
    }

    public function testArrayOnArray(): void
    {
        self::assertEquals(['a, b' => 'c'], Asserted::array(['a, b' => 'c']));
    }

    public function testArrayOrNullOnNull(): void
    {
        self::assertNull(Asserted::arrayOrNull(null));
    }

    public function testArrayOrNullOnArray(): void
    {
        self::assertEquals(['a, b' => 'c'], Asserted::arrayOrNull(['a, b' => 'c']));
    }

    public function testArrayOrNullFailsOnString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::arrayOrNull('test');
    }

    public function testIterableFailsOnNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::iterable(null);
    }

    public function testIterableFailsOnString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::iterable('test');
    }

    public function testIterableWithValidValue(): void
    {
        self::assertEquals(['a', 'b'], Asserted::iterable(['a', 'b']));
    }

    public function testIterableOrNullFailsOnInt(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::iterable(1);
    }

    public function testIterableOrNullWithValidValue(): void
    {
        self::assertNull(Asserted::iterableOrNull(null));
        self::assertEquals(['a', 'b'], Asserted::iterableOrNull(['a', 'b']));
    }

    public function testBoolWithValidValue(): void
    {
        self::assertEquals(true, Asserted::bool(true));
        self::assertEquals(false, Asserted::bool(false));
    }

    public function testBoolWithNull(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::bool(null);
    }

    public function testBoolWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::bool('test');
    }

    /**
     * @psalm-suppress RedundantCondition
     */
    public function testBoolOrNullWithValidValue(): void
    {
        self::assertEquals(true, Asserted::boolOrNull(true));
        self::assertEquals(false, Asserted::boolOrNull(false));
        self::assertNull(Asserted::boolOrNull(null));
    }

    public function testBoolOrNullWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::boolOrNull('test');
    }

    public function testPositiveIntWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt(-1);

        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt(0);

        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt('1');

        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt(null);
    }

    public function testPositivIntWithValueValue(): void
    {
        self::assertEquals(1, Asserted::positiveInt(1));
    }

    public function testPositiveIntOrNullWithInvalidValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt(-1);

        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt(0);

        $this->expectException(InvalidArgumentException::class);
        Asserted::positiveInt('1');
    }

    public function testPositivIntOrNullWithValueValue(): void
    {
        self::assertEquals(1, Asserted::positiveInt(1));
        self::assertNull(Asserted::positiveIntOrNull(null));
    }
}
