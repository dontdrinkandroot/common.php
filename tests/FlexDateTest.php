<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class FlexDateTest extends TestCase
{
    public function testValidDate(): void
    {
        $flexDate = new FlexDate();
        $this->assertFalse($flexDate->isValidDate());

        $flexDate = new FlexDate(2015, 1, 3);
        $this->assertTrue($flexDate->isValidDate());

        $flexDate = new FlexDate(2015, 2, 30);
        $this->assertFalse($flexDate->isValidDate());
    }

    public function testHasValue(): void
    {
        $flexDate = new FlexDate();
        $this->assertFalse($flexDate->hasValue());

        $flexDate->setYear(2015);
        $this->assertTrue($flexDate->hasValue());
    }

    public function testIsCompleteDate(): void
    {
        $flexDate = new FlexDate();
        $this->assertFalse($flexDate->isCompleteDate());

        $flexDate->setYear(2015);
        $this->assertFalse($flexDate->isCompleteDate());

        $flexDate->setMonth(3);
        $this->assertFalse($flexDate->isCompleteDate());

        $flexDate->setDay(3);
        $this->assertTrue($flexDate->isCompleteDate());
    }

    public function testToString(): void
    {
        $flexDate = new FlexDate();
        $this->assertEquals('', $flexDate->__toString());

        $flexDate->setYear(2015);
        $this->assertEquals('2015', $flexDate->__toString());

        $flexDate->setMonth(3);
        $this->assertEquals('2015-03', $flexDate->__toString());

        $flexDate->setDay(3);
        $this->assertEquals('2015-03-03', $flexDate->__toString());
    }

    public function testToDateTime(): void
    {
        $flexDate = new FlexDate();
        $dateTime = $flexDate->toDateTime();
        $this->assertEquals('00000101', $dateTime->format('Ymd'));

        $flexDate->setYear(2015);
        $dateTime = $flexDate->toDateTime();
        $this->assertEquals('20150101', $dateTime->format('Ymd'));

        $flexDate->setMonth(3);
        $dateTime = $flexDate->toDateTime();
        $this->assertEquals('20150301', $dateTime->format('Ymd'));

        $flexDate->setDay(3);
        $dateTime = $flexDate->toDateTime();
        $this->assertEquals('20150303', $dateTime->format('Ymd'));
    }

    public function testIsValid(): void
    {
        $flexDate = new FlexDate();
        $flexDate->setMonth(2);
        $this->assertFalse($flexDate->isValid());

        $flexDate = new FlexDate();
        $flexDate->setDay(2);
        $this->assertFalse($flexDate->isValid());
    }

    public function testFromString(): void
    {
        $flexDate = FlexDate::fromString('');
        $this->assertNull($flexDate->getYear());
        $this->assertNull($flexDate->getMonth());
        $this->assertNull($flexDate->getDay());
        $this->assertTrue($flexDate->isValid());

        $flexDate = FlexDate::fromString('2015');
        $this->assertEquals(2015, $flexDate->getYear());
        $this->assertNull($flexDate->getMonth());
        $this->assertNull($flexDate->getDay());
        $this->assertTrue($flexDate->isValid());

        $flexDate = FlexDate::fromString('2015-03');
        $this->assertEquals(2015, $flexDate->getYear());
        $this->assertEquals(3, $flexDate->getMonth());
        $this->assertNull($flexDate->getDay());
        $this->assertTrue($flexDate->isValid());

        $flexDate = FlexDate::fromString('2015-03-02');
        $this->assertEquals(2015, $flexDate->getYear());
        $this->assertEquals(3, $flexDate->getMonth());
        $this->assertEquals(2, $flexDate->getDay());
        $this->assertTrue($flexDate->isCompleteDate());
        $this->assertTrue($flexDate->isValidDate());
        $this->assertTrue($flexDate->isValid());
    }

    public function testPrecision(): void
    {
        $flexDate = new FlexDate();
        $this->assertEquals(FlexDate::PRECISION_NONE, $flexDate->getPrecision());
        $this->assertEquals(true, $flexDate->isEmpty());

        $flexDate->setYear(2015);
        $this->assertEquals(FlexDate::PRECISION_YEAR, $flexDate->getPrecision());
        $this->assertEquals(false, $flexDate->isEmpty());

        $flexDate->setMonth(3);
        $this->assertEquals(FlexDate::PRECISION_MONTH, $flexDate->getPrecision());

        $flexDate->setDay(3);
        $this->assertEquals(FlexDate::PRECISION_DAY, $flexDate->getPrecision());
    }
}
