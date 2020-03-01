<?php

namespace App\Events;

use App\MatchingDataMailProcess;
use Illuminate\Queue\SerializesModels;

class AutoMail
{

    use SerializesModels;

    public $matchingDataMailProcess;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(MatchingDataMailProcess $matchingDataMailProcess)
    {
        $this->matchingDataMailProcess = $matchingDataMailProcess;
    }


}
