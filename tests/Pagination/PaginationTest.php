<?php

namespace Dontdrinkandroot\Common\Pagination;

use InvalidArgumentException;
use LogicException;
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

    public function testGetOffset(): void
    {
        $pagination = new Pagination(1, 2, 42);
        self::assertEquals(0, $pagination->getOffset());

        $pagination = $pagination->withNextPage();
        self::assertEquals(2, $pagination->getOffset());
    }

    public function testComputeOffset(): void
    {
        self::assertEquals(0, Pagination::computeOffset(1, 2));
        self::assertEquals(2, Pagination::computeOffset(2, 2));
    }

    public function testNextPage(): void
    {
        $pagination = new Pagination(1, 2, 3);
        self::assertEquals(2, $pagination->nextPage());

        $pagination = new Pagination(2, 2, 3);
        self::assertEquals(3, $pagination->nextPage());
    }

    public function testWithNextPage(): void
    {
        $pagination = new Pagination(1, 2, 3);
        $pagination = $pagination->withNextPage();
        self::assertEquals(2, $pagination->currentPage);
        self::assertEquals(2, $pagination->perPage);
        self::assertEquals(3, $pagination->total);
    }

    public function testWithNextPageMissing(): void
    {
        $pagination = new Pagination(2, 2, 3);
        $this->expectException(LogicException::class);
        $pagination->withNextPage();
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

    public function testPreviousPage(): void
    {
        $pagination = new Pagination(1, 2, 3);
        self::assertEquals(0, $pagination->previousPage());

        $pagination = new Pagination(2, 2, 3);
        self::assertEquals(1, $pagination->previousPage());
    }

    public function testWithPreviousPage(): void
    {
        $pagination = new Pagination(2, 2, 3);
        $pagination = $pagination->withPreviousPage();
        self::assertEquals(1, $pagination->currentPage);
        self::assertEquals(2, $pagination->perPage);
        self::assertEquals(3, $pagination->total);
    }

    public function testWithPreviousPageMissing(): void
    {
        $pagination = new Pagination(1, 2, 3);
        $this->expectException(LogicException::class);
        $pagination->withPreviousPage();
    }
}
