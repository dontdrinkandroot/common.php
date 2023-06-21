<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use DateTimeInterface;

class Instant
{
    private int $timestamp;

    /**
     * @param int|null $timestamp The timestamp in milliseconds since epoch or null for current time.
     */
    public function __construct(?int $timestamp = null)
    {
        if (null === $timestamp) {
            $timestamp = DateUtils::currentMillis();
        }

        $this->timestamp = $timestamp;
    }

    /**
     * Mutable add.
     */
    public function add(int $value, TimeUnit $timeUnit): void
    {
        $this->timestamp += $value * $timeUnit->value;
    }

    /**
     * Mutable sub.
     */
    public function sub(int $value, TimeUnit $timeUnit): void
    {
        $this->timestamp -= $value * $timeUnit->value;
    }

    /**
     * Immutable add.
     */
    public function plus(int $value, TimeUnit $timeUnit): self
    {
        return new self($this->getTimestamp() + ($value * $timeUnit->value));
    }

    /**
     * Immutable sub.
     */
    public function minus(int $value, TimeUnit $timeUnit): self
    {
        return new self($this->getTimestamp() - ($value * $timeUnit->value));
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function toDateTime(): DateTimeInterface
    {
        return DateUtils::fromMillis($this->timestamp);
    }

    public static function fromDateTime(DateTime $dateTime): self
    {
        return new self(DateUtils::toMillis($dateTime));
    }
}
