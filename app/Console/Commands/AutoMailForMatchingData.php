<?php

namespace App\Console\Commands;

use Auth;
use App\User;
use App\Job;
use App\MatchingDataMailProcess;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AutoMailForMatchingData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoMail:matchingData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto Sending Mail For Matching Data Field';

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
    public function handle(Request $request)
    {
        $last = MatchingDataMailProcess::where('status',0)->latest()->first()->job_functional_area_id;
        $users = MatchingDataMailProcess::where('user_functional_area_id', 'job_functional_area_id')
                            ->orWhere('user_functional_area_id', '=', $last)
                            ->get();
                            //dd($last);
        foreach ($users as $user) {
           Mail::send('emails.match_job_field_with_users', ['users' => $users], function ($mail) use ($user) {
                $mail->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                $mail->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                $mail->to($user->user_email)->subject('Dear User, Reecent new Category/Hot Matching Job For You');
            });
        }
        if( count(Mail::failures()) > 0 ) 
        {
            echo "Mail Not sent successfully!";
        } 
        else 
        {
            MatchingDataMailProcess::where('job_functional_area_id', '=', $last)->where('status',0)->update(['status' => 1]);
        }
        $this->info('Category And Hot Job sent to All Users');
        
    }
}
