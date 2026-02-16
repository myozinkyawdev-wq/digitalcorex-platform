<?php

namespace App\Enums;

enum ProductType: string
{
    use EnumHelper;

    case KEY = 'Key';
    case ACCOUNT = 'Account';
    case SERVICE = 'Service';
    case TOPUP = 'Topup';
}
