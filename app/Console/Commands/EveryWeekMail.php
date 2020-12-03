<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class EveryWeekMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyWeek:saturdays';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every Week Send Mail For All User';

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
        $users = User::all();
        foreach ($users as $user) {
            Mail::send('emails.every_week_mail', ['users' => $users], function ($mail) use ($user) {
                 $mail->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                 $mail->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                 $mail->to($user->email)
                 ->subject('Dear User, Every Week Send Some Mail');
             });
         }
          
         $this->info('Every Week Send Mail All Users');
    }
}
