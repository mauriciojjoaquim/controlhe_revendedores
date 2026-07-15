<?php

namespace App\Http\Controllers\Adm\Customers\CustomerProofPayment;

use App\Http\Controllers\Controller;
use App\Models\AddToCart\CustomerVoucher;
use App\Models\Client;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProofPaymentController extends Controller
{

    //categories Table
    public function tableProofPayment(): View
    {

        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();
        $users = User::all();

        $proofPayments = CustomerVoucher::withTrashed()->where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->get();


        // configuração da pagina
        $user_id = Auth::user()->leader_id;


        return view('adm.customers.customer-proof-payment.table-customer-proof-payment', compact('users', 'proofPayments', 'conf'));

    }

    //categories New
    public function addCategory(): View
    {

        //gate
        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        return view('adm.customers.customer-proof-payment.tadd-customer-proof-payment', \compact('conf'));
    }

    //categories Edit
    public function editProofPayment($id = null): View
    {

        //gate
        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

         // my user
         $document = Auth::user()->document;
         $user_id = Auth::user()->leader_id;
         $client = Client::where('cpf', '=', $document)->withTrashed()->get();
         $users = User::all();

         $proofPayment = CustomerVoucher::where('user_id', '=', $user_id)
                                 ->where('client_id', '=', $client[0]->id)
                                 ->findOrFail($id);


        return view('adm.customers.customer-proof-payment.edit-customer-proof-payment', compact('proofPayment', 'conf'));

    }



    //categories Show
    public function showProofPayment($id = null): View
    {

        //gate
        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();
        $users = User::all();

        $proofPayment = CustomerVoucher::where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->withTrashed()
                                ->findOrFail($id);


        // configuração da pagina
        $user_id = Auth::user()->leader_id;


        return view('adm.customers.customer-proof-payment.show-customer-proof-payment', compact('users', 'proofPayment', 'conf'));
    }

    //categories Confirm delete
    public function confDeleteProofPayment($id = null): View
    {

        //gate
        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // my user
        $document = Auth::user()->document;
        $user_id = Auth::user()->leader_id;
        $client = Client::where('cpf', '=', $document)->get();
        $users = User::all();

        $proofPayment = CustomerVoucher::where('user_id', '=', $user_id)
                                ->where('client_id', '=', $client[0]->id)
                                ->findOrFail($id);


        // configuração da pagina
        $user_id = Auth::user()->leader_id;


        return view('adm.customers.customer-proof-payment.confirm-delete-customer-proof-payment',compact('proofPayment', 'conf'));
    }

    //categories Created
    public function createdProofPayment(Request $request) : RedirectResponse
    {

        //gate
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

        $user_id = Auth::user()->leader_id;
        $client_id = $request->client_id;

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

           $customervoucher->url_voucher = $path;
        } else {
            $customervoucher->url_voucher =  '150x150.png';
        }
        $customervoucher->user_id = $user_id;
        $customervoucher->client_id = $client_id;
        $customervoucher->year = $year;
        $customervoucher->month = $month;
        $customervoucher->save();

        return redirect()->route('adm.customers.customer-proof-payment.table-customer-proof-payment');
    }

    //categories Updated
    public function updatedProofPayment(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'category' => 'mimes:jpg,png,pdf|max:2048|',
            'id' => 'required',
            'client_id' => 'required',
        ]);


         // Data mes e ano
         $data = now();
         $year = date('Y', strtotime($data));
         $month = date('m', strtotime($data));

         $user_id = Auth::user()->leader_id;
         $client_id = $request->client_id;

         $customervoucher = CustomerVoucher::where('user_id', '=', $user_id)
                ->where('client_id', '=', $client_id)
                ->findOrFail($request->id);


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

            $customervoucher->url_voucher = $path;
         } else {
            if ($customervoucher->url_voucher == null) {
                $customervoucher->url_voucher =  '150x150.png';
            }

         }
         $customervoucher->user_id = $user_id;
         $customervoucher->client_id = $client_id;
         $customervoucher->year = $year;
         $customervoucher->month = $month;
         $customervoucher->save();

        return redirect()->route('adm.customers.customer-proof-payment.table-customer-proof-payment');

    }

    //categories Delete
    public function deletedProofPayment(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'id' => 'required'
        ]);

        $user_id = Auth::user()->leader_id;
         $client_id = $request->client_id;

         $customervoucher = CustomerVoucher::where('user_id', '=', $user_id)
                ->where('client_id', '=', $client_id)
                ->findOrFail($request->id);
        $customervoucher->delete();


        return redirect()->route('adm.customers.customer-proof-payment.table-customer-proof-payment');
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