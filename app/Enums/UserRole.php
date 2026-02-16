<?php

namespace App\Enums;

enum UserRole: string
{
    use EnumHelper;

    case USER = 'User';
    case ADMIN = 'Admin';
}
