<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class CrudOperationTest extends TestCase
{
    public function testAll(): void
    {
        $all = CrudOperation::all();
        $this->assertContains(CrudOperation::LIST, $all);
        $this->assertContains(CrudOperation::CREATE, $all);
        $this->assertContains(CrudOperation::READ, $all);
        $this->assertContains(CrudOperation::UPDATE, $all);
        $this->assertContains(CrudOperation::DELETE, $all);
    }
}
