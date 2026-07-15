<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DepartmentController extends Controller
{
    // table
    public function table()
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $departments = Department::all();
 

        return view('department.departments', compact('departments', 'conf'));
    }

    // add
    public function add(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
       
 

        return view('department.add-department', compact('conf'));

    }

    // edit
    public function edit($id = null) : View
    {
        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }
        $department = Department::findOrFail($id);
 
        
        return view('department.edit-department', compact('department', 'conf'));
    }

    // show
    public function confDelete($id = null)
    {
        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $users = User::with('department')->where('department_id', $id);
        if($users->count() != 0) {
            return redirect()->route('departments')->with('error', 'This department could not be deleted because it is in use.');
        }

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }
        
        $department = Department::findOrFail($id);
 
       
        return view('department.delete-department', compact('department', 'conf'));
    }

    // is blocked
    private function isDepartmentBlocked($id = null)
    {
        return in_array(intval($id), [1,2]);
    }
    
    // Created
    public function createDepartment(Request $request) : RedirectResponse
    {
        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'name' => 'required|string|max:50|unique:departments',
        ]);

        Department::create([
            'name' => $request->name,
        ]);

        return redirect()->route('departments');
    }
    // Updated
    public function updated(Request $request) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $id = $request->id;

        

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }

        $request->validate([
            'id' => 'required',
            'name' => 'required|string|max:50|unique:departments,name,'.$id
        ]);
        
        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
        ]); 
        return redirect()->route('departments');
    }

    // deleted
    public function deleted(Request $request) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $id = $request->id;

        

        if($this->isDepartmentBlocked($id)){
            return redirect()->route('departments');
        }

        $request->validate([
            'id' => 'required',
        ]);

        $department = Department::findOrFail($id);
        $department->delete([
            'id' => $request->id,
        ]);

        return redirect()->route('departments');
    }

     // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    //Gate
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to page');
    }
}