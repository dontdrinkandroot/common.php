<?php

namespace Dontdrinkandroot\Common;

use RuntimeException;

class ClassNameUtils
{
    public static function getTableizedShortName(
        string $className
    ): string {
        $lastPart = self::getShortName(
            $className
        );

        $tableizedShortName = preg_replace(
            '~(?<=\\w)([A-Z])~u',
            '_$1',
            $lastPart
        );

        if ($tableizedShortName === null) {
            throw new RuntimeException(
                sprintf(
                    'preg_replace returned null for value "%s"',
                    $lastPart
                )
            );
        }

        return mb_strtolower($tableizedShortName);
    }

    public static function getShortName(string $className): string
    {
        $parts = explode("\\", $className);

        return $parts[count($parts) - 1];
    }
}
