<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
   public function handle(Login $event)
{
    \OwenIt\Auditing\Models\Audit::create([
        'user_id' => $event->user->id,
        'event' => 'login',
        'auditable_type' => get_class($event->user),
        'auditable_id' => $event->user->id,
        'url' => request()->fullUrl(),
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'tags' => ['auth'],
        'created_at' => now(),
    ]);
}

}
