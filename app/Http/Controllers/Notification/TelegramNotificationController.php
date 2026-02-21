<?php

namespace App\Http\Controllers\Notification;

use App\Http\Controllers\Controller;
use App\Notifications\Socialite\Telegram\WelcomeNotification;
use Illuminate\Http\Request;

class TelegramNotificationController extends Controller
{
    public function send(Request $request)
    {
        authUser()->notify(new WelcomeNotification('Welcome to our platform! This is a Telegram notification.'));

        return back();

    }
}
