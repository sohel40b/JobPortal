<?php

namespace App\Traits;

use DB;
use App\User;
use App\JobApply;
use App\CareerLevel;
use App\FunctionalArea;
use App\JobExperience;
use App\Http\Requests;
use Illuminate\Http\Request;

trait FetchAppliedCv
{

    private $fields = array(
        'job_apply.id',
        'job_apply.user_id',
        'job_apply.job_id',
        'job_apply.current_salary',
        'job_apply.expected_salary',
        'job_apply.salary_currency',
        'job_apply.created_at',
        'job_apply.updated_at'
        
    );

    public function fetchAppliedCv($search = '', $users_ids = array(), $functional_area_ids = array(), $career_level_ids = array(), $job_experience_ids = array(), $order_by = 'id', $limit = 15)
    {
        $asc_desc = 'DESC';
        $query = JobApply::select($this->fields);
        $query = $this->createQuery($query, $search, $users_ids, $functional_area_ids, $career_level_ids, $job_experience_ids);

        $query->orderBy('job_apply.id', 'DESC');
        //echo $query->toSql();exit;
        return $query->paginate($limit);
    }

    public function createQuery($query, $search = '', $users_ids = array(), $functional_area_ids = array(),  $career_level_ids = array(), $job_experience_ids = array())
    {
        $user_functional_area_ids=array();
        if (isset($functional_area_ids[0])) {
            $user_functional_area_ids = User::whereIn('functional_area_id', $functional_area_ids)->pluck('id')->toArray();
            if (isset($users_ids[0]) && isset($user_functional_area_ids[0])) {
                $users_ids = array_intersect($user_functional_area_ids, $users_ids);
            }
        }
        $users_ids = $user_functional_area_ids;

        /*$user_career_level_ids=array();
        if (isset($career_level_ids[0])) {
            $user_career_level_ids = User::whereIn('career_level_id', $career_level_ids)->pluck('id')->toArray();
            if (isset($users_ids[0]) && isset($user_career_level_ids[0])) {
                $users_ids = array_intersect($user_career_level_ids, $users_ids);
            }
        }
        $users_career_ids = $user_career_level_ids;

        /*****************************************************
        $user_job_experience_ids=array();
        if (isset($job_experience_ids[0])) {
            $user_job_experience_ids = User::whereIn('job_experience_id', $job_experience_ids)->pluck('id')->toArray();
            if (isset($users_ids[0]) && isset($user_job_experience_ids[0])) {
                $users_ids = array_intersect($user_job_experience_ids, $users_ids);
            }
        }
        $users_ids = $user_job_experience_ids;
        ***************************************************** */
        $term = JobApply::get(['job_id']);
        
        $a = JobApply::where('job_id', '=', $term)->get();

        if ($search != '') {
            $query->whereRaw("MATCH (`search`) AGAINST ('$search*' IN BOOLEAN MODE)");
        }
        if (isset($users_ids[0])) {
            $query->whereIn('job_apply.user_id', $users_ids);
        }
        return $query;
    }

}
