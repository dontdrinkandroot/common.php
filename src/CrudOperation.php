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
        return [self::LIST, self::CREATE, self::READ, self::UPDATE, self::DELETE];
    }
}
