<?php

namespace Dontdrinkandroot\Common;

class CrudOperation
{
    public const LIST = 'LIST';
    public const CREATE = 'CREATE';
    public const READ = 'READ';
    public const UPDATE = 'UPDATE';
    public const DELETE = 'DELETE';

    public static function all(
    ): array
    {
        return [self::LIST, self::CREATE, self::READ, self::UPDATE, self::DELETE];
    }
}
