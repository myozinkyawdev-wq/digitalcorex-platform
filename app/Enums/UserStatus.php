<?php

namespace App\Enums;

enum UserStatus: string
{
    use EnumHelper;

    case ACTIVE = 'Active';
    case SUSPENDED = 'Suspended';
}
