<?php

namespace App;

use DB;
use App;
use App\Traits\ResourcePersonTrait;
use Illuminate\Database\Eloquent\Model;

class ResourcePerson extends Model
{

    use ResourcePersonTrait;

    protected $table = 'resource_person';
    public $timestamps = true;
    protected $guarded = ['id'];
    //protected $dateFormat = 'U';
    protected $dates = ['created_at', 'updated_at'];

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
