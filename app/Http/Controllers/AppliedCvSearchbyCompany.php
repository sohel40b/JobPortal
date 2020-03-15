<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\JobApply;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchAppliedCv;


class AppliedCvSearchbyCompany extends Controller
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
        $this->middleware('auth', ['except' => ['CvSearchByCompany']]);
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
}
