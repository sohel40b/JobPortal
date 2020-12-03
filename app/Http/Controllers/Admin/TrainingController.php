<?php

namespace App\Http\Controllers\Admin;

use DB;
use Input;
use DataTables;
use App\Student;
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
use App\Traits\TrainingTrait;

class TrainingController extends Controller
{

    use TrainingTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function indexTraining()
    {
        return view('admin.training.index');

    }

    public function fetchTrainingData(Request $request)
    {
        $training = Training::select([
                    'training.id', 'training.resource_person_id', 'training.title', 'training.course_time', 'training.description', 'training.duration', 'training.venue', 'training.no_of_class', 'training.class_schedule', 'training.start_date', 'training.expiry_date',
        ]);
        return Datatables::of($training)
                        ->filter(function ($query) use ($request) {

                            if ($request->has('title') && !empty($request->title)) {
                                $query->where('training.title', 'like', "%{$request->get('title')}%");
                            }
                            if ($request->has('description') && !empty($request->description)) {
                                $query->where('traiing.description', 'like', "%{$request->get('description')}%");
                            }
                        })
                        ->addColumn('description', function ($training) {
                            return strip_tags(str_limit($training->description, 50, '...'));
                        })
                        ->addColumn('action', function ($training) {
                            
                            return '
                            <div class="btn-group">
                                <button class="btn blue dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Action
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="' . route('edit.training', ['id' => $training->id]) . '"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                                    </li>						
                                    <li>
                                        <a href="javascript:void(0);" onclick="deleteTraining(' . $training->id . ', ' . $training->is_default . ');" class=""><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a>
                                    </li>																																		
                                </ul>
                            </div>';
                        })
                        ->rawColumns(['action', 'description'])
                        ->setRowId(function($training) {
                            return 'trainingDtRow' . $training->id;
                        })
                        ->make(true);
        //$query = $dataTable->getQuery()->get();
        //return $query;
    }

    
}
