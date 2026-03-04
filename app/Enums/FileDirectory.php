<?php

namespace App\Enums;

enum FileDirectory: string
{
    use EnumHelper;

    case PRODUCT = "products";
    case USER_ACCOUNT_PLATFORM = "user/account_platforms";
}
