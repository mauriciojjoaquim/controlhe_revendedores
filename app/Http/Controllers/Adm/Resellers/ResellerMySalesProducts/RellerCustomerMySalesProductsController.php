<?php

namespace App\Http\Controllers\Adm\Resellers\ResellerMySalesProducts;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\AddToCart\MySalesProduct;
use App\Models\Client;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RellerCustomerMySalesProductsController extends Controller
{

     //Reseller my sales Products Table 
     public function tableResellerMySalesProducts(Request $request): View
     {
 
         //gate
         Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');
 
         // dd($request);
 
         $user_id = Auth::user()->id;
         $clients = Client::all();
         $mysalesproducts = MySalesProduct::where('user_id', '=', $user_id)
                 ->where('closed_order', '=', 0)
                 ->when($request->has('year'), function ($whenQuery) use ($request){
                    $whenQuery->where('year', 'like', '%'.$request->year.'%');
                 })
                 ->when($request->filled('month'), function ($whenQuery) use ($request){
                    $whenQuery->where('month', 'like', '%'.$request->month.'%');
                })
                 ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                     $whenQuery->where('order_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                 })
                 ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                     $whenQuery->where('order_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                 })
                 ->orderByDesc('year', 'month')
                 ->paginate(10)
                 ->withQueryString();
                 
        // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();
        $products = Product::all();
        
        return view( 'adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products', [
             'clients' => $clients, 
             'mysalesproducts' => $mysalesproducts, 
             'conf' => $conf,
             'products' => $products,
             'year' => $request->year,
             'month' => $request->month,
             'start_date' => $request->start_date,
             'end_date' => $request->end_date,
         ]);
 
     }

     //Reseller my sales Products Order Completed
     public function orderCompletedResellerMySalesProducts(Request $request): View
     {
 
         //gate
         Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');
 
         // dd($request);
 
         $user_id = Auth::user()->id;
         $clients = Client::all();
         $mysalesproducts = MySalesProduct::where('user_id', '=', $user_id)
                 ->where('closed_order', '=', 1)
                 ->when($request->has('year'), function ($whenQuery) use ($request){
                    $whenQuery->where('year', 'like', '%'.$request->year.'%');
                 })
                 ->when($request->filled('month'), function ($whenQuery) use ($request){
                    $whenQuery->where('month', '=', $request->month);
                })
                 ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                     $whenQuery->where('order_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                 })
                 ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                     $whenQuery->where('order_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                 })
                 ->orderByDesc('year')
                 ->paginate(10)
                 ->withQueryString();
         // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();
         $products = Product::all();
 
 
         return view(  'adm.resellers.reseller-my-sales-products.order-completed-reseller-my-sales-products', [
             'clients' => $clients, 
             'mysalesproducts' => $mysalesproducts, 
             'conf' => $conf,
             'products' => $products,
             'year' => $request->year,
             'month' => $request->month,
             'start_date' => $request->start_date,
             'end_date' => $request->end_date,
         ]);
 
     }
     
    //Reseller my sales New
    public function addResellerMySalesProducts(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o InstallmentClientDetail page');


        // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();
        $clients = Client::all();


        return view('adm.resellers.reseller-my-sales-products.add-reseller-my-sales-products', compact( 'clients', 'conf'));
    }

    //Reseller my sales Edit
    public function editResellerMySalesProducts($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $mysale = MySalesProduct::findOrFail($id);
        $clients = Client::all();
        // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();


        return view('adm.resellers.reseller-my-sales-products.edit-reseller-my-sales-products', compact( 'mysale', 'clients', 'conf'));

    }

    //Reseller my sales Created
    public function createdResellerMySalesProducts(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');



        $request->validate([
            'code' => 'required|',
            // 'client_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);



        $codes = Product::where('code', '=', $request->code)->get();



        $product_id = $codes[0]['id'];
        $client_id = Auth::user()->id;

        $InstallmentClientDetails = [];

        $InstallmentClientDetails['data'] = MySalesProduct::where('product_id', '=', $product_id)
                                                    ->Where('client_id', '=', $client_id)
                                                    ->get();




        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);


        if($codes->count() == 0) {
            return redirect()->back();
        }

        if(!$InstallmentClientDetails['data']) {

            $csd_id = $InstallmentClientDetails['data'][0]['id'];
            $product_csd_id = $InstallmentClientDetails['data'][0]['product_id'];

            $client_csd_id = $InstallmentClientDetails['data'][0]['client_id'];
            $amount_csd = $InstallmentClientDetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $client_id == $client_csd_id) {

                $mysale = MySalesProduct::findOrFail($csd_id);


                $amontn = $amount_csd + $request->amount;


                $mysale->product_id = $product_id;
                $mysale->client_id = $client_id;
                $mysale->percentage = $request->percentage;
                $mysale->amount = $amontn;
                $mysale->purchase_price = $valor;
                $mysale->resale_price = $request->resale_price;
                $mysale->save();

                return redirect()->route('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products');

            }
        }else {

            $mysale = new InstallmentClientDetail();

            $amontn = $request->amount;

            $mysale->product_id = $codes[0]['id'];
            $mysale->client_id = $request->client_id;
            $mysale->percentage = $request->percentage;
            $mysale->amount = $amontn;
            $mysale->purchase_price = $valor;
            $mysale->resale_price = $request->resale_price;
            $mysale->save();

            return redirect()->route('adm.resellers.reseller-stock-detail.add-reseller-stock-detail');
        }



    }

    //Reseller my sales Updated
    public function updatedResellerMySalesProducts(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        // dd($request);

        $request->validate([
            'id' => 'required|',
            'user_id' => 'required|',
            'purchase_price' => 'required|decimal:2',
            'purchase_date' => 'required|',
        ]);

        $user_id = $request->user_id;
        $id = $request->id;
        $purchase_price = $request->purchase_price;
        $purchase_date = $request->purchase_date;


        $mysale = MySalesProduct::where('user_id', '=', $user_id)
                                                ->findOrFail($id);

        $total_purchase = $mysale->quantity * $purchase_price;
          

        $mysale->purchase_price = $purchase_price;
        $mysale->purchase_date = $purchase_date;
        $mysale->total_purchase = $total_purchase;
        $mysale->closed_order = 1;
        $mysale->save();



            return redirect()->route('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products')
                                    ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fa-regular fa-circle-check',
                                    'paricin' => 'text-darck',
                                    'mesagem' => 'Registro foi atualizado com sucesso.',
                                ]);

    }

    //Reseller my sales Show
    public function showResellerMySalesProducts($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;

        $products = Product::all();
        $mysale = MySalesProduct::where('user_id', '=', $user_id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();

        return view('adm.resellers.reseller-my-sales-products.show-reseller-my-sales-products', compact('products', 'mysale', 'conf'));
    }

    //Reseller my sales Confirm delete
    public function confDeleteResellerMySalesProducts($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $mysale = MySalesProduct::findOrFail($id);
        // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();

        return view('adm.resellers.reseller-my-sales-products.confirm-delete-reseller-my-sales-products',compact('mysale', 'conf'));
    }

    //Reseller my sales Delete
    public function deletedResellerMySalesProducts(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $aces = MySalesProduct::findOrFail($id);
        $aces->delete();


        return redirect()->route('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fa-regular fa-circle-check',
                                    'paricin' => 'text-darck',
                                    'mesagem' => 'Registro foi excluido com sucesso.',
                                ]);
    }

    // Reseller My Sales Products Relatorio PDF
    public function reportResellerMySalesProducts(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;
        $products = Product::all();
        
        $mysalesproducts = MySalesProduct::where('user_id', '=', $user_id)
                ->where('closed_order', '=', 0)
                ->when($request->has('year'), function ($whenQuery) use ($request){
                    $whenQuery->where('year', 'like', '%'.$request->year.'%');
                })
                ->when($request->filled('month'), function ($whenQuery) use ($request){
                    $whenQuery->where('month', '=', $request->month);
                })
                ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('order_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                })
                ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('order_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                })
                ->orderByDesc('year')->get();

        $pdfmysales = Pdf::loadView('adm.resellers.reseller-my-sales-products.report-reseller-my-sales-products',
                        ['mysalesproducts' => $mysalesproducts, 'products' => $products])
                            ->setPaper('a4', 'portrait');

        return $pdfmysales->download('Relatorio_pedidos.pdf');
    }

    // Reseller My Sales Products Relatorio PDF
    public function reportOrderCompletedResellerMySalesProducts(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;
        $products = Product::all();
        
        $mysalesproducts = MySalesProduct::where('user_id', '=', $user_id)
                ->where('closed_order', '=', 1)
                ->when($request->has('year'), function ($whenQuery) use ($request){
                    $whenQuery->where('year', 'like', '%'.$request->year.'%');
                })
                ->when($request->filled('month'), function ($whenQuery) use ($request){
                    $whenQuery->where('month', '=', $request->month);
                })
                ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('order_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                })
                ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('order_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                })
                ->orderByDesc('year')->get();

        $pdfmysales = Pdf::loadView('adm.resellers.reseller-my-sales-products.report-order-completed-reseller-my-sales-products',
                        ['mysalesproducts' => $mysalesproducts, 'products' => $products])
                            ->setPaper('a4', 'portrait');

        return $pdfmysales->download('Relatorio_pedidos_finalizado.pdf');
    }

    public function completeOrderMySalesProducts(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;
        
        $mysalesproducts = MySalesProduct::where('user_id', '=', $user_id)
                ->where('closed_order', '=', 0)
                ->when($request->has('year'), function ($whenQuery) use ($request){
                    $whenQuery->where('year', 'like', '%'.$request->year.'%');
                })
                ->when($request->filled('month'), function ($whenQuery) use ($request){
                    $whenQuery->where('month', '=', $request->month);
                })
                ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('order_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                })
                ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('order_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                })
                ->orderByDesc('year')->get();
                
        // dd($mysalesproducts);
        foreach ($mysalesproducts as $mysalesproduct) {
            if($mysalesproduct->closed_order == 0) {

                $mysales = MySalesProduct::findOrFail($mysalesproduct->id);
                $totalPrice = $mysalesproduct->price * $mysalesproduct->quantity;
                
                $mysales->closed_order = 1;
                $mysales->purchase_price = $mysalesproduct->price;
                $mysales->total_purchase = $totalPrice;
                $mysales->purchase_date = now();
                $mysales->save();  
            }

        }
        return redirect()->route('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products');
    }

    public function reloadResellerMySalesProducts() 
    {
         //gate
         Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

         $user_id = Auth::user()->id;
         
         // Data atual do mes ano
         $dataAtual = strtotime(now());
        $dateAtuaAn = date('Y', $dataAtual);
        $dateAtuaMo = date('m', $dataAtual);
         
         $addTocarts = AddToCart::where('closed_order', '=', 0)->where('user_id', '=', $user_id)
                                            ->where('completion_date', '!=', null)
                                            ->where('my_sale_product_date', '=', null)
                                            ->get();

          $addToCartCount = $addTocarts->count();
          // dd($addTocarts, $count);
          $myReloads = MySalesProduct::all();
          $countproduct = $myReloads->count();
         
         
         //dd($myReloads, $addTocarts);
         
         if($addToCartCount != 0) {
            foreach ($addTocarts as $addTocart) {
                
                // converte dada e separa ano  mes
                $dataSomadafor = strtotime($addTocart->purchase_date);
                $datean = date('Y', $dataSomadafor);
                $datemo = date('m', $dataSomadafor);
                
                if($countproduct == 0) {
                    dd('if - 1', $addTocart);
                    $mysaleproduct = new MySalesProduct();
                    $mysaleproduct->user_id = $user_id;
                    $mysaleproduct->add_to_cart_id = $addTocart->id;
                    $mysaleproduct->year = $datean;
                    $mysaleproduct->month = $datemo;
                    $mysaleproduct->quantity = $addTocart->amount;
                    $mysaleproduct->code = $addTocart->code;
                    $mysaleproduct->point = $addTocart->point;
                    $mysaleproduct->price = $addTocart->total_price;
                    $mysaleproduct->order_date = now();
                    $mysaleproduct->save();   
                
                    $addtocartv = AddToCart::findOrFail($addTocart->id);
                    $addtocartv->closed_order = 1; 
                    $addtocartv->my_sale_product_date = now(); 
                    $addtocartv->save();
                } else if($myReloads->count() != 0) {
                    foreach ($myReloads as $myReload) {
           
                        if($myReload->user_id == $addTocart->user_id && 
                                    $myReload->code != $addTocart->code && 
                                    $myReload->add_to_cart_id != $addTocart->id) {
                                
                            // dd('if - 2', $myReload->id);
                            $mysaleproduct = new MySalesProduct();
                            $mysaleproduct->user_id = $user_id;
                            $mysaleproduct->add_to_cart_id = $addTocart->id;
                            $mysaleproduct->year = $datean;
                            $mysaleproduct->month = $datemo;
                            $mysaleproduct->quantity = $addTocart->amount;
                            $mysaleproduct->code = $addTocart->code;
                            $mysaleproduct->point = $addTocart->point;
                            $mysaleproduct->price = $addTocart->total_price;
                            $mysaleproduct->order_date = now();
                            $mysaleproduct->save();   
                        
                            $addtocartv = AddToCart::findOrFail($addTocart->id);
                            $addtocartv->closed_order = 1; 
                            $addtocartv->my_sale_product_date = now(); 
                            $addtocartv->save();
                            
                        } else if($addTocart->user_id == $user_id && 
                                $myReload->year == $datean && 
                                $myReload->month == $datemo && 
                                $myReload->code == $addTocart->code &&
                                $myReload->add_to_cart_id != $addTocart->id) {
                    
                                    dd('if - 3', $myReload->id);
                            $mysaleproduct = MySalesProduct::findOrFail($myReload->id);
                            $mysaleproduct->user_id = $user_id;
                            $mysaleproduct->add_to_cart_id = $addTocart->id;
                            $mysaleproduct->year = $datean;
                            $mysaleproduct->month = $datemo;
                            $mysaleproduct->quantity = $addTocart->amount + $myReload->quantity;
                            $mysaleproduct->code = $addTocart->code;
                            $mysaleproduct->point = $addTocart->point + $myReload->point;
                            $mysaleproduct->price = $addTocart->total_price + $myReload->price;
                            $mysaleproduct->order_date = now();
                            $mysaleproduct->save();   
                        
                            $addtocartv = AddToCart::findOrFail($addTocart->id);
                            $addtocartv->closed_order = 1; 
                            $addtocartv->my_sale_product_date = now(); 
                            $addtocartv->save();
                        }
                    }
                }
            }
                
         }

         return redirect()->route('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products'); 
    }
    
    // Riseller setup fɔ wɛbsayt ɛn klaynt saytayshɔn.
    public function wConf()
    {
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();
        return $conf;
    }
    
}