<?php

namespace App\Listeners;

use Mail;
use App\Events\AutoMail;
use App\Mail\MatchHotJobMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MatchHotJobListener implements ShouldQueue
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

    
    public function handle(AutoMail $event)
    {
        Mail::send(new MatchHotJobMail($event->matchingDataMailProcess));
    }

}
