<?php

namespace App\Http\Controllers\Adm\Resellers\reseller;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\Client;
use App\Models\ClientOrderDetail;
use App\Models\CustomerStockDetail;
use App\Models\Product;
use App\Models\Session;
use App\Models\SettingsDetail;
use App\Models\Total\TotalMonthlyClosing;
use App\Models\User;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ResellerInstallmentcustomerDetailController extends Controller
{

    use Notifiable;


    //clients Table
    public function tableInstallmentClientDetail(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $clients = InstallmentClientDetail::where('user_id','=', Auth::user()->id)->get();
        $users = User::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.installment-client-detail.table-installment-client-detail', compact('conf', 'clients', 'users'));

    }

    //clients New
    public function addInstallmentClientDetail(Request $request): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');


        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('code', 'like', "%$search%")
                  ->orWhere('name', 'like', "%$search%");
        }
        
        
        
        $client_id = $request->client_id;

        
        // dd($request);

        if ($client_id) {
            $client_id = $request->client_id;
            $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($client_id);

            $client_id =  $client->id;

        }
        else {
            $client_id = session('client_id');
            $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($client_id);

            $client_id =  $client->id;

        }


        // carrinho de compra
        $addtocarts = AddToCart::where('completion_date','=', null)
                                ->where('user_id','=', Auth::user()->id)
                                ->where('client_id','=', $client_id)
                                ->get();

        

        //customer_stock_details
        $stocks = CustomerStockDetail::all();

        $products = $query->paginate(10);
        
       // dd($products);

        return view('dealers.installment-client-detail.add-installment-client-detail', compact('addtocarts', 'client', 'products', 'stocks'))
                                        ->with(['client_id' => $client_id,]);
    }

    public function cartInstallmentClientDetail($id)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        
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
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

         return view('dealers.installment-client-detail.cart-installment-client-detail', compact('conf', 'products','addtocarts','data' ) );
    }

    // pedido client
    public function addToCart(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

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

            
            
            return redirect()->route('admin.dealers.clients.client.cart-installment-client-detail', ['id' => $request->client_id]);
    
        }


    }
    
    // excluir pedido
    public function confirmaDeleteCart($id)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');
        
   

        $delcart = AddToCart::where('user_id', '=', Auth::user()->id)->findOrFail($id);
        $delcart->delete();

        return redirect()->back();
        
    } 

    // closingToCart
    public function closingToCart(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

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

        // date
     
        

            $price_per = ($total_price / $total_parcela);
            
            for ($i = 1; $i <= $total_parcela; $i++) { 
                $dataSomadafor = strtotime('+'.$i.' month'); 
                $payment_datefor = date('Y-m-d H:i:s', $dataSomadafor);
                $datean = date('Y', $dataSomadafor);
                $datemo = date('m', $dataSomadafor);
                
                $installmentclientdetails = new InstallmentClientDetail();
                $installmentclientdetails->order_number_id = $client->clientorderdetail->id;
                $installmentclientdetails->client_id = $id;
                $installmentclientdetails->user_id = Auth::user()->id;
                $installmentclientdetails->year = $datean;
                $installmentclientdetails->month = $datemo;
                $installmentclientdetails->installment_number = $i;
                $installmentclientdetails->quantity_product = $total_quant;
                $installmentclientdetails->installment_price = $price_per;
                $installmentclientdetails->due_date = $payment_datefor;
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
                'installments_paid' => 0,
                'customer_status' => 'NC',
                'installment_due_date' => $payment_date,
                'installment_payment_date' => null,
            ]);                    
                                                 

            // dd($request);
            return redirect()->route('admin.dealers.clients.client.qr-installment-pix-client-detail',['id' => $request->client_id]);
    }

    // qr pix
    public function qrInstallmentPixClientDetail($id): View
    {
        
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');
        

        $user_id = Auth::user()->id;
        

        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

       // dd($client, $user);
        
        return view('dealers.pix.qr-code-component', compact('conf', 'user', 'client'));
    }

    public function confirmaCartPayment($id)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')
                            ->findOrFail($client->user_id);


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
        
        // Data mes e ano 
        $data = now();
        $year = date('Y', strtotime($data));
        $month = date('m', strtotime($data));
        $user_id = Auth::user()->id;
         
        $fechamentomes = TotalMonthlyClosing::where('user_id', '=', $user_id)
                                            ->where('user_id', '=', Auth::user()->id)
                                            ->where('year', '=', $year)
                                            ->where('month', '=', $month)
                                            ->get();


        $total = $user->installmentClientDetail->total_price;
        $preço_parcela = $user->installmentClientDetail->price_per_installment;
                                            
        $product_quantity = 10;
        $reselle_price = $fechamentomes->reselle_price + $total;
        $magazine_price = $fechamentomes->magazine_price + $total;
        
        if($fechamentomes->count() > 0) {
            $fechamentomes = new TotalMonthlyClosing();
            $fechamentomes->user_id = $user_id;
            $fechamentomes->year = $year;
            $fechamentomes->month = $month;
            $fechamentomes->product_quantity =$product_quantity;
            $fechamentomes->reselle_price = $reselle_price;
            $fechamentomes->magazine_price = $magazine_price;



            
        }else {
            
        }
        
        return redirect()->route('admin.dealers.clients.client.table-vende-clients');
        
    }
    
    public function clientConfirmaCartPayment($id): View
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($client->user_id);

        return view('dealers.installment-client-detail.confirm-cart-payment-detail', compact('conf', 'user', 'client'));
        
    }

    //clients Edit
    public function editInstallmentClientDetail($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');


        $client = InstallmentClientDetail::with('clientdetail')->findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('dealers.installment-client-detail.edit--installment-client-detail', compact('conf', 'client'));

    }

    //clients Created
    public function createdInstallmentClientDetail(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        // validação
        $request->validate([
            'order_number_id' => 'required|',
            'client_id' => 'required|',
            'user_id' => 'required|',
            'installment_number' => 'required|',
            'installment_price' => 'required|',
            'due_date' => 'required|',
            'payment_date' => 'required|',
        ]);


        $id = 1;
        $dataEspecifica = now();


        $cliorder = ClientOrderDetail::findOrFail($id);
        $cliorder->user_id = Auth::user()->id;
        $cliorder->total_price = '0.00';
        $cliorder->number_of_installments = 0;
        $cliorder->price_per_installment = '0.00';
        $cliorder->installments_paid = 0;
        $cliorder->installment_due_date = null;
        $cliorder->installment_payment_date = null;
        $cliorder->save();


        $num = $cliorder->number_of_installments;

        for ($i = 1; $i <= $num; $i++) {
            $cusbv = new InstallmentClientDetail();
            $cusbv->order_number_id = $cliorder->id;
            $cusbv->client_id = $cliorder->client_id;
            $cusbv->user_id = Auth::user()->id;
            $cusbv->installment_number = $cliorder->number_of_installments;
            $cusbv->installment_price = $i;
            $cusbv->due_date = (strtotime($dataEspecifica. '+'.$i.' month'));
            $cusbv->save();
        }





        return redirect()->route('admin.dealers.clients.client.table-installment-client-detail');
    }

    //clients Updated
    public function updatedInstallmentClientDetail(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $cpf = $request->cpf;

        $this->validaCPF($cpf);
        if($this->validaCPF($cpf) == false){
            return redirect()->back();
        }



        $request->validate([
            'name' => 'required|string|max:140|unique:clients,id',
            'email' => 'required|string|max:140|unique:clients,id',
            'cpf' => 'required|string|max:20|unique:clients,id',
            'zip_code' => 'required|string|max:140|',
            'address' => 'required|string|max:140|',
            'number' => 'required|string|max:140|',
            'complement' => 'required|string|max:140|',
            'neighborhood' => 'required|string|max:140|',
            'city' => 'required|string|max:140|',
            'phone' => 'required|string|max:140|',
            'id' => 'required',

        ]);

        $id = $request->id;

        $cusbv = InstallmentClientDetail::findOrFail($id);
        $cusbv->user_id = Auth::user()->id;
        $cusbv->name = $request->name;
        $cusbv->email = $request->email;
        $cusbv->cpf = $request->cpf;
        $cusbv->save();

        $cusbvdetail = InstallmentClientDetail::where('client_id','=',$id)->first();
        $cusbvdetail->zip_code = $request->zip_code;
        $cusbvdetail->address = $request->address;
        $cusbvdetail->number = $request->number;
        $cusbvdetail->complement = $request->complement;
        $cusbvdetail->neighborhood = $request->neighborhood;
        $cusbvdetail->city = $request->city;
        $cusbvdetail->phone = $request->phone;
        $cusbvdetail->save();



        $client = InstallmentClientDetail::findOrFail($id);
        $client->user_id = Auth::user()->id;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->cpf = $request->cpf;
        $client->save();


        // create details user
        $clientdetail = InstallmentClientDetail::where('client_id','=',$id)->first();
            $clientdetail->zip_code = $request->zip_code;
            $clientdetail->address = $request->address;
            $clientdetail->number = $request->number;
            $clientdetail->complement = $request->complement;
            $clientdetail->neighborhood = $request->neighborhood;
            $clientdetail->city = $request->city;
            $clientdetail->phone = $request->phone;
            $clientdetail->save();



        return redirect()->route('admin.dealers.clients.client.table-installment-client-detail');

    }

    //clients Show
    public function showInstallmentClientDetail($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $client = InstallmentClientDetail::with('user', 'clientdetail', 'clientordendetail')->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
        $clientordendetails = ClientOrderDetail::all();
        
        return view('clients.client.show-clients', compact('conf', 'client', 'clientordendetails'));
    }

    //clients Confirm delete
    public function confDeleteInstallmentClientDetail($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $client = InstallmentClientDetail::findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.installment-client-detail.confirm-delete--installment-client-detail',compact('conf', 'client'));
    }

    //clients Delete
    public function deletedInstallmentClientDetail(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;

        $client = InstallmentClientDetail::with('clientdetail', 'clientordendetail')->findOrFail($id);
        $client->delete();


        return redirect()->route('admin.dealers.clients.client.table-installment-client-detail');
    }

    // qr installment pix client detail
    public function cartShopping(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');
        
        $id = $request->id;
        
        $conf = SettingsDetail::findOrFail($id);
        $user = User::with('Settingsdetail', 'detail')->findOrFail($id);
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        
        return view('admin.dealers.clients.client.qr-installment-pix-client-detail', compact('client', 'user', 'conf'));
    }

    //Validar cpf 
    public function validaCPF($cpf) 
    {
    
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }
    
}