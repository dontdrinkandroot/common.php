<?php

namespace Dontdrinkandroot\Common\Collection;

use DateTime;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{
    public function testOperations(): void
    {
        $date1 = new DateTime('2020-01-01');
        $date2 = new DateTime('2020-01-02');

        $set = new Set(fn(DateTime $key): string => $key->format('Y-m-d'));

        $this->assertTrue($set->isEmpty());

        $set->add($date1);
        $this->assertFalse($set->isEmpty());
        $this->assertTrue($set->has($date1));

        $set->add($date2);
        $this->assertEquals([$date1, $date2], $set->values());

        $set->remove($date1);
        $this->assertFalse($set->has($date1));

        $set->remove($date2);
        $this->assertTrue($set->isEmpty());
    }
}
