<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class CrudOperationTest extends TestCase
{
    public function testAll(): void
    {
        $crudOperations = CrudOperation::all();
        self::assertEquals(
            [
                CrudOperation::LIST,
                CrudOperation::READ,
                CrudOperation::CREATE,
                CrudOperation::UPDATE,
                CrudOperation::DELETE
            ],
            $crudOperations
        );
    }

    public function testAllRead(): void
    {
        $crudOperations = CrudOperation::allRead();
        self::assertEquals([CrudOperation::LIST, CrudOperation::READ], $crudOperations);
    }

    public function testAllWrite(): void
    {
        $crudOperations = CrudOperation::allWrite();
        self::assertEquals([CrudOperation::CREATE, CrudOperation::UPDATE, CrudOperation::DELETE], $crudOperations);
    }
}
