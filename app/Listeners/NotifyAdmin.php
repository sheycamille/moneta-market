<?php

namespace App\Listeners;

use Exception;

use App\Models\Trader7;

use App\Libraries\MobiusTrader;


class NotifyAdmin
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
     * @param $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->user;

        // return for users
        if (strpos(strtolower(get_class($user)), 'user') > -1)
            return;


    }

}
