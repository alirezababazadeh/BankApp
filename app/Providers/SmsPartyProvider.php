<?php

namespace App\Providers;

use App\Notification\Sms\KavenegarParty;
use App\Notification\Sms\SmsPartyInterface;
use Illuminate\Support\ServiceProvider;

class SmsPartyProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SmsPartyInterface::class, KavenegarParty::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
