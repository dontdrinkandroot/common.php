<?php

namespace Dontdrinkandroot\Common;

enum TimeUnit: int
{
    case MILLISECOND = 1;
    case SECOND = 1000;
    case MINUTE = 60000;
    case HOUR = 3600000;
    case DAY = 86400000;
    case WEEK = 604800000;
}
