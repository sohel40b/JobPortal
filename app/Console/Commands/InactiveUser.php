<?php

namespace App\Console\Commands;

use App\User;
Use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class InactiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'If User Not Login More than 4 month Then Send Mail';

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
        $limit = Carbon::now()->subMonths(3);
        $inactive_user = User::where('last_login_at', '<', $limit)->get();
        foreach ($inactive_user as $user) {
            Mail::send('emails.inactive_user_mail', ['inactive_user' => $inactive_user], function ($mail) use ($user) {
                 $mail->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                 $mail->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                 $mail->to($user->email)
                 ->subject('Dear User, Every 3 Month Send Mail For Inactive User');
             });
         }
          
         $this->info('Every 3 Month Send Mail For Inactive User');
    }
}
