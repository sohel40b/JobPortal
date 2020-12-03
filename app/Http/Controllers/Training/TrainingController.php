<?php

namespace App\Http\Controllers\Training;

use App\Training;
use App\Student;
use Validator,Redirect,Response;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TrainingController extends Controller
{

    

    public function index()
    {
        $trainings = Training::limit(12)->get();
        return view('training_home')
                    ->with('trainings', $trainings);
    }

    public function trainingDetail(Request $request)
    {

        $training = Training::firstOrFail();

        return view('training.detail')
                        ->with('training', $training);
    }
   
    
}
