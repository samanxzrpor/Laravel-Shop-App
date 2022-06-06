<?php

namespace App\Listeners;

use App\Events\ReduceProductToLimit;
use App\Notifications\SendLimitProductNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SendNotifyToLimitProduct implements ShouldQueue
{

    /**
     * Handle the event.
     *
     * @param ReduceProductToLimit $event
     * @return void
     */
    public function handle(ReduceProductToLimit $event)
    {
        Notification::sendNow([config('permission.super_admin_email')] , new SendLimitProductNotify($event->product));
    }
}
