<?php

namespace App\Http\Controllers\Adm\Leaders\LeaderSellerSuppliers;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderSellerSuppliersController extends Controller
{
    // suppliers Table
    public function tableLeaderSupplier(): View 
    {

        // gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');

        $suppliers = Supplier::all();
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.leaders.box-leader-seller.leader-seller-supplier.table-leader-seller-suppliers', compact('suppliers', 'conf'));

    }
    
    //suppliers New
    public function addLeaderSupplier(): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized o suppliers page');
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.leaders.box-leader-seller.leader-seller-supplier.add-leader-seller-suppliers', compact('conf'));
    }
    
    //suppliers Edit
    public function editLeaderSupplier($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');

        $supplier = Supplier::findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);


        return view('adm.leaders.box-leader-seller.leader-seller-supplier.edit-leader-seller-suppliers', compact('supplier', 'conf'));

    }

    //suppliers Show
    public function showLeaderSupplier($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');
        
        $supplier = Supplier::findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.leaders.box-leader-seller.leader-seller-supplier.show-leader-seller-suppliers', compact('supplier', 'conf'));
    }
    
    //suppliers Confirm delete
    public function confDeleteLeaderSupplier($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');

        $supplier = Supplier::findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.leaders.box-leader-seller.leader-seller-supplier.confirm-delete-leader-seller-suppliers',compact('supplier', 'conf'));
    }
    
    //suppliers Created
    public function createdLeaderSupplier(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');
        
        $request->validate([
            'supplier' => 'required|string|max:40|unique:suppliers',
        ]);

        $supplier = new Supplier();
        $supplier->supplier = $request->supplier;
        $supplier->save();

        return redirect()->route('adm.suppliers.table-suppliers');
    }

    //suppliers Updated
    public function updatedLeaderSupplier(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');
        
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
    
    //suppliers Delete
    public function deletedLeaderSupplier(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to suppliers page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        

        return redirect()->route('adm.suppliers.table-suppliers');
    }
}