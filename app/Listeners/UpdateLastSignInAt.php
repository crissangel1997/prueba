<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class UpdateLastSignInAt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
         $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $event->user->last_sign_in_at = $event->user->current_sign_in_at ?  $event->user->current_sign_in_at : Carbon::now()->toDateTimeString();

        $event->user->current_sign_in_at = Carbon::now();
      
        $event->user->save();
    }
}
