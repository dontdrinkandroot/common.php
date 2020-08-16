<?php

namespace Dontdrinkandroot\Pagination;

use PHPUnit\Framework\TestCase;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class PaginatedResultTest extends TestCase
{
    public function testGetters()
    {
        $pagination = new Pagination(1, 10, 20);
        $results = ['c', 'b', 'a'];
        $paginatedResult = new PaginatedResult($pagination, $results);
        $this->assertEquals(2, $paginatedResult->getPagination()->getTotalPages());
        $this->assertEquals(['c', 'b', 'a'], $paginatedResult->getResults());
    }
}
