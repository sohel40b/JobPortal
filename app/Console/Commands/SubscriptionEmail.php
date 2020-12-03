<?php

namespace App\Console\Commands;

use App\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SubscriptionEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Mail For Subcriptions User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $subscriptions = Subscription::all();
        foreach ($subscriptions as $subscription) {
            Mail::send('emails.subscription_email', ['subscriptions' => $subscriptions], function ($mail) use ($subscription) {
                 $mail->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                 $mail->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                 $mail->to($subscription->email)
                 ->subject('Dear User, Daily Send Subscriptions Maill');
             });
         }
          
         $this->info('Daily Send Subscriptions Mall For All');
    }
}
