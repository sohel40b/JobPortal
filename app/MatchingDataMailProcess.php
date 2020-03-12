<?php

namespace App;

use DB;
use App;
use Illuminate\Database\Eloquent\Model;

class MatchingDataMailProcess extends Model
{
    protected $table = 'matching_data_mail_process';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'user_id', 'job_id', 'user_email', 'user_functional_area_id', 'job_functional_area_id', 'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getUser($field = '')
    {
        if (null !== $user = $this->user()->first()) {
            if (!empty($field)) {
                return $user->$field;
            } else {
                return $user;
            }
        }
    }

    public function job()
    {
        return $this->belongsTo('App\Job', 'job_id', 'id');
    }

    public function getJob($field = '')
    {
        if (null !== $job = $this->job()->first()) {
            if (!empty($field)) {
                return $job->$field;
            } else {
                return $job;
            }
        }
    }

    public function functionalArea()
    {
        return $this->belongsTo('App\FunctionalArea', 'functional_area_id', 'functional_area_id');
    }

    public function getFunctionalArea($field = '')
    {
        if (null !== $functionalArea = $this->functionalArea()->first()) {
            if (!empty($field)) {
                return $functionalArea->$field;
            } else {
                return $functionalArea;
            }
        }
    }

    public function careerLevel()
    {
        return $this->belongsTo('App\CareerLevel', 'career_level_id', 'career_level_id');
    }

    public function getCareerLevel($field = '')
    {
        if (null !== $careerLevel = $this->careerLevel()->first()) {
            if (!empty($field)) {
                return $careerLevel->$field;
            } else {
                return $careerLevel;
            }
        }
    }

    public function degreeLevel()
    {
        return $this->belongsTo('App\DegreeLevel', 'degree_level_id', 'degree_level_id');
    }

    public function getDegreeLevel($field = '')
    {
        if (null !== $degreeLevel = $this->degreeLevel()->first()) {
            if (!empty($field)) {
                return $degreeLevel->$field;
            } else {
                return $degreeLevel;
            }
        }
    }

    public function jobExperience()
    {
        return $this->belongsTo('App\JobExperience', 'job_experience_id', 'job_experience_id');
    }

    public function getJobExperience($field = '')
    {
        if (null !== $jobExperience = $this->jobExperience()->first()) {
            if (!empty($field)) {
                return $jobExperience->$field;
            } else {
                return $jobExperience;
            }
        }
    }
}
