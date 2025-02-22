<?php

namespace Dontdrinkandroot\Common;

class StringUtils
{
    /**
     * Checks if a string starts with another string.
     *
     * @param string $haystack The string to search in.
     * @param string $needle   The string to search.
     */
    public static function startsWith(string $haystack, string $needle): bool
    {
        return $needle === "" || str_starts_with($haystack, $needle);
    }

    /**
     * Checks if a string ends with another string.
     *
     * @param string $haystack The string to search in.
     * @param string $needle   The string to search.
     */
    public static function endsWith(string $haystack, string $needle): bool
    {
        return $needle === "" || str_ends_with($haystack, $needle);
    }

    /**
     * Get the first character of a string.
     *
     * @param string $str The string to get the first character of.
     * @return string|null The first character or null if not found.
     */
    public static function getFirstChar(string $str): ?string
    {
        $length = strlen($str);
        if ($length === 0) {
            return null;
        }

        return $str[0];
    }

    /**
     * Get the last character of a string.
     *
     * @param string $str The string to get the last character of.
     * @return string|null The last character or null if not found.
     */
    public static function getLastChar(string $str): ?string
    {
        $length = strlen($str);
        if ($length === 0) {
            return null;
        }

        return $str[$length - 1];
    }

    /**
     * @param non-empty-string $pattern
     */
    public static function underscore(
        string $string,
        int $case = CASE_LOWER,
        string $pattern = '/(?<=[a-z0-9])([A-Z])/'
    ): string {
        $string = preg_replace($pattern, '_$1', $string);

        if ($case === CASE_UPPER) {
            return strtoupper((string)$string);
        }

        return strtolower((string)$string);
    }

    /**
     * @phpstan-assert-if-false non-empty-string $str
     */
    public static function isEmpty(?string $str): bool
    {
        return null === $str || $str === '';
    }

    /**
     * @phpstan-assert-if-true non-empty-string $str
     */
    public static function isNotEmpty(?string $str): bool
    {
        return null !== $str && '' !== $str;
    }
}
