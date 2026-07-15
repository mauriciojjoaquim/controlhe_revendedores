<?php

namespace App\Http\Controllers\Adm\Customers;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\AddToCart\NoteNumber;
use App\Models\AddToCart\PaymentReceipt;
use App\Models\Adm\MagazineNumber\MagazineNumber;
use App\Models\Category;
use App\Models\Client;
use App\Models\CustomerStockDetail;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\View\View;

class CustomersController extends Controller
{
    public function home(Request $request) : View
    {

        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $ciclo = MagazineNumber::where('activated', '=', 1)->first();

        $products = Product::where('magazine_number', '=', $ciclo->number)
        ->where('non_production', '=', 1)->where('confirmed', '=', 1)
        ->when($request->has('code'), function ($whenQuery) use ($request){
            $whenQuery->where('code', 'like', '%'.$request->code.'%');
         })
         ->when($request->filled('name'), function ($whenQuery) use ($request){
            $whenQuery->where('name', 'like', '%'.$request->name.'%');
        })
        ->when($request->filled('category_id'), function ($whenQuery) use ($request){
            $whenQuery->where('category_id', '=', $request->category_id);
        })
        ->when($request->filled('supplier_id'), function ($whenQuery) use ($request){
            $whenQuery->where('supplier_id', '=', $request->supplier_id);
        })
         ->orderByDesc('code')
         ->paginate(10)
         ->withQueryString();

        
        // $client_id = $request->client_id;

        $user = User::findOrFail(Auth::User()->id);
        
        $clientus = Client::where('cpf', '=', $user->document)->get();
 

        if ($clientus[0]->id) {
            $client_id = $clientus[0]->id;
            $user_id = $clientus[0]->user_id;
            $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($client_id);
        }
        else {
            $client['name'] = '';
        }


        
        $addtocarts = AddToCart::where('completion_date','=', null)
                                ->where('user_id','=', $user_id)
                                //->where('client_id','=', $client_id)
                                ->get();


                                            
        //customer_stock_details
        $stocks = CustomerStockDetail::all();
  
        
        // configuração da pagina
        
        $categories = Category::all();
        $suppliers = Supplier::all();
        
        
        return view('adm.customers.customer-home', [
            'conf' => $conf,
            'client' => $client,
            'categories' => $categories,
            'suppliers' => $suppliers,
            'products' => $products,
            'addtocarts' => $addtocarts,
            'stocks' => $stocks,
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id ,
         ]);
         
    
    }

    public function cartInstallmentCustomerDetail($id = null) : View
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        $leader = Auth::user()->leader_id;
        


        $addtocarts = AddToCart::where('completion_date','=', null)
                                ->where('user_id','=', Auth::user()->leader_id)
                                ->where('client_id','=', $id)
                                ->get();


        $products = Product::all();
        $data = [];

        $data['total_quant'] = AddToCart::where('user_id', '=', $leader)
                                        ->where('client_id', '=', $id)
                                        ->whereNull('completion_date')->count();
                                        
        $data['total_price'] = AddToCart::where('user_id', '=', $leader)
                                        ->where('client_id', '=', $id)
                                        ->where('completion_date','=', null)
                                        ->get()->sum(function($cliente){
                                            return $cliente->amount;
                                        });

        $data['total_price'] = AddToCart::where('user_id', '=', $leader)
                                        ->where('client_id', '=', $id)
                                        ->where('completion_date','=', null)
                                        ->get()->sum(function($cliente){
                                            return $cliente->total_price;
                                        });
        
        $data['total_price'] = number_format($data['total_price'], 2, ',', '.');
        
        $data['total_price_sf'] = AddToCart::where('user_id', '=', $leader)
                                        ->where('client_id', '=', $id)
                                        ->where('completion_date','=', null)
                                        ->get()->sum(function($cliente){
                                            return $cliente->total_price;
                                        });

                // dd($data);
           

