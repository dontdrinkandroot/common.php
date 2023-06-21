<?php

namespace Dontdrinkandroot\Common;

/* Timeunits from Milliseconds to years, mapped to their milliseconds value */

enum TimeUnit: int
{
    case MILLISECOND = 1;
    case SECOND = 1000;
    case MINUTE = 60000;
    case HOUR = 3600000;
    case DAY = 86400000;
    case WEEK = 604800000;
}
