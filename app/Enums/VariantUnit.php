<?php

namespace App\Enums;

enum VariantUnit: string
{
    use EnumHelper;

    // Durations
    case Durations = 'durations';
    case HOURS = 'hours';
    case DAYS = 'days';
    case WEEKS = 'weeks';
    case MONTHS = 'months';
    case YEARS = 'years';
    case LIFETIME = 'lifetime';

    // Data Storage
    case MB = 'MB';
    case GB = 'GB';
    case TB = 'TB';

    // Usage Limit
    case USAGE_LIMIT = 'usage-limit';
    case DEVICES = 'devices';
    case TOKENS = 'tokens';
    case ACCOUNTS = 'accounts';
    case USERS = 'users';
    case UNLIMITED = 'unlimited';

}
