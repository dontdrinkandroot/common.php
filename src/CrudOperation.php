<?php

namespace Dontdrinkandroot\Common;

enum CrudOperation: string
{
    case LIST = 'LIST';
    case CREATE = 'CREATE';
    case READ = 'READ';
    case UPDATE = 'UPDATE';
    case DELETE = 'DELETE';

    public static function all(): array
    {
        return [...self::allRead(), ...self::allWrite()];
    }

    public static function allRead(): array
    {
        return [self::LIST, self::READ];
    }

    public static function allWrite(): array
    {
        return [self::CREATE, self::UPDATE, self::DELETE];
    }
}
