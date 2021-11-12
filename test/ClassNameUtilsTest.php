<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class ClassNameUtilsTest extends TestCase
{
    public function testGetShortName(
    ): void
    {
        $this->assertEquals(
            'BlogPost',
            ClassNameUtils::getShortName(
                'App\Entity\BlogPost'
            )
        );
        $this->assertEquals(
            'User',
            ClassNameUtils::getShortName(
                'User'
            )
        );
    }

    public function testGetTableizedShortName(): void
    {
        $this->assertEquals('blog_post', ClassNameUtils::getTableizedShortName('App\Entity\BlogPost'));
        $this->assertEquals('user', ClassNameUtils::getTableizedShortName('User'));
    }
}
