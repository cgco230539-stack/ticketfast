<?php

namespace App\Providers;

use App\Events\UserLoggedIn;
use App\Listeners\SendLoginNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserLoggedIn::class => [
            SendLoginNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}