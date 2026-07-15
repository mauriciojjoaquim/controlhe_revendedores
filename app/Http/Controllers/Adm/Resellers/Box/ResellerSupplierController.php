<?php

namespace App\Http\Controllers\Adm\Resellers\Box;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerSupplierController extends Controller
{
    //suppliers Table
    public function tableSupplier(): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $suppliers = Supplier::where('user_id','=', Auth::user()->id)->get();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.box-reseller.reseller-suppliers.table-reseller-suppliers', compact('conf', 'suppliers'));

    }
    
    //suppliers New
    public function addSupplier(): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o suppliers page');
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.box-reseller.reseller-suppliers.add-reseller-suppliers', compact('conf'));
    }
    
    //suppliers Edit
    public function editSupplier($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $supplier = Supplier::where('user_id','=', Auth::user()->id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.box-reseller.reseller-suppliers.edit-reseller-suppliers', compact('conf', 'supplier'));

    }
    
    //suppliers Created
    public function createdSupplier(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');
        
        $request->validate([
            'supplier' => 'required|string|max:40|unique:suppliers',
        ]);

        $supplier = new Supplier();
        $supplier->user_id = Auth::user()->id;
        $supplier->supplier = $request->supplier;
        $supplier->save();

        return redirect()->route('adm.resellers.reseller-suppliers.table-reseller-suppliers')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este fornecedor foi Adicionado com sucesso!',
                                ]);
    }

    //suppliers Updated
    public function updatedSupplier(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');
        
        $request->validate([
            'supplier' => 'required|string|max:150|unique:suppliers,supplier,id',
            'id' => 'required'
        ]);

        
        $id = $request->id;
  
        // create update suppliers
        $supplier = Supplier::findOrFail($id);
        $supplier->user_id = Auth::user()->id;
        $supplier->supplier = $request->supplier;
        $supplier->save();

        return redirect()->route('adm.resellers.reseller-suppliers.table-reseller-suppliers')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este fornecedor foi atualizado com sucesso!',
                                ]);

    }
    
    //suppliers Show
    public function showSupplier($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');
        
        $supplier = Supplier::where('user_id','=', Auth::user()->id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.box-reseller.reseller-suppliers.show-reseller-suppliers', compact('conf', 'supplier'));
                        
    }
    
    //suppliers Confirm delete
    public function confDeleteSupplier($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $supplier = Supplier::where('user_id','=', Auth::user()->id)->findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.box-reseller.reseller-suppliers.confirm-delete-reseller-suppliers',compact('conf', 'supplier'));
    }

    //suppliers Delete
    public function deletedSupplier(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $supplier = Supplier::where('user_id','=', Auth::user()->id)->findOrFail($id);
        $supplier->delete();
        

        return redirect()->route('adm.resellers.reseller-suppliers.table-reseller-suppliers')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este fornecedor foi excluido com sucesso!',
                                ]);
    }
}