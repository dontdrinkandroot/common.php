<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class ClassNameUtilsTest extends TestCase
{
    public function testGetShortName(): void
    {
        self::assertEquals('BlogPost', ClassNameUtils::getShortName('App\Entity\BlogPost'));
        self::assertEquals('User', ClassNameUtils::getShortName('User'));
    }

    public function testGetTableizedShortName(): void
    {
        self::assertEquals('blog_post', ClassNameUtils::getTableizedShortName('App\Entity\BlogPost'));
        self::assertEquals('user', ClassNameUtils::getTableizedShortName('User'));
    }
}
