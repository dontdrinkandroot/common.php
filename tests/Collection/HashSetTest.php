<?php

namespace Dontdrinkandroot\Common\Collection;

use DateTime;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class HashSetTest extends TestCase
{
    public function testOperations(): void
    {
        $date1 = new DateTime('2020-01-01');
        $date2 = new DateTime('2020-01-02');

        $set = new HashSet(fn(DateTime $key): string => $key->format('Y-m-d'));

        $this->assertTrue($set->isEmpty());

        $this->assertTrue($set->add($date1));
        $this->assertFalse($set->isEmpty());
        $this->assertTrue($set->contains($date1));
        $this->assertFalse($set->add($date1));

        $set->add($date2);
        $this->assertEquals([$date1, $date2], $set->values());

        $this->assertTrue($set->remove($date1));
        $this->assertFalse($set->contains($date1));
        $this->assertFalse($set->remove($date1));

        $set->remove($date2);
        $this->assertTrue($set->isEmpty());

        $set = HashSet::fromIterable([$date1, $date2], fn(DateTime $key): string => $key->format('Y-m-d'));
        $set = $set->filter(fn(DateTime $key): bool => $key->format('Y-m-d') === '2020-01-01');
        $this->assertEquals([$date1], $set->values());
    }

    public function testFromIterableFailsWithDuplicate(): void
    {
        $date1 = new DateTime('2020-01-01');
        $date2 = new DateTime('2020-01-01');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Duplicate element for hash: 2020-01-01');
        HashSet::fromIterable([$date1, $date2], fn(DateTime $key): string => $key->format('Y-m-d'));
    }
}
