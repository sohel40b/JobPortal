<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LiveJobMailable extends Mailable
{

    use SerializesModels;

    public $job;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job = $job;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = $this->job->getCompany();
        return $this->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->to($company->email, $company->name)
                        ->subject('Employer/Company "' . $company->name . '" has posted Live Job On Our Website "' . config('app.name'))
                        ->view('emails.company_live_job_mail')
                        ->with(
                                [
                                    'name' => $company->name,
                                ]
        );
    }

}
