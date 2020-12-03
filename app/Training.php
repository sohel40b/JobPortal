<?php

namespace App;

use DB;
use App;
use App\Traits\TrainingTrait;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{

    use TrainingTrait;

    protected $table = 'training';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at', 'expiry_date', 'start_date'];

    /*public function company()
    {
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    public function getCompany($field = '')
    {
        if (null !== $company = $this->company()->first()) {
            if (!empty($field)) {
                return $company->$field;
            } else {
                return $company;
            }
        }
    }*/

}
