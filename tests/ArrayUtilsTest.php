<?php

namespace Dontdrinkandroot\Common;

use PHPUnit\Framework\TestCase;

class ArrayUtilsTest extends TestCase
{
    public function testIsEmpty(): void
    {
        /** @phpstan-ignore staticMethod.alreadyNarrowedType */
        self::assertTrue(ArrayUtils::isEmpty([]));
        /** @phpstan-ignore staticMethod.impossibleType */
        self::assertFalse(ArrayUtils::isEmpty([1]));
    }
}
