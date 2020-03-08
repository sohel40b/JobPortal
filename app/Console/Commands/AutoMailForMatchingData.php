<?php

namespace App\Console\Commands;

use Auth;
use App\User;
use App\Job;
use App\MatchingDataMailProcess;
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
    public function handle()
    {
        //$users = MatchingDataMailProcess::all();
        $last_data = MatchingDataMailProcess::orderBy('created_at', 'desc')->whereRaw('job_functional_area_id')->take(1)->get();
        //$user_f = MatchingDataMailProcess::orderBy('user_id', 'desc')->whereRaw('user_functional_area_id')->get();
        //$countData = MatchingDataMailProcess::select($last_data,'user_functional_area_id')->where('id')->get();
        //$users = MatchingDataMailProcess::where($last_data)->pluck('user_functional_area_id')->get();
        //$users = MatchingDataMailProcess::where('job_functional_area_id', '=', DB::raw('user_functional_area_id'))
                                                //->where('job_functional_area_id', $last_data)
                                                //->get();

        $users = MatchingDataMailProcess::where('created_at', 'desc')
                                            ->whereRaw('job_functional_area_id')
                                            ->take(1)
                                            ->get();
        //$users = MatchingDataMailProcess::select(DB::raw('COUNT(*) as total_quantity, job_functional_area_id'))
                                            //->where('job_functional_area_id', '>', 'user_functional_area_id')
                                            //->groupBy('job_functional_area_id')
                                           // ->get();

        foreach ($users as $user) {
           Mail::send('emails.match_categories_job', ['users' => $users], function ($mail) use ($user) {
                $mail->from(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                $mail->replyTo(config('mail.recieve_to.address'), config('mail.recieve_to.name'));
                $mail->to($user->user_email)
                ->subject('Dear User, Reecent new Category/Hot Matching Job For You');
            });
        }
         
        $this->info('Category And Hot Job sent to All Users');
        
    }
}
