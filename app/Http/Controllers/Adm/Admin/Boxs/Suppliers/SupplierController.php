<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\Suppliers;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SupplierController extends Controller
{
    // suppliers Table
    public function table(): View
    {

        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $suppliers = Supplier::all();
         

        return view('adm.admin.box.suppliers.table-suppliers', compact('suppliers', 'conf'));

    }
    
     //  Add
    public function add(): View 
    {

        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        return view('adm.admin.box.suppliers.add-suppliers', compact('conf'));
    }
    
     //  Edit
    public function edit($id = null): View 
    {

        //gate
        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $supplier = Supplier::findOrFail($id);
         


        return view('adm.admin.box.suppliers.edit-suppliers', compact('supplier', 'conf'));

    }
    
     
    
     //  Show
    public function show($id = null): View 
    {

        //gate
        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $supplier = Supplier::findOrFail($id);
         

        return view('adm.admin.box.suppliers.show-suppliers', compact('supplier', 'conf'));
    }
    
     //  Confirm delete
    public function confDelete($id = null): View 
    {

        //gate
        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $supplier = Supplier::findOrFail($id);
         

        return view('adm.admin.box.suppliers.confirm-delete-suppliers',compact('supplier', 'conf'));
    }

    //  Created
    public function created(Request $request) : RedirectResponse
    {

        //gate
        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'supplier' => 'required|string|max:40|unique:suppliers',
        ]);

        $supplier = new Supplier();
        $supplier->supplier = $request->supplier;
        $supplier->save();

        return redirect()->route('adm.suppliers.table-suppliers');
    }

     // Updated
    public function updated(Request $request) : RedirectResponse
    {

        //gate
        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'supplier' => 'required|string|max:150|unique:suppliers,supplier,id',
            'id' => 'required'
        ]);

        
        $id = $request->id;
  
        // create update suppliers
        $supplier = Supplier::findOrFail($id);
        $supplier->supplier = $request->supplier;
        $supplier->save();

        return redirect()->route('adm.suppliers.table-suppliers');

    }

     //  Delete
    public function deleted(Request $request) : RedirectResponse 
    {

        //gate
        // Gate  admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        

        return redirect()->route('adm.suppliers.table-suppliers');
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