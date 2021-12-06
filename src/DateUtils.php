<?php

namespace Dontdrinkandroot\Common;

class DateUtils
{
    public static function currentMillis(): int
    {
        $microtime = explode(' ', microtime());
        return ((int)$microtime[1]) * 1000 + ((int)round((int)$microtime[0] * 1000));
    }
}
