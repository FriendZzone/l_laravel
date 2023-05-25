<?php

namespace App\Providers;

use App\Events\OrderPayment;
use App\Events\UserBlockEvent;
use App\Listeners\SendEmailAfterOrderPayment;
use App\Listeners\SendEmailAfterOrderPayment2;
use App\Listeners\SendEmailAfterOrderPayment3;
use App\Listeners\SendEmailBlockUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
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
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderPayment::class => [
            SendEmailAfterOrderPayment::class,
            SendEmailAfterOrderPayment2::class,
            SendEmailAfterOrderPayment3::class,
        ],
        UserBlockEvent::class => [
            SendEmailBlockUser::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
