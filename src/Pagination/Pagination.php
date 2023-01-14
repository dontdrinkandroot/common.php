<?php

namespace Dontdrinkandroot\Common\Pagination;

use InvalidArgumentException;
use LogicException;

class Pagination
{
    public function __construct(
        public readonly int $currentPage,
        public readonly int $perPage,
        public readonly int $total
    ) {
        if ($currentPage < 1) {
            throw new InvalidArgumentException('CurrentPage must be greater than 0');
        }

        if ($perPage < 1) {
            throw new InvalidArgumentException('PerPage must be greater than 0');
        }

        if ($total < 0) {
            throw new InvalidArgumentException('Total must be greater equals 0');
        }
    }

    public function getTotalPages(): int
    {
        if ($this->total === 0) {
            return 0;
        }

        return (int)(($this->total - 1) / $this->perPage + 1);
    }

    public function hasNextPage(): bool
    {
        return $this->currentPage < $this->getTotalPages();
    }

    public function nextPage(): int
    {
        return $this->currentPage + 1;
    }

    public function withNextPage(): Pagination
    {
        if (!$this->hasNextPage()) {
            throw new LogicException('No next page');
        }
        return new Pagination($this->nextPage(), $this->perPage, $this->total);
    }

    public function hasPreviousPage(): bool
    {
        return $this->currentPage > 1;
    }

    public function previousPage(): int
    {
        return $this->currentPage - 1;
    }

    public function withPreviousPage(): Pagination
    {
        if (!$this->hasPreviousPage()) {
            throw new LogicException('No previous page');
        }
        return new Pagination($this->previousPage(), $this->perPage, $this->total);
    }

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

    public static function computeOffset(int $page, int $perPage): int
    {
        return ($page - 1) * $perPage;
    }
}
