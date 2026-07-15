<?php

namespace App\Http\Controllers\Adm\Resellers\Reseller;

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

class ResellersCustomersController extends Controller
{

    use Notifiable;
    use SoftDeletes;

    //clients Table
    public function tableClient(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');


        $clients = Client::with('clientdetail', 'clientorderdetail')
                                ->where('user_id', '=', Auth::user()->id)
                                ->get();

        $users = User::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller.table-reseller', compact('conf', 'clients', 'users'));

    }

    //clients New
    public function addClient(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o clients page');

        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller.add-reseller', compact('conf'));
    }

    //clients Edit
    public function editClient($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');


        $client = Client::with('clientdetail')
                        ->where('user_id', '=', Auth::user()->id)
                        ->findOrFail($id);

         // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller.edit-reseller', compact('conf', 'client'));

    }

    //clients Confirm delete
    public function confDeleteClient($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $client = Client::where('user_id', '=', Auth::user()->id)->findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller.confirm-delete-reseller', compact('conf', 'client'));
    }

    //clients Show
    public function showClient($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($id);

        $clientordendetails = ClientOrderDetail::all();
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        $users = User::all();

        return view('adm.resellers.reseller.show-reseller', compact('conf', 'client', 'clientordendetails', 'users'));
    }

    public function onlineClient($id)
    {
         //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');


        $client = Client::with('clientorderdetail', 'clientdetail')->findOrFail($id);

        $id_user = Auth::user()->id;
        
        $userVer = User::where('document', '=', $client->cpf)->get();


        
        if($userVer->count() > 0) {
            return redirect()->route('adm.resellers.table-resellers')->with([
                'status' => true,
                'tipo_alert' => 'success',
                'icon' => 'fas fa-check-circle',
                'paricin' => 'text-dark',
                'mesagem' => 'Este Cliente já está liberado para acesso Online!',
            ]);
        }

         // create new RH
         $user = new User();
         $user->leader_id = $id_user;
         $user->name = $client->name;
         $user->document = $client->cpf;
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
   

        return redirect()->route('adm.resellers.table-resellers')
                                        ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este Cliente está liberado para acesso Online!',
                                        ]);

    }

    //clients Created
    public function createdClient(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

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
        $cusbv->situation = 'NC';
        $cusbv->name = $request->name;
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




        return redirect()->route('adm.resellers.table-resellers');
    }

    //clients Updated
    public function updatedClient(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

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



        return redirect()->route('adm.resellers.table-resellers');

    }
    
    //clients Delete
    public function deletedClient(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;

        $client = Client::with('clientdetail', 'clientorderdetail')
                            ->where('user_id', '=', Auth::user()->id)
                            ->findOrFail($id);
        $client->delete();


        return redirect()->route('adm.resellers.table-resellers');
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