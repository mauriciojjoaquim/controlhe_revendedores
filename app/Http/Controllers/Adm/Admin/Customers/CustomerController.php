<?php

namespace App\Http\Controllers\Adm\Admin\Customers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientDetail;
use App\Models\ClientOrdenDetail;
use App\Models\ClientOrderDetail;
use App\Models\SettingsDetail;
use App\Models\User;
use App\Models\AddToCart\AddToCart;
use App\Models\Verification\CustomerBasedVerification;
use App\Models\Verification\CustomerBasedVerificationDetail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerController extends Controller
{
    
    use Notifiable;
    use SoftDeletes;
    
    //clients Table
    public function tableClient(): View 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $clients = Client::all();
        $users = User::all();
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.customers.customer.table-customers', compact('clients', 'users', 'conf'));

    }

    //clients New
    public function addClient(): View 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o clients page');
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.customers.customer.add-customers', compact('conf'));
    }
    
    //clients Edit
    public function editClient($id): View 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        
        $client = Client::with('clientdetail')->findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);


        return view('adm.customers.customer.edit-customers', compact('client', 'conf'));

    }
    
    //clients Created
    public function createdClient(Request $request) 
    {
        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');
        $cpf = $request->cpf;
        
        $this->validaCPF($cpf); 
        if($this->validaCPF($cpf) == false){
            return redirect()->back();
        }


        $request->validate([
            'name' => 'required|string|max:140|unique:clients,name',
            'email' => 'required|string|max:140|unique:clients,email',  
            'cpf' => 'required|string|max:20|unique:clients,cpf', 
            'zip_code' => 'required|string|max:140|', 
            'address' => 'required|string|max:140|', 
            'number' => 'required|string|max:140|', 
            'complement' => 'required|string|max:140|', 
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
        $cusbv->customerBasedVerificationdetail()->create([
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
            

        return redirect()->route('adm.customers.table-customers');
    }

    //clients Updated
    public function updatedClient(Request $request) 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

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

        $cusbv = CustomerBasedVerification::findOrFail($id);   
        $cusbv->user_id = Auth::user()->id;
        $cusbv->situation = 'NC';
        $cusbv->name = $request->name;
        $cusbv->email = $request->email;  
        $cusbv->cpf = $request->cpf;
        $cusbv->save();

        $cusbvdetail = CustomerBasedVerificationDetail::where('client_id','=',$id)->first(); 
        $cusbvdetail->zip_code = $request->zip_code; 
        $cusbvdetail->address = $request->address; 
        $cusbvdetail->number = $request->number;
        $cusbvdetail->complement = $request->complement;
        $cusbvdetail->neighborhood = $request->neighborhood;
        $cusbvdetail->city = $request->city;
        $cusbvdetail->phone = $request->phone;
        $cusbvdetail->save();

        

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

            

        return redirect()->route('adm.customers.table-customers');

    }
    
    //clients Show
    public function showClient($id): View 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');
        
        $client = Client::with('user', 'clientdetail', 'clientorderdetail')->findOrFail($id);
        $clientordendetails = ClientOrderDetail::all();
        $addcards = AddToCart::all();
        $conf = SettingsDetail::findOrFail(Auth::user()->id);
        
        return view('adm.customers.customer.show-customers', compact('addcards', 'client', 'clientordendetails', 'conf'));
    }
    
    //clients Confirm delete
    public function confDeleteClient($id): View 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');

        $client = Client::findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('adm.customers.customer.confirm-delete-customers',compact('client', 'conf'));
    }

    //clients Delete
    public function deletedClient(Request $request) 
    {

        //gate
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized to clients page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        
        $client = Client::with('clientdetail', 'clientordendetail')->findOrFail($id);
        $client->delete();
        

        return redirect()->route('adm.customers.table-customers');
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