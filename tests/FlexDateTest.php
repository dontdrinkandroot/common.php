<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class FlexDateTest extends TestCase
{
    public function testValidDate(): void
    {
        $flexDate = new FlexDate();
        self::assertFalse($flexDate->isValidDate());

        $flexDate = new FlexDate(2015, 1, 3);
        self::assertTrue($flexDate->isValidDate());

        $flexDate = new FlexDate(2015, 2, 30);
        self::assertFalse($flexDate->isValidDate());
    }

    public function testHasValue(): void
    {
        $flexDate = new FlexDate();
        self::assertFalse($flexDate->hasValue());

        $flexDate->setYear(2015);
        self::assertTrue($flexDate->hasValue());
    }

    public function testIsCompleteDate(): void
    {
        $flexDate = new FlexDate();
        self::assertFalse($flexDate->isCompleteDate());

        $flexDate->setYear(2015);
        self::assertFalse($flexDate->isCompleteDate());

        $flexDate->setMonth(3);
        self::assertFalse($flexDate->isCompleteDate());

        $flexDate->setDay(3);
        self::assertTrue($flexDate->isCompleteDate());
    }

    public function testToString(): void
    {
        $flexDate = new FlexDate();
        self::assertEquals('', $flexDate->__toString());

        $flexDate->setYear(2015);
        self::assertEquals('2015', $flexDate->__toString());

        $flexDate->setMonth(3);
        self::assertEquals('2015-03', $flexDate->__toString());

        $flexDate->setDay(3);
        self::assertEquals('2015-03-03', $flexDate->__toString());
    }

    public function testToDateTime(): void
    {
        $flexDate = new FlexDate();
        $dateTime = $flexDate->toDateTime();
        self::assertEquals('00000101', $dateTime->format('Ymd'));

        $flexDate->setYear(2015);
        $dateTime = $flexDate->toDateTime();
        self::assertEquals('20150101', $dateTime->format('Ymd'));

        $flexDate->setMonth(3);
        $dateTime = $flexDate->toDateTime();
        self::assertEquals('20150301', $dateTime->format('Ymd'));

        $flexDate->setDay(3);
        $dateTime = $flexDate->toDateTime();
        self::assertEquals('20150303', $dateTime->format('Ymd'));
    }

    public function testIsValid(): void
    {
        $flexDate = new FlexDate();
        $flexDate->setMonth(2);
        self::assertFalse($flexDate->isValid());

        $flexDate = new FlexDate();
        $flexDate->setDay(2);
        self::assertFalse($flexDate->isValid());
    }

    public function testFromString(): void
    {
        $flexDate = FlexDate::fromString('');
        self::assertNull($flexDate->getYear());
        self::assertNull($flexDate->getMonth());
        self::assertNull($flexDate->getDay());
        self::assertTrue($flexDate->isValid());

        $flexDate = FlexDate::fromString('2015');
        self::assertEquals(2015, $flexDate->getYear());
        self::assertNull($flexDate->getMonth());
        self::assertNull($flexDate->getDay());
        self::assertTrue($flexDate->isValid());

        $flexDate = FlexDate::fromString('2015-03');
        self::assertEquals(2015, $flexDate->getYear());
        self::assertEquals(3, $flexDate->getMonth());
        self::assertNull($flexDate->getDay());
        self::assertTrue($flexDate->isValid());

        $flexDate = FlexDate::fromString('2015-03-02');
        self::assertEquals(2015, $flexDate->getYear());
        self::assertEquals(3, $flexDate->getMonth());
        self::assertEquals(2, $flexDate->getDay());
        self::assertTrue($flexDate->isCompleteDate());
        self::assertTrue($flexDate->isValidDate());
        self::assertTrue($flexDate->isValid());
    }

    public function testPrecision(): void
    {
        $flexDate = new FlexDate();
        self::assertEquals(FlexDate::PRECISION_NONE, $flexDate->getPrecision());
        self::assertEquals(true, $flexDate->isEmpty());

        $flexDate->setYear(2015);
        self::assertEquals(FlexDate::PRECISION_YEAR, $flexDate->getPrecision());
        self::assertEquals(false, $flexDate->isEmpty());

        $flexDate->setMonth(3);
        self::assertEquals(FlexDate::PRECISION_MONTH, $flexDate->getPrecision());

        $flexDate->setDay(3);
        self::assertEquals(FlexDate::PRECISION_DAY, $flexDate->getPrecision());
    }
}
