<?php

namespace App\Listeners;

use App\Events\OrderPayment;
use App\Models\Orders;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailAfterOrderPayment implements ShouldQueue
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
     * @param  \App\Events\OrderPayment  $event
     * @return void
     */
    public function handle(OrderPayment $event)
    {
        // sleep(10);
        // $amount = $event->orders->amount;
        // $note = $event->orders->note;
        // $content = "Amount: $amount 232, Note: $note";
        // file_put_contents('./data.text', $content);
        //
        $order = new Orders();
        $order->amount = $event->orders->amount . 3;
        $order->note = $event->orders->note . '3';
        $order->save();
        return true;
    }
}
