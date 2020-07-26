<?php

namespace Dontdrinkandroot\Utils;

use PHPUnit\Framework\TestCase;

/**
 * @author Philip Washington Sorst <philip@sorst.net>
 */
class ClassNameUtilsTest extends TestCase
{
    public function testGetShortName()
    {
        $this->assertEquals('BlogPost', ClassNameUtils::getShortName('App\Entity\BlogPost'));
        $this->assertEquals('User', ClassNameUtils::getShortName('User'));
    }

    public function testGetTableizedShortName()
    {
        $this->assertEquals('blog_post', ClassNameUtils::getTableizedShortName('App\Entity\BlogPost'));
        $this->assertEquals('user', ClassNameUtils::getTableizedShortName('User'));
    }
}
