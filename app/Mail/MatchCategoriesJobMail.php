<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MatchCategoriesJobMail extends Mailable
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
        return $this->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->to($user->email, $user->name)
                        ->subject('Dear User, "' . $user->name . '" Matching Category Job For You "' . config('app.name'))
                        ->view('emails.match_categories_job')
                        ->with(
                                [
                                    'name' => $user->name
                                ]
        );
    }

}
