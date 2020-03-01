<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MatchHotJobMail extends Mailable
{

    use SerializesModels;

    public $matchingDataMailProcess;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($matchingDataMailProcess)
    {
        $this->matchingDataMailProcess = $matchingDataMailProcess;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->matchingDataMailProcess->getUser();
        return $this->to(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->subject('Dear User, "' . $user->name . '" has posted new Hot job on "' . config('app.name'))
                        ->view('emails.match_hot_job')
                        ->with(
                                [
                                    'name' => $user->name,
                                ]
        );
    }

}
