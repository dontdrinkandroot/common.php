<?php

namespace Dontdrinkandroot\Common\Pagination;

/**
 * @template T
 */
class PaginatedResult
{
    private Pagination $pagination;

    /** @var array<array-key,T> */
    private array $results;

    /** @param array<array-key,T> $results */
    public function __construct(Pagination $pagination, array $results)
    {
        $this->pagination = $pagination;
        $this->results = $results;
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }

    /** @return array<array-key,T> */
    public function getResults(): array
    {
        return $this->results;
    }
}
