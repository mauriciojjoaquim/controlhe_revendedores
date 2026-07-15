<?php

namespace App\Http\Controllers\Adm\Admin\Resellers\ResellerStockDetail;

use App\Http\Controllers\Controller;
use App\Models\CustomerStockDetail;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdmResellerStockDetailController extends Controller
{
    // Table
    public function table(): View
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $customerstockdetails = CustomerStockDetail::with('product','user')->get();
        $products = Product::all();


        return view('adm.admin.resellers.reseller-stock-detail.table-reseller-stock-details', compact('customerstockdetails', 'conf', 'products'));

    }

    // Add
    public function add(): View
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o customerstockdetail page');


        $users = User::where('department_id', '=', 3, 'and')->get();
        $products = Product::all();


        return view('adm.admin.resellers.reseller-stock-detail.add-reseller-stock-details', compact('users', 'products', 'conf'));
    }

    // Edit
    public function edit($id = null): View
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $customerstockdetail = CustomerStockDetail::with('product', 'user')->findOrFail($id);
        $product = Product::with('supplier', 'category')->findOrFail($customerstockdetail->product_id);
        $products = Product::all();

        $users = User::where('department_id', '=', 3, 'and')->get();


        return view('adm.admin.resellers.reseller-stock-detail.edit-reseller-stock-details', compact('products', 'customerstockdetail', 'users', 'product', 'conf'));
    }

    // Show
    public function show($id = null): View
    {

         // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


         $customerstockdetail = CustomerStockDetail::with('product', 'user')->findOrFail($id);
         $products = Product::with('supplier', 'category')->where('non_production', '=', 1)->get();


         return view('adm.admin.resellers.reseller-stock-detail.show-reseller-stock-details', compact('customerstockdetail', 'products', 'conf'));
    }

    // Confirm delete
    public function confDelete($id = null ): View
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $customerstockdetail = CustomerStockDetail::findOrFail($id);


        return view('adm.admin.resellers.reseller-stock-detail.confirm-delete-reseller-stock-details',compact('customerstockdetail', 'conf'));
    }

    // Created
    public function created(Request $request)
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $request->validate([
            'code' => 'required|',
            'user_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);



        $codes = Product::where('code', '=', $request->code)->get();



        $product_id = $codes[0]['id'];
        $user_id = $request->user_id;

        $customerstockdetails = [];

        $customerstockdetails['data'] = CustomerStockDetail::where('product_id', '=', $product_id)
                                                    ->Where('user_id', '=', $user_id)
                                                    ->get();




        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);


        if($codes->count() == 0) {
            return redirect()->back();
        }

        if(!$customerstockdetails['data']) {

            $csd_id = $customerstockdetails['data'][0]['id'];
            $product_csd_id = $customerstockdetails['data'][0]['product_id'];

            $user_csd_id = $customerstockdetails['data'][0]['user_id'];
            $amount_csd = $customerstockdetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $user_id == $user_csd_id) {

                $customerstockdetail = CustomerStockDetail::findOrFail($csd_id);


                $amontn = $amount_csd + $request->amount;


                $customerstockdetail->product_id = $product_id;
                $customerstockdetail->user_id = $user_id;
                $customerstockdetail->percentage = $request->percentage;
                $customerstockdetail->amount = $amontn;
                $customerstockdetail->purchase_price = $valor;
                $customerstockdetail->resale_price = $request->resale_price;
                $customerstockdetail->save();

                return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-detail');

            }
        }else {

            $customerstockdetail = new CustomerStockDetail();

            $amontn = $request->amount;

            $customerstockdetail->product_id = $codes[0]['id'];
            $customerstockdetail->user_id = $request->user_id;
            $customerstockdetail->percentage = $request->percentage;
            $customerstockdetail->amount = $amontn;
            $customerstockdetail->purchase_price = $valor;
            $customerstockdetail->resale_price = $request->resale_price;
            $customerstockdetail->save();

            return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-detail');
        }



    }

    // Created
    public function createdTable(Request $request)
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $request->validate([
            'code' => 'required|',
            'user_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);



        $codes = Product::where('code', '=', $request->code)->get();



        $product_id = $codes[0]['id'];
        $user_id = $request->user_id;

        $customerstockdetails = [];

        $customerstockdetails['data'] = CustomerStockDetail::where('product_id', '=', $product_id)
                                                    ->Where('user_id', '=', $user_id)
                                                    ->get();




        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);


        if($codes->count() == 0) {
            return redirect()->back();
        }

        if(!$customerstockdetails['data']) {

            $csd_id = $customerstockdetails['data'][0]['id'];
            $product_csd_id = $customerstockdetails['data'][0]['product_id'];

            $user_csd_id = $customerstockdetails['data'][0]['user_id'];
            $amount_csd = $customerstockdetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $user_id == $user_csd_id) {

                $customerstockdetail = CustomerStockDetail::findOrFail($csd_id);

                $amontn = $amount_csd + $request->amount;

                $customerstockdetail->product_id = $product_id;
                $customerstockdetail->user_id = $user_id;
                $customerstockdetail->percentage = $request->percentage;
                $customerstockdetail->amount = $amontn;
                $customerstockdetail->purchase_price = $valor;
                $customerstockdetail->resale_price = $request->resale_price;
                $customerstockdetail->save();

                return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-detail');

            }
        } else {

            $customerstockdetail = new CustomerStockDetail();

            $amontn = $request->amount;

            $customerstockdetail->product_id = $codes[0]['id'];
            $customerstockdetail->user_id = $request->user_id;
            $customerstockdetail->percentage = $request->percentage;
            $customerstockdetail->amount = $amontn;
            $customerstockdetail->purchase_price = $valor;
            $customerstockdetail->resale_price = $request->resale_price;
            $customerstockdetail->save();


            

        }

        
        return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-detail');

    }

    // Updated
    public function updated(Request $request) : RedirectResponse
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $request->validate([
            'id' => 'required|',
            'user_id' => 'required|',
            'product_id' => 'required|',
            'code' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);


        $codes = Product::where('code', '=', $request->code)->get();



        $product_id = $codes[0]['id'];
        $user_id = $request->user_id;

        $customerstockdetails = [];

        $customerstockdetails['data'] = CustomerStockDetail::where('product_id', '=', $product_id)
                                                    ->Where('user_id', '=', $user_id)
                                                    ->get();




        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);


        if($codes->count() == 0) {
            return redirect()->back();
        }



            $csd_id = $customerstockdetails['data'][0]['id'];
            $product_csd_id = $customerstockdetails['data'][0]['product_id'];

            $user_csd_id = $customerstockdetails['data'][0]['user_id'];
            $amount_csd = $customerstockdetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $user_id == $user_csd_id) {

                $customerstockdetail = CustomerStockDetail::findOrFail($csd_id);


                $amontn = $amount_csd + $request->amount;


                $customerstockdetail->product_id = $product_id;
                $customerstockdetail->user_id = $user_id;
                $customerstockdetail->percentage = $request->percentage;
                $customerstockdetail->amount = $amontn;
                $customerstockdetail->purchase_price = $valor;
                $customerstockdetail->resale_price = $request->resale_price;
                $customerstockdetail->save();

            }

            return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-detail');

    }

    // Delete
    public function deleted(Request $request) : RedirectResponse
    {

        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $aces = CustomerStockDetail::findOrFail($id);
        $aces->delete();


        return redirect()->route('adm.resellers.reseller-stock-detail.table-reseller-stock-detail');
    }

     // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    // Gate
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }


}