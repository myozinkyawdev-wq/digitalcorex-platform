<?php

namespace App\Enums;

enum FileDirectory: string
{
    use EnumHelper;

    case PRODUCT = "products";
}
