<?php

namespace App\Http\Controllers\Adm\Resellers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\Category;
use App\Models\Client;
use App\Models\ClientOrderDetail;
use App\Models\CustomerStockDetail;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use App\Models\Total\TotalMonthlyClosing;
use App\Models\User;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class RellerInstallmentCustomerDetailController extends Controller
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
        $conf = $this->wConf();

        return view('dealers.installment-client-detail.table-installment-client-detail', compact('conf', 'clients', 'users'));

    }

    //clients New
    public function addInstallmentClientDetail(Request $request): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        if ($request->client_id) {
            $client_id = $request->client_id;
            $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($client_id);
        }
        else {
            $client['name'] = '';
        }
        $user_id = Auth::user()->id;
         $clients = Client::all();
         
         $products = Product::when($request->has('code'), function ($whenQuery) use ($request){
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




        $addtocarts = AddToCart::where('completion_date','=', null)
                                ->where('user_id','=', Auth::user()->id)
                                ->where('client_id','=', $client_id)
                                ->get();




        //customer_stock_details
        $stocks = CustomerStockDetail::all();
        $categories = Category::all();
        $suppliers = Supplier::all();
        $conf = $this->wConf();


        return view('adm.resellers.reseller-installment-detail.add-reseller-installment-detail', [
            'conf' => $conf,
            'code' => $request->code, 
            'name' => $request->name, 
            'category_id' => $request->category_id, 
            'supplier_id' => $request->supplier_id, 
            'addtocarts' => $addtocarts, 
            'client' => $client, 
            'products' => $products, 
            'stocks' => $stocks, 
            'categories' => $categories, 
            'suppliers' => $suppliers]);
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
                $conf = $this->wConf();

         return view('adm.resellers.reseller-installment-detail.cart-reseller-installment-detail', compact('conf', 'products','addtocarts','data' ) );
    }

    // pedido client
    public function addToCart(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        // dd($request);

        if($request->quant_comp == 0) {
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'info',
                'icon' => '<i class="fa-solid fa-x"></i>',
                'paricin' => 'text-dark',
                'mesagem' => 'Esta Campo de quantidade Ã© necesario!',
            ]);
        }

        // dd($request);
        // verificar client
        $adcr = $request->adcr;
        $adpr = $request->adpr;
        $client_id = $request->client_id;
        $product_id = $request->product_id;


        $quant = $request->quant_comp;
        $total = $quant * $request->price;
        $code = $request->code;

        $totaldiv = ($total / $quant);

        // Adicionar no carrinho
        if($adcr == true) {

            $addtocartq = AddToCart::where('completion_date', '=', null)
                                    ->where('code', '=', $code)
                                    ->where('client_id', '=', $client_id)
                                    ->where('user_id', '=', Auth::user()->id)
                                    ->get();


            if($addtocartq->count() > 0) {
                $addtocart = AddToCart::findOrFail($addtocartq[0]['id']);
                $addtocart->user_id = Auth::user()->id;
                $addtocart->client_id = $client_id;
                $addtocart->product_id = $product_id;
                $addtocart->code = $code;
                $addtocart->amount = $quant + $addtocartq[0]['amount'];
                $addtocart->point = $request->point + $addtocartq[0]['point'];
                $addtocart->price = $request->price;
                $addtocart->total_price = $total + $addtocartq[0]['total_price'];
                $addtocart->purchase_date = now();
                $addtocart->save();

            }else {
                $addtocart = new AddToCart();
                $addtocart->user_id = Auth::user()->id;
                $addtocart->client_id = $client_id;
                $addtocart->product_id = $product_id;
                $addtocart->code = $code;
                $addtocart->amount = $quant;
                $addtocart->point = $request->point;
                $addtocart->price = $request->price;
                $addtocart->total_price = $total;
                $addtocart->purchase_date = now();
                $addtocart->save();
            }

            return redirect()->back();

        } elseif($adpr == true) {

            $addtocart = new AddToCart();
            $addtocart->user_id = Auth::user()->id;
            $addtocart->client_id = $client_id;
            $addtocart->product_id = $product_id;
            $addtocart->code = $code;
            $addtocart->amount = $quant;
            $addtocart->point = $request->point;
            $addtocart->price = $request->price;
            $addtocart->total_price = $total;
            $addtocart->purchase_date = now();
            $addtocart->save();

            return redirect()->route('adm.resellers.reseller-installment-detail.cart-reseller-installment-detail', ['id' => $request->client_id]);

        }


    }

    // closingToCart
    public function closingToCart(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        // dd($request);
        $id = $request->client_id;
        $total_quant = $request->total_quant;
        $total_point = $request->total_point;
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
            $dataSomadafor = strtotime('+'.$i.' month');
            $payment_datefor = date('Y-m-d H:i:s', $dataSomadafor);

            $installmentclientdetails = new InstallmentClientDetail();
            $installmentclientdetails->order_number_id = $client->clientorderdetail->id;
            $installmentclientdetails->client_id = $id;
            $installmentclientdetails->user_id = Auth::user()->id;
            $installmentclientdetails->installment_number = $i;
            $installmentclientdetails->quantity_product = $total_quant;
            $installmentclientdetails->point = $total_point;
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

        $cards = AddToCart::where('user_id', '=', Auth::user()->id)
                            ->where('completion_date', '=', null)
                            ->where('client_id', '=', $id)
                            ->get();

            $qtd = $cards->count();

             if($qtd > 0) {
                // dd($cards);
                foreach($cards as $card) {
                    $cardsfor = AddToCart::findOrfail($card->id);
                    $cardsfor->completion_date = now();
                    $cardsfor->save();
                }

             }

            return redirect()->route('adm.resellers.reseller-installment-detail.qr-reseller-installment-detail',['id' => $request->client_id]);
    }

    // qr pix
    public function qrInstallmentPixClientDetail($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        $user_id = Auth::user()->id;

        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        $conf = $this->wConf();

        return view('adm.resellers.reseller-pix.qr-code-component', compact('conf', 'user', 'client'));
    }

    public function confirmaCartPayment($id)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        $user_id = Auth::user()->id;

        // pagamento da parcela retirando do valor total 
        $installment = InstallmentClientDetail::where('user_id', '=', $user_id)
                                                ->findOrFail($id);                                  
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($installment->client_id);
        $user = User::with('detail', 'installmentClientDetail')
                                 ->findOrFail($client->user_id);
        $conf = $this->wConf();
        
        // Data mes e ano
        $data = now();
        $year = date('Y', strtotime($data));
        $month = date('m', strtotime($data));

        // client order detail data
        $clientorderdetail_id = $client->clientorderdetail->id; 
        $price_per_installment = $client->clientorderdetail->price_per_installment;  
        $total_price = $client->clientorderdetail->total_price;
        $installment_number = $client->clientorderdetail->installments_paid;


        $desc = $price_per_installment - $installment->installment_price; 
        $desctotal = $total_price - $installment->installment_price;
        $descinstallment = $installment_number + 1;

        $installment->year = $year;
        $installment->month = $month;
        $installment->purchase_status_id = 1;
        $installment->payment_date = now();
        $installment->save();

        $clientorderdetail = ClientOrderDetail::findOrFail($clientorderdetail_id);
        
        
        if($desctotal == 0.00 && $price_per_installment != 0.00) {
            $clientorderdetail->total_price = 0.00;
            $clientorderdetail->number_of_installments = 0;
            $clientorderdetail->price_per_installment = 0.00;
            $clientorderdetail->installments_paid = 0;
            $clientorderdetail->installment_due_date = null; 
            $clientorderdetail->installment_payment_date = null;
            $clientorderdetail->customer_status = 'NC';
            $clientorderdetail->situation = 'liberado';
         
            
        } else {
            $clientorderdetail->total_price = $desctotal;
            $clientorderdetail->price_per_installment = $desc;
            $clientorderdetail->installments_paid = $descinstallment;
            $clientorderdetail->installment_payment_date = now();
        }
                                                 
        $addtocarts = AddToCart::where('client_id', $client->id)->get();

        foreach($addtocarts as $addtocart) {
            $addtocarts = AddToCart::findOrFail($addtocart->id);
            $addtocarts->completion_date = now();
            $addtocarts->purchase_status_id = 1;
            $addtocarts->closed_order = 1;
            $addtocarts->save();
        }

        $fechamentomes = TotalMonthlyClosing::where('user_id', '=', $user_id)
                                            ->where('year', '=', $year)
                                            ->where('month', '=', $month)
                                            ->get();

        $perc = $conf->percentage;
        $total = $user->installmentClientDetail->installment_price;
        $point = $user->installmentClientDetail->point;
        $price_installment = $user->installmentClientDetail->price_per_installment;
        $total_perc = $perc / 100.0;
        $total_lucro = ($total * $total_perc);
        $reselle_price = $total - ($total * $total_perc);

        $product_quantity = $user->installmentClientDetail->quantity_product;

        
       
        
         

        if($fechamentomes->count() == 0) {
            $fechamentomesN = new TotalMonthlyClosing();
            $fechamentomesN->user_id = $user_id;
            $fechamentomesN->year = $year;
            $fechamentomesN->month = $month;
            $fechamentomesN->point = $point;
            $fechamentomesN->product_quantity = $product_quantity;
            $fechamentomesN->reselle_price = $reselle_price;
            $fechamentomesN->magazine_price = $total;
            $fechamentomesN->reseller_profit = $total_lucro; 
            $fechamentomesN->save();

        } else {
            //  dd($fechamentomes[0]->id);
            $fechamentomesU = TotalMonthlyClosing::findOrFail($fechamentomes[0]->id);
            $fechamentomesU->point = $fechamentomes[0]->point + $point;
            $fechamentomesU->product_quantity = $fechamentomes[0]->product_quantity + $product_quantity;
            $fechamentomesU->reselle_price = $fechamentomes[0]->reselle_price + $reselle_price;
            $fechamentomesU->magazine_price = $fechamentomes[0]->magazine_price + $total;
            $fechamentomesU->reseller_profit = $fechamentomes[0]->reseller_profit + $total_lucro;
            $fechamentomesU->save(); 

        }
        $clientorderdetail->save(); 
        

        return redirect()->route('home');

    }

    public function clientConfirmaCartPayment($id): View
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        // Gera pdf de fatura para pagamento


        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);
        // Cofigurações do app do vendedor
        $conf = $this->wConf();
        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($client->user_id);

        $conf = $this->wConf();

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
        $conf = $this->wConf();


        return view('dealers.installment-client-detail.edit--installment-client-detail', compact('conf', 'client'));

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

    //clients Created
    public function createdInstallmentClientDetail(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        // validaÃ§Ã£o
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
        $clientordendetails = ClientOrderDetail::all();
        // Cofigurações do app do vendedor
        $conf = $this->wConf();

        return view('clients.client.show-clients', compact('conf' ,'client', 'clientordendetails'));
    }

    //clients Confirm delete
    public function confDeleteInstallmentClientDetail($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $client = InstallmentClientDetail::findOrFail($id);
        
        // Cofigurações do app do vendedor
        $conf = $this->wConf();

        return view('dealers.installment-client-detail.confirm-delete--installment-client-detai', compact('conf', 'client'));
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

        $conf = $this->wConf();
        $user = User::with('Settingsdetail', 'detail')->findOrFail($id);
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        return view('admin.dealers.clients.client.qr-installment-pix-client-detail', compact('client', 'user', 'conf'));
    }
    
    // Releasing the client online
    public function onlineInstallmentClientDetail($id)
    {
         //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');


        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        $id_user = Auth::user()->id;



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

    // Download from customer invoice
    public function reportOrderCartShopping($id)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

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
 
        // Cofigurações do app do vendedor
        $conf = $this->wConf();
        $products = Product::all();


        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);


  
         $pdfmysales = Pdf::loadView('adm.resellers.reseller-pix.report-qr-code-component',
                        ['user' => $user, 'cartproducts' => $cartproducts, 'totalcarts' => $totalcarts, 'client' => $client, 'products' => $products, 'conf' => $conf])
                            ->setPaper('a4', 'portrait');

        return $pdfmysales->download('fatura-'.$client->name.'.pdf');

    }
    
    public function reportViewOrderCartShopping($id)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

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
 
        // Cofigurações do app do vendedor
        $conf = $this->wConf();
        $products = Product::all();


        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);

        return view('adm.resellers.reseller-pix.view-qr-code-component', [
            'cartproducts' => $cartproducts, 
            'totalcarts' => $totalcarts,
            'client' => $client,
            'user' => $user, 
            'products' => $products,
            'conf' => $conf,
        ]);
    }

    // Riseller setup fɔ wɛbsayt ɛn klaynt saytayshɔn.
    public function wConf()
    {
        $user_id = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $user_id)->first();
        return $conf;
    }

    //Validar cpf
    public function validaCPF($cpf)
    {

        // Extrai somente os nÃºmeros
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequÃªncia de digitos repetidos. Ex: 111.111.111-11
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