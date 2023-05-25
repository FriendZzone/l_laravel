<?php

namespace App\Listeners;

use App\Models\Orders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailAfterOrderPayment3 implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        //
        sleep(5);
        $order = new Orders();
        $order->amount = $event->orders->amount . 4;
        $order->note = $event->orders->note . '4';
        $order->save();
        return false;
    }
}
