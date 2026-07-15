<?php

namespace App\Http\Controllers\Adm\Customers\CustomerFinancial;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\AddToCart\CustomerVoucher;
use App\Models\Adm\admin\PurchaseStatu;
use App\Models\Client;
use App\Models\Customers\CustomerFreights\CustomerFreights;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class CustomerFinancialController extends Controller
{
    // myClosedPurchase  -  Minhas Compra
    public function myClosedPurchase()
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();


        $addtocarts = AddToCart::where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->where('purchase_status_id', '=', 1)
                                ->get();

        $products = Product::with('supplier')->get();
        $users = User::all();
        // configuração da pagina
        $user_id = Auth::user()->leader_id;


        return view('adm.customers.customer-financial.table-customer-my-closed-purchases',
            [
                    'addtocarts' => $addtocarts,
                    'products' => $products,
                    'conf' => $conf,
                    'users' => $users,
                ]);

    }

    // myOpenPurchase
    public function myOpenPurchase()
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();


        $addtocarts = AddToCart::where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->where('purchase_status_id', '=', 4)
                                ->get();

        $products = Product::with('supplier')->get();
        $users = User::all();
        // configuração da pagina


        return view('adm.customers.customer-financial.table-customer-my-open-purchases',
            [
                    'addtocarts' => $addtocarts,
                    'products' => $products,
                    'conf' => $conf,
                    'users' => $users,
                ]);

    }

    // My Payments  -  meu Pagamentos
    public function myPayments()
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();


        $addtocarts = AddToCart::where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->where('purchase_status_id', '=', 4)
                                ->get();


        $users = User::all();
        // configuração da pagina
        $user_id = Auth::user()->leader_id;

        $payments = InstallmentClientDetail::where('user_id', '=', $user_id)
                                    ->where('client_id', '=', $client[0]->id)
                                    ->get();

        return view('adm.customers.customer-financial.table-customer-my-payments',
                [
                    'addtocarts' => $addtocarts,
                    'conf' => $conf,
                    'users' => $users,
                    'payments' => $payments,
                ]);

    }

    // My Receipts  -  meu coprovantes
    public function myReceipts()
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

    }

    // Order Status  -  estatus do pedido
    public function orderStatus()
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();
        $clients = Client::all();

        $customerFreights = CustomerFreights::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client[0]->id)
                            ->get();


        $users = User::all();
        // configuração da pagina
        $user_id = Auth::user()->leader_id;


        return view('adm.customers.customer-financial.table-customer-order-status',
                            [
                                    'customerFreights' => $customerFreights,
                                    'conf' => $conf,
                                    'users' => $users,
                                    'clients' => $clients,
                                ]);
    }

     // My Purchases  -  Minhas Compra show
    public function showMyPayments($id = null)
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();


        $addtocarts = AddToCart::where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->get();

        $purchase_status = PurchaseStatu::all();
        $users = User::all();
        // configuração da pagina
        $user_id = Auth::user()->leader_id;

        $payment = InstallmentClientDetail::where('user_id', '=', $user_id)
                                    ->where('client_id', '=', $client[0]->id)
                                    ->findOrfail($id);
        // dd($payment);
        return view('adm.customers.customer-financial.show-customer-my-payments',
                [
                    'addtocarts' => $addtocarts,
                    'conf' => $conf,
                    'users' => $users,
                    'payment' => $payment,
                    'purchase_status' => $purchase_status,
                ]);
    }

    // Confirmation Order Status - confirmationOrderStatus
    public function confirmationOrderStatus($id = null)
    {
        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();
        $clients = Client::all();

        $customerFreights = CustomerFreights::where('user_id', '=', $user_id)
                            ->where('client_id', '=', $client[0]->id)
                            ->findOrFail($id);

        $customerFreights->confirmation_status = 'entregue';
        $customerFreights->updated_at = now();
        $customerFreights->save();


        return redirect()->back();
    }

    // pix QrCode pra pagamento
    public function qrPixMyPayments($id = null)
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $user_id = Auth::user()->leader_id;
        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);



       // dd($client, $user);

        return view('adm.customers.customer-pix.qr2-code-component', compact('user', 'client', 'conf'));
    }

    // View from customer invoice
    public function reportViewQrPixMyPayments($id = null)
    {

        //gate
         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $user_id = Auth::user()->leader_id;


        $cartproducts = addToCart::where('client_id', '=', $id)->where('user_id', '=', $user_id)
                            ->where('purchase_status_id', '=', 4)->orderByDesc('code')->get();

       $totalcarts = InstallmentClientDetail::where('client_id', '=', $id)
                                ->where('user_id', '=', $user_id)->get();

       $client = Client::with('clientdetail')->findOrfail($id);


       // dd($cartproducts, $totalcarts);

        // configuração da pagina
        $user_id = Auth::user()->leader_id;

        $products = Product::all();


        $user = User::with('Settingsdetail', 'detail', 'settingsdetail', 'installmentClientDetail')->findOrFail($user_id);

        return view('adm.customers.customer-pix.report-view-qr-code-component', [
            'cartproducts' => $cartproducts,
            'totalcarts' => $totalcarts,
            'client' => $client,
            'user' => $user,
            'products' => $products,
            'conf' => $conf,
        ]);
    }

    // View from customer invoice
    public function sendProofMyPayments($id = null)
    {

         // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $user_id = Auth::user()->leader_id;
        $client = Client::findOrFail($id);
        // configuração da pagina
        $user_id = Auth::user()->leader_id;



        return view('adm.customers.customer-financial.add-customer-my-payments', compact('client', 'conf'));
    }

    // form from customer invoice
    public function formSendProofMyPayments(Request $request) : RedirectResponse
    {

          // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $request->validate([
            'imagem' => 'mimes:jpg,png,pdf|max:2048|',
        ]);

        // Data mes e ano
        $data = now();
        $year = date('Y', strtotime($data));
        $month = date('m', strtotime($data));

        $client_doc = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $client_doc)
                            ->where('user_id', '=', $user_id)->get();


        $client_id = $client[0]->id;
        // dd($client, $client[0]->id);

        $customervoucher = new CustomerVoucher();

        //Hasndle File upload
        if($request->hasFile('imagem')){
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

           $ingUrl = 'imagens/customer_vouchers/'.$user_id.'/'.$client_id.'/';

           $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

           $customervoucher->url_voucher = $fileNameToStore;
        } else {
            $customervoucher->url_voucher =  '150x150.png';
        }

        $customervoucher->user_id = $user_id;
        $customervoucher->client_id = $client_id;
        $customervoucher->year = $year;
        $customervoucher->month = $month;
        $customervoucher->save();


        return redirect()->route('customers.customer-financial.customer-my-payments');
    }

    // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->leader_id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    //Gate
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }
}