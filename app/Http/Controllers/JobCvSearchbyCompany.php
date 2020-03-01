<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Input;
use Redirect;
use Carbon\Carbon;
use App\User;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Traits\FetchJobSeekers;


class JobCvSearchbyCompany extends Controller
{
    //use Skills;
    use FetchJobSeekers;

    private $functionalAreas = '';
    private $countries = '';
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
        $this->countries = DataArrayHelper::langCountriesArray();
        $this->careerLevels = DataArrayHelper::langCareerLevelsArray();
        $this->jobExperiences = DataArrayHelper::langJobExperiencesArray();
    }

    public function CvSearchByCompany(Request $request)
    {
        $search = $request->query('search', '');
        $functional_area_ids = $request->query('functional_area_id', array());
        $country_ids = $request->query('country_id', array());
        $state_ids = $request->query('state_id', array());
        $city_ids = $request->query('city_id', array());
        $career_level_ids = $request->query('career_level_id', array());
        $gender_ids = $request->query('gender_id', array());
        $industry_ids = $request->query('industry_ids', array());
        $job_experience_ids = $request->query('job_experience_id', array());
        $current_salary = $request->query('current_salary', '');
        $expected_salary = $request->query('expected_salary', '');
        $salary_currency = $request->query('salary_currency', '');
        $order_by = $request->query('order_by', 'id');
        $limit = 10;
        $jobSeekers = $this->fetchJobSeekers($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, $order_by, $limit);

        /*         * ************************************************** */

        $jobSeekerIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.id');

        /*         * ************************************************** */

        $skillIdsArray = $this->fetchSkillIdsArray($jobSeekerIdsArray);

        /*         * ************************************************** */

        $countryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.country_id');

        /*         * ************************************************** */

        $stateIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.state_id');

        /*         * ************************************************** */

        $cityIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.city_id');

        /*         * ************************************************** */

        $industryIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.industry_id');

        /*         * ************************************************** */


        /*         * ************************************************** */

        $functionalAreaIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.functional_area_id');

        /*         * ************************************************** */

        $careerLevelIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.career_level_id');

        /*         * ************************************************** */

        $genderIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.gender_id');

        /*         * ************************************************** */

        $jobExperienceIdsArray = $this->fetchIdsArray($search, $industry_ids, $functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids, $current_salary, $expected_salary, $salary_currency, 'users.job_experience_id');

        /*         * ************************************************** */

        $seoArray = $this->getSEO($functional_area_ids, $country_ids, $state_ids, $city_ids, $career_level_ids, $gender_ids, $job_experience_ids);

        /*         * ************************************************** */

        $currencies = DataArrayHelper::currenciesArray();

        /*         * ************************************************** */

        $seo = (object) array(
                    'seo_title' => $seoArray['description'],
                    'seo_description' => $seoArray['description'],
                    'seo_keywords' => $seoArray['keywords'],
                    'seo_other' => ''
        );
        return view('job.company_search_applied_cv')
                        ->with('functionalAreas', $this->functionalAreas)
                        ->with('countries', $this->countries)
                        ->with('careerLevels', $this->careerLevels)
                        ->with('jobExperiences', $this->jobExperiences)
                        ->with('currencies', array_unique($currencies))
                        ->with('jobSeekers', $jobSeekers)
                        ->with('skillIdsArray', $skillIdsArray)
                        ->with('countryIdsArray', $countryIdsArray)
                        ->with('stateIdsArray', $stateIdsArray)
                        ->with('cityIdsArray', $cityIdsArray)
                        ->with('industryIdsArray', $industryIdsArray)
                        ->with('functionalAreaIdsArray', $functionalAreaIdsArray)
                        ->with('careerLevelIdsArray', $careerLevelIdsArray)
                        ->with('genderIdsArray', $genderIdsArray)
                        ->with('jobExperienceIdsArray', $jobExperienceIdsArray)
                        ->with('seo', $seo);
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
