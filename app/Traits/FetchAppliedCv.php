<?php

namespace App\Traits;

use DB;
use App\User;
use App\CareerLevel;
use App\FunctionalArea;
use App\JobExperience;

trait FetchAppliedCv
{

    private $fields = array(
        'users.id',
        'users.first_name',
        'users.middle_name',
        'users.last_name',
        'users.name',
        'users.email',
        'users.father_name',
        'users.date_of_birth',
        'users.gender_id',
        'users.marital_status_id',
        'users.nationality_id',
        'users.national_id_card_number',
        'users.country_id',
        'users.state_id',
        'users.city_id',
        'users.phone',
        'users.mobile_num',
        'users.job_experience_id',
        'users.career_level_id',
        'users.industry_id',
        'users.functional_area_id',
        'users.current_salary',
        'users.expected_salary',
        'users.salary_currency',
        'users.street_address',
        'users.is_active',
        'users.verified',
        'users.verification_token',
        'users.provider',
        'users.provider_id',
        'users.password',
        'users.remember_token',
        'users.image',
        'users.lang',
        'users.created_at',
        'users.updated_at',
        'users.is_immediate_available',
        'users.num_profile_views',
        'users.package_id',
        'users.package_start_date',
        'users.package_end_date',
        'users.jobs_quota',
        'users.availed_jobs_quota',
        'users.search'
    );

    public function fetchAppliedCv($search = '', $functional_area_ids = array(), $career_level_ids = array(), $job_experience_ids = array(), $order_by = 'id', $limit = 10)
    {
        $asc_desc = 'DESC';
        $query = User::select($this->fields);
        $query = $this->createQuery($query, $search, $functional_area_ids, $career_level_ids, $job_experience_ids);

        $query->orderBy('users.id', 'DESC');
        //echo $query->toSql();exit;
        return $query->paginate($limit);
    }

    public function fetchIdsArray($search = '', $functional_area_ids = array(), $career_level_ids = array(), $job_experience_ids = array(), $field = 'users.id')
    {
        $query = User::select($field);
        $query = $this->createQuery($query, $search, $functional_area_ids, $career_level_ids, $job_experience_ids);

        $array = $query->pluck($field)->toArray();
        return array_unique($array);
    }

    public function createQuery($query, $search = '', $functional_area_ids = array(),  $career_level_ids = array(), $job_experience_ids = array())
    {
        $query->where('users.is_active', 1);
        if ($search != '') {
            $query = $query->whereRaw("MATCH (`search`) AGAINST ('$search*' IN BOOLEAN MODE)");
        }
        if (isset($functional_area_ids[0])) {
            $query->whereIn('users.functional_area_id', $functional_area_ids);
        }
        if (isset($career_level_ids[0])) {
            $query->whereIn('users.career_level_id', $career_level_ids);
        }
        if (isset($job_experience_ids[0])) {
            $query->whereIn('users.job_experience_id', $job_experience_ids);
        }
        return $query;
    }


}
