<?php

namespace App\Http\Controllers\Adm\Admin\Customers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientDetail;
use App\Models\ClientOrderDetail;
use App\Models\SettingsDetail;
use App\Models\User;
use App\Models\Verification\CustomerBasedVerification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdmCustomersController extends Controller
{

    use Notifiable;
    use SoftDeletes;

    //clients Table
    public function tableCustomer(): View
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');


        $clients = Client::with('clientdetail', 'clientorderdetail')
                               ->get();

        $users = User::all();
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view( 'adm.admin.customers.customer.table-customers', compact('conf', 'clients', 'users'));

    }

    //clients New
    public function addCustomer(): View
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o clients page');

        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.admin.customers.customer.add-customers', compact('conf'));
    }
    
    //clients Edit
    public function editCustomer($id): View
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');


        $client = Client::with('clientdetail')
                        ->findOrFail($id);

        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.admin.customers.customer.edit-customers', compact('conf', 'client'));

    }
    
    //clients Show
    public function showCustomer($id): View
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($id);

        $clientordendetails = ClientOrderDetail::all();
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        $users = User::all();

        return view('adm.admin.customers.customer.show-customers', compact('conf', 'client', 'clientordendetails', 'users'));
    }
    
    //clients Confirm delete
    public function confDeleteCustomer($id): View
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $client = Client::where('user_id', '=', Auth::user()->id)->findOrFail($id);
                $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('dealers.clients.client.confirm-delete-clients', compact('conf', 'client'));
    }

    //clients Created
    public function createdCustomer(Request $request)
    {
        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $cpf = $request->cpf;

        $this->validaCPF($cpf);

        if($this->validaCPF($cpf) == false){
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Verifique o CPF inconsistência no numeros!',
            ]);
        }


        $request->validate([
            'name' => 'required|string|max:140|unique:clients,name',
            'email' => 'required|email|max:140|unique:clients,email',
            'cpf' => 'required|string|max:20|unique:clients,cpf',
            'zip_code' => 'required|string|max:140|',
            'address' => 'required|string|max:140|',
            'number' => 'required|string|max:140|',
            // 'complement' => 'required|string|max:140|',
            'neighborhood' => 'required|string|max:140|',
            'city' => 'required|string|max:140|',
            'phone' => 'required|string|max:140|',

        ]);

        $cusbv = new CustomerBasedVerification();
        $cusbv->user_id = Auth::user()->id;
        $cusbv->name = $request->name;
        $cusbv->situation = 'NC';
        $cusbv->email = $request->email;
        $cusbv->cpf = $request->cpf;
        $cusbv->save();

        // create details user
        $cusbv->customerBasedVerificationDetail()->create([
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'phone' => $request->phone,
            'register_date' => now(),
        ]);


        $client = new Client();
        $client->user_id = Auth::user()->id;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->cpf = $request->cpf;
        $client->save();


        // create details user
        $client->clientdetail()->create([
            'zip_code' => $request->zip_code,
            'address' => $request->address,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'phone' => $request->phone,
            'register_date' => now(),
        ]);

        $client->clientorderdetail()->create([
            'user_id' => Auth::user()->id,
            'total_price' => '0.00',
            'number_of_installments' => 0,
            'price_per_installment' => '0.00',
            'installments_paid' => 0,
            'quantity_product' => 0,
            'installment_due_date' => null,
            'installment_payment_date' => null,
        ]);




        return redirect()->route('adm.customers.customer.table-customers');
    }

    //clients Updated
    public function updatedCustomer(Request $request)
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $cpf = $request->cpf;

        $this->validaCPF($cpf);
        if($this->validaCPF($cpf) == false){
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Verifique o CPF inconsistência no numeros!',
            ]);
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


        $client = Client::findOrFail($id);
        $client->user_id = Auth::user()->id;
        $client->name = $request->name;
        $client->email = $request->email;
        $client->cpf = $request->cpf;
        $client->save();


        // create details user
        $clientdetail = ClientDetail::where('client_id','=',$id)->first();
            $clientdetail->zip_code = $request->zip_code;
            $clientdetail->address = $request->address;
            $clientdetail->number = $request->number;
            $clientdetail->complement = $request->complement;
            $clientdetail->neighborhood = $request->neighborhood;
            $clientdetail->city = $request->city;
            $clientdetail->phone = $request->phone;
            $clientdetail->save();



        return redirect()->route('adm.customers.customer.table-customers');

    }

    //clients Delete
    public function deletedCustomer(Request $request)
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;

        $client = Client::with('clientdetail', 'clientorderdetail')
                            ->where('user_id', '=', Auth::user()->id)
                            ->findOrFail($id);
        $client->delete();


        return redirect()->route('adm.customers.customer.table-customers');
    }

    // Validação do cpf
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