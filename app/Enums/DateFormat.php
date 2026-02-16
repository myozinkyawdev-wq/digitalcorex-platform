<?php

namespace App\Enums;

enum DateFormat: string
{
    use EnumHelper;

    case MdYHia = 'M d, Y H:i a';

    case MdY = 'M d, Y';

    case Hi = 'H:i';

    case Hia = 'H:i a';

    case Hisa = 'H:i:s a';
}
