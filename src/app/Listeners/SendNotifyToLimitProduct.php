<?php

namespace App\Listeners;

use App\Events\ReduceProductToLimit;
use App\Models\User;
use App\Notifications\SendLimitProductNotify;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

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
        $adminUsers = [];

        $admins = User::role('Admin')->get();
        $superAdmin = User::role('Super Admin')->get();

        Notification::sendNow($superAdmin  , new SendLimitProductNotify($event->product));
    }
}
