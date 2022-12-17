<?php

namespace Dontdrinkandroot\Common\Pagination;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    public function testInvalid(): void
    {
        try {
            new Pagination(-1, 0, 0);
            $this->fail("Exception expected");
        } catch (InvalidArgumentException $e) {
            /* Expected */
            $this->assertEquals('CurrentPage must be greater than 0', $e->getMessage());
        }

        try {
            new Pagination(1, 0, 0);
            $this->fail("Exception expected");
        } catch (InvalidArgumentException $e) {
            /* Expected */
            $this->assertEquals('PerPage must be greater than 0', $e->getMessage());
        }

        try {
            new Pagination(1, 1, -1);
            $this->fail("Exception expected");
        } catch (InvalidArgumentException $e) {
            /* Expected */
            $this->assertEquals('Total must be greater equals 0', $e->getMessage());
        }
    }

    public function testGetTotalPages(): void
    {
        $pagination = new Pagination(1, 1, 0);
        $this->assertEquals(0, $pagination->getTotalPages());

        $pagination = new Pagination(1, 1, 1);
        $this->assertEquals(1, $pagination->getTotalPages());

        $pagination = new Pagination(1, 1, 2);
        $this->assertEquals(2, $pagination->getTotalPages());

        $pagination = new Pagination(1, 2, 2);
        $this->assertEquals(1, $pagination->getTotalPages());
    }

    public function testGetCurrentPage(): void
    {
        $pagination = new Pagination(1, 2, 3);
        $this->assertEquals(1, $pagination->currentPage);

        $pagination = new Pagination(42, 2, 3);
        $this->assertEquals(42, $pagination->currentPage);
    }

    public function testGetTotal(): void
    {
        $pagination = new Pagination(1, 2, 42);
        $this->assertEquals(42, $pagination->total);
    }

    public function testHasNextPage(): void
    {
        $pagination = new Pagination(1, 2, 3);
        $this->assertTrue($pagination->hasNextPage());

        $pagination = new Pagination(2, 2, 3);
        $this->assertFalse($pagination->hasNextPage());
    }

    public function testHasPreviousPage(): void
    {
        $pagination = new Pagination(1, 2, 3);
        $this->assertFalse($pagination->hasPreviousPage());

        $pagination = new Pagination(2, 2, 3);
        $this->assertTrue($pagination->hasPreviousPage());
    }
}
