<?php

namespace App\Listeners;

use Mail;
use App\Events\AutoMail;
use App\Mail\MatchCategoriesJobMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MatchCategoriesJobListener implements ShouldQueue
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
        Mail::send(new MatchCategoriesJobMail($event->matchingDataMailProcess));
    }

}
