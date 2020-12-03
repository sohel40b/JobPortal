<?php

namespace App\Traits;

use Auth;
use DB;
use Redirect;
use Carbon\Carbon;
use App\Training;
use App\ResourcePerson;
use Illuminate\Support\Facades\Input;
use App\Helpers\MiscHelper;
use App\Helpers\DataArrayHelper;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;

trait ResourcePersonTrait
{

    public function deleteResourcePerson(Request $request)
    {
        $id = $request->input('id');
        try {
            $resourcePerson = ResourcePerson::findOrFail($id);
            $resourcePerson->delete();
            return 'ok';
        } catch (ModelNotFoundException $e) {
            return 'notok';
        }
    }

    private function assignResourcePersonValues($resourcePerson, $request)
    {
        $resourcePerson->name = $request->input('name');
        $resourcePerson->degree = $request->input('degree');
        $resourcePerson->academic_qualification = $request->input('academic_qualification');
        $resourcePerson->training_experience = $request->input('training_experience');
        $resourcePerson->job_experience = $request->input('job_experience');
        $resourcePerson->description = $request->input('description');
        return $resourcePerson;
    }

    public function createResourcePerson()
    {
        return view('admin.resource_person.add');
    }

    public function storeResourcePerson(Request $request)
    {
        $resourcePerson = new ResourcePerson();
        $resourcePerson = $this->assignResourcePersonValues($resourcePerson, $request);
        $resourcePerson->save();
        /*         * ******************************* */
      
        flash('Resource Person has been added!')->success();
        return \Redirect::route('edit.resource.person', array($resourcePerson->id));
    }

    public function editResourcePerson($id)
    {
        $resourcePerson = ResourcePerson::findOrFail($id);
        return view('admin.resource_person.edit')
                        ->with('resourcePerson', $resourcePerson);
    }

    public function updateResourcePerson($id, Request $request)
    {
        $resourcePerson = ResourcePerson::findOrFail($id);
        $resourcePerson = $this->assignResourcePersonValues($resourcePerson, $request);
        $resourcePerson->update();

        flash('Resource Person has been updated!')->success();
        return \Redirect::route('edit.resource.person', array($resourcePerson->id));
    }

}
