<?php

namespace App\Enums;

enum OrderStatus: string
{
    use EnumHelper;

    case PENDING = 'Pending';
    case PROCESSING = 'Processing';
    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';
}