<?php

namespace Dontdrinkandroot\Crud;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class CrudOperation
{
    const LIST = 'LIST';
    const CREATE = 'CREATE';
    const READ = 'READ';
    const UPDATE = 'UPDATE';
    const DELETE = 'DELETE';

    public static function all(): array
    {
        return [self::LIST, self::CREATE, self::READ, self::UPDATE, self::DELETE];
    }
}
