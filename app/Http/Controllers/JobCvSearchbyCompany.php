<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
Use App\JobApply;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchAppliedCv;


class JobCvSearchbyCompany extends Controller
{
    //use Skills;
    use FetchAppliedCv;

    private $functionalAreas = '';
    private $careerLevels = '';
    private $jobExperiences = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->functionalAreas = DataArrayHelper::langFunctionalAreasArray();
        $this->careerLevels = DataArrayHelper::langCareerLevelsArray();
        $this->jobExperiences = DataArrayHelper::langJobExperiencesArray();
    }

    public function CvSearchByCompany(Request $request)
    {
        $search = $request->query('search', '');
        $users_ids = $request->query('id', array());
        $functional_area_ids = $request->query('functional_area_id', array());
        $career_level_ids = $request->query('career_level_id', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $order_by = $request->query('order_by', 'id');
        $limit = 10;
        $jobSeekers = $this->fetchAppliedCv($search, $users_ids, $functional_area_ids, $career_level_ids, $job_experience_ids, $order_by, $limit);

        /*         * ************************************************** */
        $usersIdsArray = $this->fetchIdsArray($search, $users_ids, $functional_area_ids, $career_level_ids, $job_experience_ids, 'job_apply.user_id');

        /*         * ************************************************** */
        $userIdsArray = $this->fetchUserIdsArray($usersIdsArray);

        /*         * ************************************************** */

        return view('job.company_search_applied_cv')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('careerLevels', $this->careerLevels)
                        ->with('jobExperiences', $this->jobExperiences)
                        ->with('jobSeekers', $jobSeekers)
                        ->with('usersIdsArray', $usersIdsArray)
                        ->with('userIdsArray', $userIdsArray);
    }






    //public function CvSearchByCompany(Request $request)
    //{
        //$query = JobApply::with('user'); //names of eager loaded relationships

       // $user_id = Input::get('user_id');
        //if($user_id)
       // $query = $query->whereHas('user', function($userQuery) use ($user_id){
       // $userQuery->where('id', '=', $user_id); //is is the primary key in areas
       // });

       // $result = $query->get();// make the query and load the data
      
        //result is a collection
       // return View('job.job_applications')->with('projects', $result);

        /* public function index()
        {
            $input = Request::all();

            $query = User::rightJoin('user_profiles', 'users.id', '=', 'user_profiles.user_id');

            if (isset($input['u']) && $input['u'])
                $query->where('users.username', '=', $input['u']);

            if (isset($input['p'])  && $input['p'])
                $query->where('user_profiles.postcode', '=', $input ['p']);

            if (isset($input['o1']) && $input['o1'])
                $query->whereNotNull('user_profile.avatar');

            if (isset($input['o2']) && $input['o2'])
                $query->orderBy('users.last_online', 'DESC');

            if (isset($input ['o3']) && $input['o3'])
                $query->orderBy('users.type', 'DESC');

            $users = $query->get();

            return view('view', compact('users'));
        } */
    //}
    //public function CvSearchByCompany(Request $request)
       // {
            // // we need to show all data from "blog" table
            // $blogs = Blog::all();
            // // show data to our view
            // return view('blog.index',['blogs' => $blogs]);
            //$functional_area = $request->input('functional_area_id');
            //$name = $request->input('name');
       
            //$users = JobApply::where('user_id', 'like', Auth::user()->id)->first();
           // $search = $request->get('search');

           // $job_applications = JobApply::where('job_id', 'like', '%' . $search . '%')
                  //                  ->orderBy('id')
                 //                   ->paginate(6);

           // return view('job.job_applications', ['job_applications' => $job_applications]);
           //$users = User::where('is_active', true);

            //if ($request->has('name')) {
           //     $users->where('name', '>', $request->name);
            //}

            ///if ($request->has('email')) {
             //   $users->where('email', $request->email);
           // }

           // return $users->get();

       // }
       
}
