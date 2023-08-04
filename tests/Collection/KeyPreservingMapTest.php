<?php

namespace Dontdrinkandroot\Common\Collection;

use DateTime;
use PHPUnit\Framework\TestCase;

class KeyPreservingMapTest extends TestCase
{
    public function testOperations(): void
    {
        $date1 = new DateTime('2020-01-01');
        $date2 = new DateTime('2020-01-02');

        $map = new KeyPreservingMap(fn(DateTime $key): string => $key->format('Y-m-d'));
        $this->assertTrue($map->isEmpty());

        $map->put($date1, 'foo');
        $this->assertFalse($map->isEmpty());

        $map->put($date2, 'bar');
        $this->assertEquals('foo', $map->fetch($date1));
        $this->assertEquals('bar', $map->get($date2));

        $this->assertTrue($map->has($date1));
        $this->assertFalse($map->has(new DateTime('2020-01-03')));
        $this->assertEquals(['foo', 'bar'], $map->values());
        $this->assertEquals([$date1, $date2], $map->keys());

        $map->remove($date1);
        $this->assertFalse($map->has($date1));
        $this->assertEquals(['bar'], $map->values());
        $this->assertEquals([$date2], $map->keys());

        $map->remove($date2);
        $this->assertTrue($map->isEmpty());
    }
}
