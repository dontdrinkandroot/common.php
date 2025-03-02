<?php

namespace Dontdrinkandroot\Common;

use DateTime;
use Exception;
use Override;
use Stringable;

class FlexDate implements Stringable
{
    final public const string PRECISION_YEAR = 'year';
    final public const string PRECISION_MONTH = 'month';
    final public const string PRECISION_DAY = 'day';
    final public const string PRECISION_NONE = 'none';

    public function __construct(protected ?int $year = null, protected ?int $month = null, protected ?int $day = null)
    {
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(?int $year): void
    {
        $this->year = $year;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function setMonth(?int $month): void
    {
        $this->month = $month;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): void
    {
        $this->day = $day;
    }

    public function hasValue(): bool
    {
        return null !== $this->year || null !== $this->month || null !== $this->day;
    }

    public function isCompleteDate(): bool
    {
        return null !== $this->year && null !== $this->month && null !== $this->day;
    }

    public function isValid(): bool
    {
        try {
            $this->assertValid();

            return true;
        } catch (Exception) {
            return false;
        }
    }

    /**
     * @throws Exception Thrown if the composition is invalid.
     */
    public function assertValid(): bool
    {
        if (null !== $this->day && null === $this->month) {
            throw new Exception('Day set, but no month');
        }

        if (null !== $this->month && null === $this->year) {
            throw new Exception('Month, but no year');
        }

        return true;
    }

    public function isValidDate(): bool
    {
        return checkdate(
            $this->month ?? 1,
            $this->day ?? 1,
            $this->year ?? 0
        );
    }

    public function toDateTime(): DateTime
    {
        $dateTime = new DateTime();
        $inferredYear = $this->year ?? 0;
        $inferredMonth = $this->month ?? 1;
        $inferredDay = $this->day ?? 1;
        $dateTime->setDate($inferredYear, $inferredMonth, $inferredDay);

        return $dateTime;
    }

    #[Override]
    public function __toString(): string
    {
        $string = '';
        if (null !== $this->year) {
            $string .= $this->year;
        }
        if (null !== $this->month) {
            $string .= '-';
            $string .= str_pad((string)$this->month, 2, '0', STR_PAD_LEFT);
        }
        if (null !== $this->day) {
            $string .= '-';
            $string .= str_pad((string)$this->day, 2, '0', STR_PAD_LEFT);
        }

        return $string;
    }

    public static function fromString(string $dateString): FlexDate
    {
        $flexDate = new FlexDate();
        if (StringUtils::isEmpty($dateString)) {
            return $flexDate;
        }

        $parts = explode('-', $dateString);
        $numParts = count($parts);
        $flexDate->setYear((int)$parts[0]);
        if ($numParts > 1) {
            $flexDate->setMonth((int)$parts[1]);
        }
        if ($numParts > 2) {
            $flexDate->setDay((int)$parts[2]);
        }

        return $flexDate;
    }

    public function getPrecision(): string
    {
        if (null !== $this->day) {
            return self::PRECISION_DAY;
        }

        if (null !== $this->month) {
            return self::PRECISION_MONTH;
        }

        if (null !== $this->year) {
            return self::PRECISION_YEAR;
        }

        return self::PRECISION_NONE;
    }

    public function isEmpty(): bool
    {
        return self::PRECISION_NONE === $this->getPrecision();
    }
}
