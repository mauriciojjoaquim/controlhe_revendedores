<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\Access;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\SettingsDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    //Access Table
    public function table(): View 
    {

        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $access = Access::all();
         

        return view('settings.access.table-access', compact('access', 'conf'));

    }
    
    //Access New
    public function add(): View 
    {

        //gate
         // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

         
        
        return view('settings.access.add-access', compact('conf'));
    }
    
    //Access Edit
    public function edit($id = null): View 
    {

         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $aces = Access::findOrFail($id);
         


        return view('settings.access.edit-access', compact('aces', 'conf'));

    }

    // Show
    public function show($id = null): View 
    {

        //gate
         // Gate admin
       $this->canGate('admin');
        
        
        $aces = Access::findOrFail($id);
         

        return view('settings.access.show-access', compact('aces', 'conf'));
    }
    
    // Confirm delete
    public function confDelete($id = null): View 
    {

        //gate
         // Gate admin
       $this->canGate('admin');
        

        $aces = Access::findOrFail($id);
         

        return view('settings.access.confirm-delete-access',compact('aces', 'conf'));
    }
    
    //Access Created
    public function created(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'name' => 'required|string|max:40|unique:accesses',
            'short_name' => 'required|string|max:40|unique:accesses',
        ]);

        Access::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
        ]);

        return redirect()->route('admin.settings.access.table-access');
    }

    // Updated
    public function updated(Request $request) : RedirectResponse
    {
        //gate
         // Gate admin
       $this->canGate('admin');
        
        
        $request->validate([
            'name' => 'required|string|max:40|unique:accesses,id',
            'short_name' => 'required|string|max:40|unique:accesses,id',
            'id' => 'required'
        ]);

        
        $id = $request->id;
  
        // create update access
        $aces = Access::findOrFail($id);
        $aces->name = $request->name;
        $aces->short_name = $request->short_name;
        $aces->save();

        return redirect()->route('admin.settings.access.table-access');

    }
    

    // Delete
    public function deletedAccess(Request $request) : RedirectResponse
    {

        //gate
         // Gate admin
       $this->canGate('admin');
        
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $aces = Access::findOrFail($id);
        $aces->delete();
        

        return redirect()->route('admin.settings.access.table-access');
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
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to customerstockdetail page');
    }
}