<?php

namespace App\Enums;


enum AdminMenuOrder: int
{
    use EnumHelper;

    case DASHBOARD = 1;

    case CATEGORIES = 2;

    case PRODUCTS = 3;

    case VARIANT_UNITS = 4;

    case USERS = 5;

    case ACCOUNT_PLATFORMS = 6;
}