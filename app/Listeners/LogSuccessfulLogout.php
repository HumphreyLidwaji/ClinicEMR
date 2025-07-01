<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogout
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
 public function handle(Logout $event)
{
    \OwenIt\Auditing\Models\Audit::create([
        'user_id' => $event->user->id,
        'event' => 'logout',
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
