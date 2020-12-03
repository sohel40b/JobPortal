<?php

namespace App\Traits;

use Auth;
use DB;
use Redirect;
use Carbon\Carbon;
use App\Training;
use App\Student;
use Illuminate\Support\Facades\Input;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

trait TrainingTrait
{

    public function deleteTraining(Request $request)
    {
        $id = $request->input('id');
        try {
            $training = Training::findOrFail($id);
            $training->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    private function assignTrainingValues($training, $request)
    {
        $training->title = $request->input('title');
        $training->course_time = $request->input('course_time');
        $training->description = $request->input('description');
        $training->duration = $request->input('duration');
        $training->venue = $request->input('venue');
        $training->no_of_class = $request->input('no_of_class');
        $training->class_schedule = $request->input('class_schedule');
        $training->start_date = $request->input('start_date');
        $training->expiry_date = $request->input('expiry_date');
        return $training;
    }

    public function createTraining()
    {
        return view('admin.training.add');
    }

    public function storeTraining(Request $request)
    {
        $training = new Training();
        $training = $this->assignTrainingValues($training, $request);
        $training->save();
        /*         * ******************************* */
      
        flash('Training has been added!')->success();
        return \Redirect::route('edit.training', array($training->id));
    }

    public function editTraining($id)
    {
        $training = Training::findOrFail($id);
        return view('admin.training.edit')
                        ->with('training', $training);
    }

    public function updateTraining($id, Request $request)
    {
        $training = Training::findOrFail($id);
        $training = $this->assignTrainingValues($training, $request);
        $training->update();

        flash('Training has been updated!')->success();
        return \Redirect::route('edit.training', array($training->id));
    }

}
