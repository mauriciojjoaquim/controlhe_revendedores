<?php

namespace App\Http\Controllers\Adm\Customers\Customer;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\AddToCart\PaymentReceipt;
use App\Models\Client;
use App\Models\CustomerStockDetail;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomersResellersController extends Controller
{
    public function home(Request $request): View|RedirectResponse
    {

        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('code', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
        }
        // $client_id = $request->client_id;

        $user = User::findOrFail(Auth::User()->id);
        
        $clientus = Client::where('email', '=', $user->email)->get();


        if ($clientus[0]->id) {
            $client_id = $clientus[0]->id;
            $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($client_id);
        }
        else {
            $client['name'] = '';
        }



        $addtocarts = AddToCart::where('completion_date','=', null)
                                ->where('user_id','=', Auth::user()->id)
                                //->where('client_id','=', $client_id)
                                ->get();

        $products = $query->paginate(10);

        //customer_stock_details
        $stocks = CustomerStockDetail::all();


        return view('client-derlers.home', compact('conf', 'addtocarts', 'client', 'products', 'stocks'));
    
    }

    public function cartInstallmentClientDetail($id = null) : view
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $addtocarts = AddToCart::where('completion_date','=', null)
                            ->where('user_id','=', Auth::user()->id)
                                ->where('client_id','=', $id)
                                ->get();


        $products = Product::all();
        $data = [];

        $data['total_quant'] = AddToCart::where('user_id', '=', Auth::user()->id)
                                        ->where('client_id', '=', $id)
                                        ->whereNull('completion_date')->count();
                                        $data['total_price'] = AddToCart::where('user_id', '=', Auth::user()->id)
                                        ->where('client_id', '=', $id)
                                        ->where('completion_date','=', null)
                                        ->get()->sum(function($cliente){
                                            return $cliente->amount;
                                        });

        $data['total_price'] = AddToCart::where('user_id', '=', Auth::user()->id)
                                        ->where('client_id', '=', $id)
                                        ->where('completion_date','=', null)
                                        ->get()->sum(function($cliente){
                                            return $cliente->total_price;
                                        });
        
        $data['total_price'] = number_format($data['total_price'], 2, ',', '.');
        
        $data['total_price_sf'] = AddToCart::where('user_id', '=', Auth::user()->id)
                                        ->where('client_id', '=', $id)
                                        ->where('completion_date','=', null)
                                        ->get()->sum(function($cliente){
                                            return $cliente->total_price;
                                        });

                // dd($data);

         return view('client-derlers.installment-client-detail.cart-installment-client-detail', compact('conf', 'products','addtocarts','data' ) );
    }

    // qr pix
    public function qrInstallmentPixClientDetail($id = null): View
    {
        
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        

        
        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        $user_id = $client->user_id;
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);
        

       // dd($client, $user);
        
        return view('client-derlers.pix.qr-code-component', compact('conf', 'user', 'client'));
    }

    // Confirmae pagamento
    public function confirmaCartPayment($id = null) : RedirectResponse
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        
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
            $addtocarts->save();
        }


        
        return redirect()->route('admin.dealers.clients.client.table-vende-clients');
        
    }
    
    // Client Confirmae pagamento
    public function clientConfirmaCartPayment($id = null): View
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($client->user_id);

        return view('client-derlers.installment-client-detail.confirm-cart-payment-detail', compact('user', 'client'));
        
    }
    
    // online
    public function onlineInstallmentClientDetail($id = null): View
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($client->user_id);

        return view('client-derlers.installment-client-detail.online-installment-client-detail', compact('conf', 'user', 'client'));
        
    }

    // pedido client
    public function addToCart(Request $request)
    {
        // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        if($request->quant_comp == 0) {
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'info',
                'icon' => '<i class="fa-solid fa-x"></i>',
                'paricin' => 'text-dark',
                'mesagem' => 'Esta Campo de quantidade é necesario!',
            ]);
        }
        
        // dd($request);
        // verificar client
        $adcr = $request->adcr;
        $adpr = $request->adpr;
        $client_id = $request->client_id;
        $product_id = $request->product_id;
        $product_id = $request->product_id;

        $quant = $request->quant_comp;
        $total = $quant * $request->price;
        $code = $request->code;

        $totaldiv = ($total / $quant);

        // Adicionar no carrinho
        if($adcr == true) {

            $addtocart = new AddToCart();
            $addtocart->user_id = Auth::user()->id;
            $addtocart->client_id = $client_id;
            $addtocart->product_id = $product_id;
            $addtocart->code = $code;
            $addtocart->amount = $quant;
            $addtocart->price = $request->price;
            $addtocart->total_price = $total;
            $addtocart->purchase_date = now();
            $addtocart->save();

            
            //dd($request);


            return redirect()->back();
            
        } elseif($adpr == true) {

            $addtocart = new AddToCart();
            $addtocart->user_id = Auth::user()->id;
            $addtocart->client_id = $client_id;
            $addtocart->product_id = $product_id;
            $addtocart->code = $code;
            $addtocart->amount = $quant;
            $addtocart->price = $request->price;
            $addtocart->total_price = $total;
            $addtocart->purchase_date = now();
            $addtocart->save();

            
            
            return redirect()->route('client-dealer.cart-installment-client-detail', ['id' => $request->client_id]);
    
        }


    }

    // closingToCart
    public function closingToCart(Request $request) : RedirectResponse
    {

            // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
             

            $id = $request->client_id;
            $total_quant = $request->total_quant;
            $total_price = $request->total_price;


        if($request->total_parcela) {
            $total_parcela = $request->total_parcela;
        } else {
            $total_parcela = 1;
        }
        
        
        $client = Client::with('clientdetail', 'clientorderdetail')
        ->findOrFail($id);

            $price_per = ($total_price / $total_parcela);
            
            for ($i = 1; $i <= $total_parcela; $i++) { 
                $dataSomada1 = strtotime('+'.$i.' month'); 
                $payment_date = date('Y-m-d H:i:s', $dataSomada1);
                $installmentclientdetails = new InstallmentClientDetail();
                $installmentclientdetails->order_number_id = $client->clientorderdetail->id;
                $installmentclientdetails->client_id = $id;
                $installmentclientdetails->user_id = Auth::user()->id;
                $installmentclientdetails->installment_number = $i;
                $installmentclientdetails->installment_price = $price_per;
                $installmentclientdetails->due_date = $payment_date;
                // dd($installmentclientdetails);
                $installmentclientdetails->save();
            }
            
            $dataSomada1 = strtotime('+1 month'); 
            $payment_date = date('Y-m-d H:i:s', $dataSomada1);
            
            $client = Client::with('clientdetail', 'clientorderdetail')
        ->findOrFail($id);

            $client->clientorderdetail()->update([
                'user_id' => Auth::user()->id,
                'total_price' => $total_price,
                'number_of_installments' => $total_parcela,
                'price_per_installment' => $price_per,
                'installments_paid' => $total_quant,
                'installment_due_date' => now(),
                'installment_payment_date' => $payment_date,
            ]);                    
                                                 

            // dd($request);
            return redirect()->route('client-dealer.qr-installment-pix-client-detail',['id' => $request->client_id]);
    }
    
    // tornar client online
    public function clientConfirmaFormPayment(Request $request) : RedirectResponse
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