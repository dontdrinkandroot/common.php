<?php

namespace Dontdrinkandroot\Common;

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
        $this->assertEquals(['a', 'c', 'b'], $result);

        $result = CollectionUtils::collect(
            $collection,
            fn(SimplePopo $simplePopo): int => $simplePopo->getIntProperty()
        );
        $this->assertEquals([1, 3, 2], $result);
    }

    public function testCollectProperty(): void
    {
        $collection = [];
        $collection[] = new SimplePopo('a', 1);
        $collection[] = new SimplePopo('c', 3);
        $collection[] = new SimplePopo('b', 2);

        $result = CollectionUtils::collectProperty($collection, 'stringProperty');
        $this->assertEquals(['a', 'c', 'b'], $result);
    }
}
