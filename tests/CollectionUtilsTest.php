<?php

namespace Dontdrinkandroot\Common;

use Dontdrinkandroot\Common\Model\SimplePopo;
use Exception;
use PHPUnit\Framework\TestCase;

class CollectionUtilsTest extends TestCase
{
    public function testCollect(): void
    {
        $collection = [];
        $collection[] = new SimplePopo('a', 1);
        $collection[] = new SimplePopo('c', 3);
        $collection[] = new SimplePopo('b', 2);

        $result = CollectionUtils::collect(
            $collection,
            fn(SimplePopo $simplePopo): string => $simplePopo->getStringProperty()
        );
        self::assertEquals(['a', 'c', 'b'], $result);

        $result = CollectionUtils::collect(
            $collection,
            fn(SimplePopo $simplePopo): int => $simplePopo->getIntProperty()
        );
        self::assertEquals([1, 3, 2], $result);
    }

    public function testCollectProperty(): void
    {
        $collection = [];
        $collection[] = new SimplePopo('a', 1);
        $collection[] = new SimplePopo('c', 3);
        $collection[] = new SimplePopo('b', 2);

        $result = CollectionUtils::collectProperty($collection, 'stringProperty');
        self::assertEquals(['a', 'c', 'b'], $result);
    }

    public function testHash(): void
    {
        $collection = [];
        $element1 = new SimplePopo('a', 1);
        $collection[] = $element1;
        $element2 = new SimplePopo('c', 3);
        $collection[] = $element2;
        $element3 = new SimplePopo('b', 2);
        $collection[] = $element3;

        $result = CollectionUtils::hash($collection, fn(SimplePopo $simplePopo): int => $simplePopo->intProperty);
        self::assertEquals($result[1], $element1);
        self::assertEquals($result[2], $element3);
        self::assertEquals($result[3], $element2);
    }

    public function testHashByProperty(): void
    {
        $collection = [];
        $element1 = new SimplePopo('a', 1);
        $collection[] = $element1;
        $element2 = new SimplePopo('c', 3);
        $collection[] = $element2;
        $element3 = new SimplePopo('b', 2);
        $collection[] = $element3;

        $result = CollectionUtils::hashByProperty($collection, 'intProperty');
        self::assertEquals($result[1], $element1);
        self::assertEquals($result[2], $element3);
        self::assertEquals($result[3], $element2);
    }

    public function testHashByKey(): void
    {
        $results = CollectionUtils::hashByKey([['key' => 'a'], ['key' => 'b'],], 'key');
        self::assertEquals(['a' => ['key' => 'a'], 'b' => ['key' => 'b']], $results);
    }

    public function testHashByKeyWithDuplicate(): void
    {
        $this->expectException(Exception::class);
        CollectionUtils::hashByKey([['key' => 'a'], ['key' => 'b'], ['key' => 'a']], 'key');
    }

    public function testHashByKeyWithDuplicateAllowed(): void
    {
        $results = CollectionUtils::hashByKey([
            ['key' => 'a', 'value' => 1],
            ['key' => 'b', 'value' => 2],
            ['key' => 'a', 'value' => 3],
        ], 'key', true);
        self::assertEquals(
            [
                'a' => ['key' => 'a', 'value' => 3],
                'b' => ['key' => 'b', 'value' => 2],
            ],
            $results
        );
    }

    public function testHashByKeyWithInvalidValue(): void
    {
        $this->expectException(Exception::class);
        CollectionUtils::hashByKey([['key' => 3.1], ['key' => 'b'], ['key' => 'a']], 'key');
    }
}
