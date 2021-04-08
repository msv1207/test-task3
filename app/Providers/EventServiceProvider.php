<?php

namespace App\Providers;

use App\Models\PasswordReset;
use App\Observers\PasswordResetObserver;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        PasswordReset::observe(PasswordResetObserver::class);
    }
}
