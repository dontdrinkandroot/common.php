<?php

namespace Dontdrinkandroot\Common\Collection;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ArrayKeySetTest extends TestCase
{
    public function testOperations(): void
    {
        $set = new ArrayKeySet();
        $this->assertTrue($set->add('foo'));
        $this->assertFalse($set->add('foo'));
        $set->add('bar');
        $this->assertEquals(['foo', 'bar'], $set->values());
        $this->assertEquals(['foo', 'bar'], iterator_to_array($set));
        $this->assertCount(2, $set);
        $this->assertTrue($set->contains('foo'));
        $this->assertFalse($set->contains('baz'));
        $this->assertTrue($set->remove('foo'));
        $this->assertFalse($set->remove('foo'));
        $this->assertEquals(['bar'], $set->values());
        $this->assertTrue($set->remove('bar'));
        $this->assertTrue($set->isEmpty());

        $set = ArrayKeySet::fromIterable([1, 2, 3, 4]);
        $set = $set->filter(fn(int $value): bool => $value % 2 === 0);
        $this->assertEquals([2, 4], $set->values());
    }

    public function testFromIterableFailsWithDuplicates(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Duplicate element: foo');
        ArrayKeySet::fromIterable(['foo', 'foo']);
    }
}
