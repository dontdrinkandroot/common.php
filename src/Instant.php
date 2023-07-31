<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use DateTimeInterface;
use Stringable;

class Instant implements Stringable
{
    private function __construct(private int $timestamp)
    {
    }

    public static function fromTimestamp(int $timestamp): self
    {
        return new self($timestamp);
    }

    public static function fromUnixTimestamp(int $timestamp): self
    {
        return new self($timestamp * 1000);
    }

    public static function now(): self
    {
        return self::fromTimestamp(DateUtils::currentMillis());
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

    public function getUnixTimestamp(): int
    {
        return (int)floor($this->timestamp / 1000);
    }

    public function getDateTime(): DateTimeInterface
    {
        return DateUtils::fromMillis($this->timestamp);
    }

    public static function fromDateTime(DateTime $dateTime): self
    {
        return new self(DateUtils::toMillis($dateTime));
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return (string)$this->timestamp;
    }
}