         return view('adm.customers.installment-customer-detail.cart-installment-customer-detail', compact('products','addtocarts','data', 'conf') );
    }
    
    // Client Confirmae pagamento
    public function customerConfirmaCartPayment($id = null): View
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($client->user_id);

        return view('adm.customers.installment-customer-detail.confirm-cart-payment-detail', compact('user', 'client', 'conf'));
        
    }
    
    
    
    public function onlineInstallmentCustomerDetail($id = null)
    {
         // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');


        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        $id_user = $client->user_id;
        


         // create new RH
         $user = new User();
         $user->leader_id = $id_user;
         $user->name = $client->name;
         $user->email = $client->email;
         $user->email_verified_at = now();
         $user->password = bcrypt('Abc123456');
         $user->role = 'client';
         $user->department_id = '5';
         $user->permissions = 'client';
         $user->save();
 
         // create details user
         $user->detail()->create([
             'address' => $client->clientdetail->address,
             'zip_code' => $client->clientdetail->zip_code,
             'number' => $client->clientdetail->number,
             'complement' => $client->clientdetail->complement,
             'neighborhood' => $client->clientdetail->neighborhood,
             'city' => $client->clientdetail->city,
             'phone' => $client->clientdetail->phone,
             'salary' => '0.00',
             'admission_date' => now(),
         ]);
   

        return redirect()->route('admin.dealers.clients.client.table-vende-clients')
                                        ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este Cliente está liberado para acesso Online!',
                                        ]);

    }

    // qr pix
    public function qrInstallmentPixCustomerDetail($id = null): View
    {
        
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        

        
        $user_id = Auth::user()->leader_id;
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);
        
        

       //dd($client, $user, $conf);
        
        return view('adm.customers.customer-pix.qr-code-component', compact('user', 'client', 'conf'));
    }
    
    // Download from customer invoice
    public function reportOrderCartShopping($id = null)
    {

        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        Auth::user()->can('client') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;
     
        
        $cartproducts = addToCart::where('client_id', '=', $id)
                                    ->where('user_id', '=', $user_id)
                                    ->where('purchase_status_id', '=', 2)
                                    ->orderByDesc('code')
                                    ->get();
                
       $totalcarts = InstallmentClientDetail::where('client_id', '=', $id)
                                            ->where('user_id', '=', $user_id)
                                            ->get();

                                            
       $client = Client::with('clientdetail')->findOrfail($id);

                
       // dd($cartproducts, $totalcarts);
 
        // configuração da pagina
        $user_id = Auth::user()->leader_id;
        
        $products = Product::all();


        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);


  
         $pdfmysales = Pdf::loadView('adm.resellers.reseller-pix.report-qr-code-component',
                        ['user' => $user, 'cartproducts' => $cartproducts, 'totalcarts' => $totalcarts, 'client' => $client, 'products' => $products, 'conf' => $conf])
                            ->setPaper('a4', 'portrait');

        return $pdfmysales->download('fatura-'.$client->name.'.pdf');

    }

    // View from customer invoice
    public function reportViewOrderCartShopping($id = null): View
    {

        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $user_id = Auth::user()->leader_id;
     
        
        $cartproducts = addToCart::where('client_id', '=', $id)
                                    ->where('user_id', '=', $user_id)
                                    ->where('purchase_status_id', '=', 4)
                                    ->orderByDesc('code')
                                    ->get();
                
       $totalcarts = InstallmentClientDetail::where('client_id', '=', $id)
                                            ->where('user_id', '=', $user_id)
                                            ->get();

                                            
       $client = Client::with('clientdetail')->findOrfail($id);

        
        $products = Product::all();


        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);

        return view('adm.customers.customer-pix.view-qr-code-component', [
            'cartproducts' => $cartproducts, 
            'totalcarts' => $totalcarts,
            'client' => $client,
            'user' => $user, 
            'products' => $products,
            'conf' => $conf,
        ]);
    }

    // Confirmae pagamento
    public function confirmaCartPayment($id = null) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        
        $user_id = Auth::user()->leader_id;
        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($client->user_id);

        $clients = Client::with('clientorderdetail')->findOrFail($id);                  

        $clients->clientorderdetail->update([
                    'customer_status' => 'PG',
                    'situation' => 'liberado',
                    'payment_date' => now(),
                ]);

        $addtocarts = AddToCart::where('client_id', $client->id)->get();
        
        foreach($addtocarts as $addtocart) {
            $addtocarts = AddToCart::findOrFail($addtocart->id); 
            $addtocarts->completion_date = now();
            $addtocarts->purchase_status_id = 1;
            $addtocarts->save();
        }


        
        return redirect()->route('admin.dealers.clients.client.table-vende-clients', 'conf');
        
    }

    // pedido client
    public function addToCart(Request $request) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        if($request->quant_comp == 0) {
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'info',
                'icon' => 'fa-solid fa-x',
                'paricin' => 'text-dark',
                'mesagem' => 'Esta Campo de quantidade é necesario!',
            ]);
        }
        
       
        // dd($request);
        // verificar client
        $client_id = $request->client_id;
        $client = Client::findOrfail($client_id);
        $adcr = $request->adcr;
        $adpr = $request->adpr;
        
        $product_id = $request->product_id;
        

        $quant = $request->quant_comp;
        $total = $quant * $request->price;
        $code = $request->code;
        $point = $request->point * $quant;
        // dd($request);
        $totaldiv = ($total / $quant);
         // carts
         $user_id = Auth::user()->leader_id;
         
         $viewtocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->where('code', '=', $code)
                            ->where('closed_order', '=', 0)->get();


        // Adicionar no carrinho
        if($adcr == true) {

            if($viewtocart->count() != 0) {
                if($code === $viewtocart[0]['code']) {

                    $upltocart = AddToCart::findOrFail($viewtocart[0]['id']);
                    $upltocart->point = $point + $viewtocart[0]['point'];
                    $upltocart->purchase_status_id = 2;
                    $upltocart->amount = $quant + $viewtocart[0]['amount'];
                    $upltocart->total_price = $total + $viewtocart[0]['total_price'];
                    $upltocart->save();
                    
                }
            } else {
                $addtocart = new AddToCart();
                $addtocart->user_id = $user_id;
                $addtocart->client_id = $client_id;
                $addtocart->product_id = $product_id;
                $addtocart->code = $code;
                $addtocart->purchase_status_id = 2;
                $addtocart->point = $point;
                $addtocart->amount = $quant;
                $addtocart->price = $request->price;
                $addtocart->total_price = $total;
                $addtocart->purchase_date = now();
                $addtocart->save();
            } 

            return redirect()->back();
            
        } elseif($adpr == true) {

            if($viewtocart->count() != 0) {
                if($code === $viewtocart[0]['code']) {

                    $upltocart = AddToCart::findOrFail($viewtocart[0]['id']);
                    $upltocart->point = $point + $viewtocart[0]['point'];
                    $upltocart->purchase_status_id = 2;
                    $upltocart->amount = $quant + $viewtocart[0]['amount'];
                    $upltocart->total_price = $total + $viewtocart[0]['total_price'];
                    $upltocart->save();
                    
                }
            } else {
                $addtocart = new AddToCart();
                $addtocart->user_id = $user_id;
                $addtocart->client_id = $client_id;
                $addtocart->product_id = $product_id;
                $addtocart->code = $code;
                $addtocart->purchase_status_id = 2;
                $addtocart->point = $point;
                $addtocart->amount = $quant;
                $addtocart->price = $request->price;
                $addtocart->total_price = $total;
                $addtocart->purchase_date = now();
                $addtocart->save();
            }

            
            
            return redirect()->route('customers.customer-dealer.cart-installment-customer-detail', ['id' => $request->client_id]);
    
        }


    }

    // closingToCart
    public function closingToCart(Request $request) : RedirectResponse
    {


        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        if($request->total_installment == 'Selecione uma parcela') {
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'info',
                'icon' => 'fa-solid fa-x',
                'paricin' => 'text-dark',
                'mesagem' => 'Esta Campo de Parcela é necesario!',
            ]);
        }

        $client_id = $request->client_id;
        $user_id = $request->user_id;
        $total_quant = $request->total_quant;
        $total_price = $request->total_price;
        $point = $request->point;
        $total_installment = $request->total_installment;
            
        
        
            
        if($request->total_installment != 'Selecione uma parcela') {
            $total_parcela = $total_installment;
        } else {
            $total_parcela = 1;
        }
        // dd($total_parcela);

        $nOrder = NoteNumber::all();
        
        $client = Client::with('clientdetail', 'clientorderdetail')
                        ->findOrFail($client_id);

        $price_per = ($total_price / $total_parcela);
        
        $newnoto = NoteNumber::findOrFail(1);
        
        if($total_installment == 1) {
            
            // dd('um parcelaa',$client_id,$user_id,$total_quant,$point,$total_installment);
   
            $dataSomada1 = strtotime('+ 3 day'); 
            $payment_date = date('Y-m-d H:i:s', $dataSomada1);
            
            $installmentclientdetails = new InstallmentClientDetail();
            if($nOrder[0]->number == $installmentclientdetails->order_number_id) {
                
                $installmentclientdetails->order_number_id = $nOrder[0]->number + 1;
            } else {
                $installmentclientdetails->order_number_id = $nOrder[0]->number;
            }

            $installmentclientdetails->client_id = $client_id;
            $installmentclientdetails->user_id = Auth::user()->leader_id;
            $installmentclientdetails->installment_number = $total_installment;
            $installmentclientdetails->point = $point;
            $installmentclientdetails->quantity_product = $total_quant;
            $installmentclientdetails->installment_price = $price_per;
            $installmentclientdetails->due_date = $payment_date;
            $installmentclientdetails->save();
            
        } else {
            
            dd('mais de uma parcelaa',$user_id,$total_quant,$point,$total_installment);
            for ($i = 0; $i < $total_parcela; $i++) { 
            
                if($i === 1) {
                    $dataSomada1 = strtotime('+ 3 day'); 
                }else{
                    $dataSomada1 = strtotime('+'.$i.' month'); 
                } 
                $dataSomada1 = strtotime('+'.$i.' month'); 
                $payment_date = date('Y-m-d H:i:s', $dataSomada1);
                
                $installmentclientdetails = new InstallmentClientDetail();
                
                if($nOrder[0]->number == $installmentclientdetails->order_number_id) {
                    
                    $installmentclientdetails->order_number_id = $nOrder[0]->number + 1;
                } else {
                    $installmentclientdetails->order_number_id = $nOrder[0]->number;
                }
    
                $installmentclientdetails->client_id = $client_id;
                $installmentclientdetails->user_id = Auth::user()->leader_id;
                $installmentclientdetails->installment_number = $i;
                $installmentclientdetails->point = $point;
                $installmentclientdetails->quantity_product = $total_quant;
                $installmentclientdetails->installment_price = $price_per;
                $installmentclientdetails->due_date = $payment_date;
                $installmentclientdetails->save();
            }
        }
            
        
            
        $newnoto->number = $nOrder[0]->number + 1;
        $newnoto->save();
        
        $dataSomada1 = strtotime('+3 day'); 
        $payment_date = date('Y-m-d H:i:s', $dataSomada1);
        
        $client = Client::with('clientdetail', 'clientorderdetail')
                    ->findOrFail($client_id);
                    

        $client->clientorderdetail()->update([
            'user_id' => Auth::user()->leader_id,
            'total_price' => $total_price + $client->clientorderdetail->total_price,
            'number_of_installments' => $total_parcela + $client->clientorderdetail->number_of_installments,
            'price_per_installment' => $price_per + $client->clientorderdetail->price_per_installment,
            'installments_paid' => $total_quant + $client->clientorderdetail->installments_paid,
            'installment_due_date' => now(),
            'installment_payment_date' => $payment_date,
        ]);  
            
        // addToCart
        $reltocart = AddToCart::where('user_id', '=', $user_id)
                        ->where('client_id', '=', $client_id)
                        ->where('completion_date', '=', null)
                        ->where('closed_order', '=', 0)
                        ->get();

        $reltocart_quant = $reltocart->count();
        // dd($reltocart[0]->id,$reltocart_quant);

        for($i = 0; $i < $reltocart_quant; $i++) {
            $reltocartv = AddToCart::findOrFail($reltocart[$i]->id);
            $reltocartv->closed_order = 1;
            $reltocartv->completion_date = now();
            $reltocartv->purchase_status_id = 4;
            $reltocartv->save();
        }                                     

        // dd($request);
        return redirect()->route('customers.customer-dealer.qr-installment-pix-customer-detail',['id' => $request->client_id]);
    }
    
    // tornar client online
    public function customerConfirmaFormPayment(Request $request) : RedirectResponse
    {
        
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $id = $request->id;

        $request->validate(
            [
                'imagem' => 'required|mimes:jpg,png,pdf|max:200|dimensions:min_width=50,min_height=50',
                'id' => 'required|',
            ], ['imagem.required' => 'É necesario envio do comprovante',]);


        $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($id);
        $user_id = $client->user_id;
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')
                        ->findOrFail($user_id);
        
        $payment_receipt = new PaymentReceipt();

        // dd($client, $user);
        
        //Hasndle File upload
        if($request->hasFile('imagem')) {
            // Get filename with the extensuon
            $filenameWithExt = $request->file('imagem')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension = $request->file('imagem')->getClientOriginalExtension();
            // File to store
            $fileNameToStore = $filename .'_'.time().'.'. $extension;
            // upload image
            $extension = $request->file('imagem')->getClientOriginalExtension();
            $extension = $request->file('imagem')->getClientOriginalExtension();

            $ingUrl = 'app/public/imagens/payment-receipt/'. $user->id;

            $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

            $payment_receipt->name = $fileNameToStore;

        } else {

                if($payment_receipt->name == null) {
                    $payment_receipt->name =  '150x150.png';
                }

            }
            
            $payment_receipt->client_id = $id;
            $payment_receipt->user_id = $user->id;
            $payment_receipt->order_number_id = $client->clientorderdetail->id;
            $payment_receipt->shipping_date = now();
            $payment_receipt->save();

            $addtocarts = AddToCart::where('client_id', $client->id)->get();
            
            foreach($addtocarts as $addtocart) {
                $addtocarts = AddToCart::findOrFail($addtocart->id); 
                $addtocarts->completion_date = now();
                $addtocarts->save();
            }

        return redirect()->route('clients.home');
    }
    
    public function cartDown(Request $request) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $cart_id = $request->cart_id;
        $user_id = $request->user_id;
        $client_id = $request->client_id;

        $reltocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->get();
                                              
               
         $viewtocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->findOrFail($cart_id);

        // dd($viewtocart->amoun);
        if($viewtocart->amount == 0) {
            return redirect()->route('customers.customer-dealer.cart-installment-customer-detail');
        }                     
                            
        $point = $viewtocart->point / $viewtocart->amount;
        
        $viewtocart->amount = $viewtocart->amount - 1;
        $viewtocart->point = $viewtocart->point - $point;
        $viewtocart->total_price = $viewtocart->total_price - $viewtocart->price;
        $viewtocart->save();
        
        
        
        return redirect()->back();
        
        
    }
    
    public function cartUp(Request $request) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $cart_id = $request->cart_id;
        $user_id = $request->user_id;
        $client_id = $request->client_id;

        $reltocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->get();
               
         $viewtocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->findOrFail($cart_id);

                  //dd($viewtocart->amount);          
        if($viewtocart->amount == 0) {
            return redirect()->route('customers.customer-dealer.cart-installment-customer-detail');
        }                   

        $point = $viewtocart->point / $viewtocart->amount;
        
        $viewtocart->amount = $viewtocart->amount + 1;
        $viewtocart->point = $viewtocart->point + $point;
        $viewtocart->total_price = $viewtocart->total_price + $viewtocart->price;
        $viewtocart->save();
        
        
        
        return redirect()->back();
    }
    
    public function cartDelete(Request $request) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $cart_id = $request->cart_id;
        $user_id = $request->user_id;
        $client_id = $request->client_id;

        $reltocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->get();
               
         $viewtocart = AddToCart::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client_id)
                            ->where('completion_date', '=', null)
                            ->findOrFail($cart_id);

        $viewtocart->delete();
        
        if($reltocart->count() == 0) {
            return redirect()->route('customers.customer-dealer.cart-installment-customer-detail');
        }
        
     return redirect()->back();
    }
    
    // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->leader_id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    // Gate 
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }
}