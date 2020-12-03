<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use DataTables;
use App\ResourcePerson;
use App\Training;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\ResourcePersonTrait;

class ResourcePersonController extends Controller
{

    use ResourcePersonTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function indexResourcePerson()
    {
        return view('admin.resource_person.index');

    }

    public function fetchResourcePersonData(Request $request)
    {
        $resourcePerson = ResourcePerson::select([
                    'resource_person.id', 'resource_person.profile_picture', 'resource_person.name', 'resource_person.degree', 'resource_person.academic_qualification', 'resource_person.training_experience', 'resource_person.job_experience', 'resource_person.description', 
        ]);
        return Datatables::of($resourcePerson)
                        ->filter(function ($query) use ($request) {

                            if ($request->has('name') && !empty($request->title)) {
                                $query->where('resource_person.name', 'like', "%{$request->get('name')}%");
                            }
                            if ($request->has('description') && !empty($request->description)) {
                                $query->where('resource_person.description', 'like', "%{$request->get('description')}%");
                            }
                        })
                        ->addColumn('description', function ($resourcePerson) {
                            return strip_tags(str_limit($resourcePerson->description, 50, '...'));
                        })
                        ->addColumn('action', function ($resourcePerson) {
                            
                            return '
                            <div class="btn-group">
                                <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="' . route('edit.resource.person', ['id' => $resourcePerson->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                    </li>						
                                    <li>
                                        <a href="javascript:void(0);" onclick="deleteResourcePerson(' . $resourcePerson->id . ', ' . $resourcePerson->is_default . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                    </li>																																		
                                </ul>
                            </div>';
                        })
                        ->rawColumns(['action', 'description'])
                        ->setRowId(function($resourcePerson) {
                            return 'resourcePersonDtRow' . $resourcePerson->id;
                        })
                        ->make(true);
        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    
}
