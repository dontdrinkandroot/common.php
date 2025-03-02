<?php

namespace Dontdrinkandroot\Common\Pagination;

use PHPUnit\Framework\TestCase;

class PaginatedResultTest extends TestCase
{
    public function testGetters(): void
    {
        $pagination = new Pagination(1, 10, 20);
        $results = ['c', 'b', 'a',];
        $paginatedResult = new PaginatedResult($pagination, $results);

        self::assertEquals(2, $paginatedResult->pagination->getTotalPages());
        self::assertEquals(['c', 'b', 'a'], $paginatedResult->getArrayCopy());
    }
}
