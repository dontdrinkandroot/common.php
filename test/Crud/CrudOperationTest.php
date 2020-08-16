<?php

namespace Dontdrinkandroot\Crud;

use PHPUnit\Framework\TestCase;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class CrudOperationTest extends TestCase
{
    public function testAll()
    {
        $all = CrudOperation::all();
        $this->assertContains(CrudOperation::LIST, $all);
        $this->assertContains(CrudOperation::CREATE, $all);
        $this->assertContains(CrudOperation::READ, $all);
        $this->assertContains(CrudOperation::UPDATE, $all);
        $this->assertContains(CrudOperation::DELETE, $all);
    }
}
