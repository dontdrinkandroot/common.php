<?php

namespace Dontdrinkandroot\Common\Model;

use DateTimeInterface;

class DateEntry
{
    public function __construct(
        public readonly DateTimeInterface $date,
        public readonly string $value
    ) {
    }
}
