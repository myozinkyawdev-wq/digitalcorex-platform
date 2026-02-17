<?php

namespace App\Enums;

enum CategoryCode: string
{
    use EnumHelper;

    case VPN_PRIVACY = 'vpn-privacy';
    case STREAMING = 'streaming';
    case SOCIAL_MEDIA = 'social-media';
}
