<?php

namespace App\Http\Controllers\Adm\Resellers\ResellerStockDetail;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\CustomerStockDetail;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResellerStockDetailController extends Controller
{
    //customer stock detail Table
    public function tableResellerStockDetail(): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');

        $resellerstockdetails = CustomerStockDetail::with('product', 'user')
                                    ->where('user_id', '=', Auth::user()->id)->get();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-stock-detail.table-reseller-stock-details', compact('resellerstockdetails', 'conf'));

    }
  
    
    //customer stock detail New
    public function addResellerStockDetail(): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o customerstockdetail page');

        
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        $users = User::all();
        $clients = Client::all();
        $products = Product::all();


        return view('adm.resellers.reseller-stock-detail.add-reseller-stock-details', compact('clients', 'users', 'products', 'conf'));
    }
    
    //customer stock detail Edit
    public function editResellerStockDetail($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');

        $resellerstockdetail = CustomerStockDetail::with('product', 'user')->findOrFail($id);
        $product = Product::with('supplier', 'category')->findOrFail($resellerstockdetail->product_id);
        $products = Product::all();
        $clients = Client::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.reseller-stock-detail.edit-reseller-stock-details', compact('products', 'resellerstockdetail', 'clients', 'product', 'conf'));

    }

    //customer stock detail Created
    public function createdResellerStockDetail(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');
        
      
        
        $request->validate([
            'code' => 'required|',
            'user_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);


        
        $code = Product::where('code', '=', $request->code)->first();
        
        dd($code);

        $product_id = $code[0]['id'];
        $user_id = $request->user_id;

        $resellerstockdetails = [];

        $resellerstockdetails['data'] = CustomerStockDetail::where('product_id', '=', $product_id)
                                                    ->Where('user_id', '=', $user_id)
                                                    ->get();



                           
        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);
        

        if($code->count() == 0) {
            return redirect()->back();
        }

        if(!$resellerstockdetails['data']) {
    
            $csd_id = $resellerstockdetails['data'][0]['id'];
            $product_csd_id = $resellerstockdetails['data'][0]['product_id'];

            $client_csd_id = $resellerstockdetails['data'][0]['client_id'];
            $amount_csd = $resellerstockdetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $user_id == $client_csd_id) {

                $resellerstockdetail = CustomerStockDetail::findOrFail($csd_id);
                

                $amontn = $amount_csd + $request->amount;

                
                $resellerstockdetail->product_id = $product_id;
                $resellerstockdetail->user_id = $user_id;
                $resellerstockdetail->percentage = $request->percentage;
                $resellerstockdetail->amount = $amontn;
                $resellerstockdetail->purchase_price = $valor;
                $resellerstockdetail->resale_price = $request->resale_price;
                $resellerstockdetail->save();

                return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-details');
                
            }        
        }else {

            $resellerstockdetail = new CustomerStockDetail();
            
            $amontn = $request->amount;

            $resellerstockdetail->product_id = $codes[0]['id'];
            $resellerstockdetail->user_id = $request->user_id;
            $resellerstockdetail->percentage = $request->percentage;
            $resellerstockdetail->amount = $amontn;
            $resellerstockdetail->purchase_price = $valor;
            $resellerstockdetail->resale_price = $request->resale_price;
            $resellerstockdetail->save();

            return redirect()->route('adm.resellers.reseller-stock-detail.add-reseller-stock-details');
        }
       
 
        
    }

    //customer stock detail Created
    public function createdTableResellerStockDetail(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');
        
      

        $request->validate([
            'code' => 'required|',
            'user_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);


        
        $code = Product::where('code', '=', $request->code)->first();
        
        // dd($code['id']);

        $product_id = $code['id'];
        $user_id = $request->user_id;

        $resellerstockdetails = [];

        $resellerstockdetails['data'] = CustomerStockDetail::where('product_id', '=', $product_id)
                                                    ->Where('user_id', '=', $user_id)
                                                    ->first();



                           
        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);
        

        if($code->count() == 0) {
            return redirect()->back();
        }
       
        if($resellerstockdetails['data'] != null) {
    
            $csd_id = $resellerstockdetails['data']['id'];
            $product_csd_id = $resellerstockdetails['data']['product_id'];

            $user_csd_id = $resellerstockdetails['data']['user_id'];
            $amount_csd = $resellerstockdetails['data']['amount'];

            if($product_id == $product_csd_id && $user_id == $user_csd_id) {

                $resellerstockdetail = CustomerStockDetail::findOrFail($csd_id);
                

                $amontn = $amount_csd + $request->amount;

                
                $resellerstockdetail->product_id = $product_id;
                $resellerstockdetail->user_id = $user_id;
                $resellerstockdetail->percentage = $request->percentage;
                $resellerstockdetail->amount = $amontn;
                $resellerstockdetail->purchase_price = $valor;
                $resellerstockdetail->resale_price = $request->resale_price;
                $resellerstockdetail->save();

                return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-details');
                
            }        
        }else {

            $resellerstockdetail = new CustomerStockDetail();
            
            $amontn = $request->amount;

            $resellerstockdetail->product_id = $code['id'];
            $resellerstockdetail->user_id = $request->user_id;
            $resellerstockdetail->percentage = $request->percentage;
            $resellerstockdetail->amount = $amontn;
            $resellerstockdetail->purchase_price = $valor;
            $resellerstockdetail->resale_price = $request->resale_price;
            $resellerstockdetail->save();

            return redirect()->route('adm.resellers.reseller-stock-detail.add-reseller-stock-details');
        }
       
 
        
    }

    //customer stock detail Updated
    public function updatedResellerStockDetail(Request $request) 
    {

        

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');
        
        $request->validate([
            'id' => 'required|',
            'client_id' => 'required|',
            'product_id' => 'required|',
            'code' => 'required|',
            'user_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);

        
        $codes = Product::where('code', '=', $request->code)->get();
        


        $product_id = $codes[0]['id'];
        $user_id = $request->user_id;

        $resellerstockdetails = [];

        $resellerstockdetails['data'] = CustomerStockDetail::where('product_id', '=', $product_id)
                                                    ->Where('user_id', '=', $user_id)
                                                    ->get();



                           
        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);
        

        if($codes->count() == 0) {
            return redirect()->back();
        }


    
            $csd_id = $resellerstockdetails['data'][0]['id'];
            $product_csd_id = $resellerstockdetails['data'][0]['product_id'];

            $user_csd_id = $resellerstockdetails['data'][0]['user_id'];
            $amount_csd = $resellerstockdetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $user_id == $user_csd_id) {

                $resellerstockdetail = CustomerStockDetail::findOrFail($csd_id);
                

                $amontn = $amount_csd + $request->amount;

                
                $resellerstockdetail->product_id = $product_id;
                $resellerstockdetail->user_id = $user_id;
                $resellerstockdetail->percentage = $request->percentage;
                $resellerstockdetail->amount = $amontn;
                $resellerstockdetail->purchase_price = $valor;
                $resellerstockdetail->resale_price = $request->resale_price;
                $resellerstockdetail->save(); 
                
            }   
            return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-details');     
        
    }
    
    //customer stock detail Show
    public function showResellerStockDetail($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');
        
        $resellerstockdetail = CustomerStockDetail::with('product', 'client')->findOrFail($id);
        $product = Product::with('supplier', 'category')->findOrFail($resellerstockdetail->product_id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-stock-detail.show-reseller-stock-details', compact('customerstockdetail', 'product', 'conf'));
    }

    //customer stock detail Confirm delete
    public function confDeleteResellerStockDetail($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');

        $resellerstockdetail = CustomerStockDetail::findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-stock-detail.confirm-delete-reseller-stock-details',compact('resellerstockdetail', 'conf'));
    }

    //customer stock detail Delete
    public function deletedResellerStockDetail(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $aces = CustomerStockDetail::findOrFail($id);
        $aces->delete();
        

        return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-details');
    }
    

}