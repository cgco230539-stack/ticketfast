<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Mail\LoginNotificationMail;
use Illuminate\Support\Facades\Mail;

class SendLoginNotification
{
    public function handle(UserLoggedIn $event): void
    {
        Mail::to($event->user->email)->send(
            new LoginNotificationMail(
                $event->user,
                $event->ip,
                $event->userAgent,
                $event->loginTime
            )
        );
    }
}