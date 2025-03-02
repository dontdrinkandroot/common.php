<?php

namespace Dontdrinkandroot\Common\Collection;

use DateTime;
use DateTimeInterface;
use Dontdrinkandroot\Common\Model\DateEntry;
use InvalidArgumentException;
use OutOfBoundsException;
use PHPUnit\Framework\TestCase;

class KeyedHashSetTest extends TestCase
{
    public function testOperations(): void
    {
        $entry1 = new DateEntry(new DateTime('2018-01-01'), 'Entry 1');
        $entry2 = new DateEntry(new DateTime('2018-01-02'), 'Entry 2');

        $set = new KeyedHashSet(
            fn(DateEntry $entry): DateTimeInterface => $entry->date,
            fn(DateTimeInterface $key): string => $key->format('Y-m-d')
        );

        self::assertTrue($set->isEmpty());

        self::assertTrue($set->add($entry1));
        self::assertFalse($set->isEmpty());
        self::assertTrue($set->contains($entry1));
        self::assertFalse($set->add($entry1));

        $set->add($entry2);
        self::assertEquals([$entry1, $entry2], $set->values());
        self::assertEquals(['2018-01-01' => $entry1, '2018-01-02' => $entry2], iterator_to_array($set));
        self::assertCount(2, $set);

        self::assertTrue($set->remove($entry1));
        self::assertFalse($set->contains($entry1));
        self::assertFalse($set->remove($entry1));

        $set->remove($entry2);
        self::assertTrue($set->isEmpty());
    }

    public function testFromIterableFailsWithDuplicate(): void
    {
        $entry1 = new DateEntry(new DateTime('2018-01-01'), 'Entry 1');
        $entry2 = new DateEntry(new DateTime('2018-01-01'), 'Entry 2');

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Duplicate element for hash: 2018-01-01');

        KeyedHashSet::fromIterable([$entry1, $entry2],
            fn(DateEntry $entry): DateTimeInterface => $entry->date,
            fn(DateTimeInterface $key): string => $key->format('Y-m-d')
        );
    }

    public function testAccessByKey(): void
    {
        $entry1 = new DateEntry(new DateTime('2018-01-01'), 'Entry 1');
        $entry2 = new DateEntry(new DateTime('2018-01-02'), 'Entry 2');

        $set = KeyedHashSet::fromIterable([$entry1, $entry2],
            fn(DateEntry $entry): DateTimeInterface => $entry->date,
            fn(DateTimeInterface $key): string => $key->format('Y-m-d')
        );
        self::assertTrue($set->containsKey($entry1->date));
        self::assertTrue($set->containsKey($entry2->date));
        self::assertFalse($set->containsKey(new DateTime('2018-01-03')));
        self::assertEquals($entry1, $set->getByKey($entry1->date));
        self::assertEquals($entry2, $set->fetchByKey($entry2->date));
        self::assertNull($set->getByKey(new DateTime('2018-01-03')));

        self::assertTrue($set->removeByKey($entry1->date));
        self::assertFalse($set->containsKey($entry1->date));
        self::assertFalse($set->removeByKey($entry1->date));
        self::assertTrue($set->containsKey($entry2->date));
    }

    public function testFetchByKeyFailsOnMissingEntry(): void
    {
        $entry1 = new DateEntry(new DateTime('2018-01-01'), 'Entry 1');
        $entry2 = new DateEntry(new DateTime('2018-01-02'), 'Entry 2');

        $set = KeyedHashSet::fromIterable([$entry1, $entry2],
            fn(DateEntry $entry): DateTimeInterface => $entry->date,
            fn(DateTimeInterface $key): string => $key->format('Y-m-d')
        );

        $this->expectException(OutOfBoundsException::class);
        $this->expectExceptionMessage('No element for hash: 2018-01-03');

        $set->fetchByKey(new DateTime('2018-01-03'));
    }

    public function testFilter(): void
    {
        $entry1 = new DateEntry(new DateTime('2018-01-01'), 'Entry 1');
        $entry2 = new DateEntry(new DateTime('2019-01-02'), 'Entry 2');

        $set = KeyedHashSet::fromIterable([$entry1, $entry2],
            fn(DateEntry $entry): DateTimeInterface => $entry->date,
            fn(DateTimeInterface $key): string => $key->format('Y-m-d')
        );

        $filtered = $set->filter(fn(DateEntry $entry): bool => $entry->date->format('Y') === '2018');
        self::assertEquals([$entry1], $filtered->values());
    }
}
