<?php

namespace Dontdrinkandroot\Common\Collection;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ArrayKeySetTest extends TestCase
{
    public function testOperations(): void
    {
        $set = new ArrayKeySet();
        self::assertTrue($set->add('foo'));
        self::assertFalse($set->add('foo'));
        $set->add('bar');
        self::assertEquals(['foo', 'bar'], $set->values());
        self::assertEquals(['foo', 'bar'], iterator_to_array($set));
        self::assertCount(2, $set);
        self::assertTrue($set->contains('foo'));
        self::assertFalse($set->contains('baz'));
        self::assertTrue($set->remove('foo'));
        self::assertFalse($set->remove('foo'));
        self::assertEquals(['bar'], $set->values());
        self::assertTrue($set->remove('bar'));
        self::assertTrue($set->isEmpty());

        $set = ArrayKeySet::fromIterable([1, 2, 3, 4]);
        $set = $set->filter(fn(int $value): bool => $value % 2 === 0);
        self::assertEquals([2, 4], $set->values());
    }

    public function testFromIterableFailsWithDuplicates(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Duplicate element: foo');
        ArrayKeySet::fromIterable(['foo', 'foo']);
    }
}
