<?php

namespace App\Listeners;

use Mail;
use App\Events\LiveJob;
use App\Mail\LiveJobMailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComanyLiveJobListener implements ShouldQueue
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
     * @param  LiveJob  $event
     * @return void
     */
    public function handle(LiveJob $event)
    {
        Mail::send(new LiveJobMailable($event->job));
    }

}
