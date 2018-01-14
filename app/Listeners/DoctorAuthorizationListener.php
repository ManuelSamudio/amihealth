<?php

namespace App\Listeners;

use App\Events\DoctorAuthorization;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DoctorAuthorizationListener implements ShouldQueue
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
     * @param  DoctorAuthorization  $event
     * @return void
     */
    public function handle(DoctorAuthorization $event)
    {
        //
    }
}
