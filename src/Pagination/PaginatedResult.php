<?php

namespace Dontdrinkandroot\Common\Pagination;

use ArrayObject;

/**
 * @template T
 *
 * @extends ArrayObject<array-key,T>
 */
class PaginatedResult extends ArrayObject
{
    /** @param array<array-key,T> $results */
    public function __construct(private readonly Pagination $pagination, array $results)
    {
        parent::__construct($results);
    }

    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
