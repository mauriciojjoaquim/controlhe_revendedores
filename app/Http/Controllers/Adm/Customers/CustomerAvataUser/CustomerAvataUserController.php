<?php

namespace App\Http\Controllers\Adm\Customers\CustomerAvataUser;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\Verification\CustomerBasedVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CustomerAvataUserController extends Controller
{
    public function addAvataUser() : View
    {
         // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

 
 
 


        return view('adm.customers.customer-avata-user.add-customer-avata-user', [
            'conf' => $conf,
        ]);
    }

    public function editAvataUser($id = null) : View
    {
         // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         


        $document = Auth::user()->document;
        
 
 
 
        $avataUser = User::findOrFail($id);


        return view('adm.customers.customer-avata-user.edit-customer-avata-user', [
            'conf' => $conf,
            'avataUser' => $avataUser,
        ]);
    }

    public function createdAvataUser(Request $request) : RedirectResponse
    {
         // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:500|',
            'id' => 'required',
        ]);

        $userDoc = Auth::user()->document;
        
        $client = Client::where('cpf', '=', $userDoc)->get();
        $clientbd = CustomerBasedVerification::where('cpf', '=', $userDoc)->get();
        $avataUser = User::findOrFail($request->id);


         //Hasndle File upload
         if($request->hasFile('imagem')){
            
            // Get filename with the extensuon
            $file = $request->file('imagem');
                
            $name = $file->hashName(); 
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = $file->extension(); 
            $new_str = str_replace(' ', '_', $filename);
            $fileNameToStore = $new_str .'_'.time().'.'. $extension;
            $fileUrl = 'imagens/photocustomers/'.$avataUser->id;
            
            $filepath = $file->storeAs($fileUrl,$fileNameToStore);
        
            if($avataUser->count() != 0) {
                $avataUser->avata_user = $fileNameToStore;
            }
            
            $client->avata_user = $fileNameToStore;
            $clientbd->avata_user = $fileNameToStore;
         } else {
            if ($avataUser->avata_user == null && $avataUser->count() != 0) {
                $avataUser->avata_user =  'avata-user.png';

            }
            if ($client->avata_user == null) {
                $client->avata_user =  'avata-user.png';

            }
            if ($clientbd->avata_user == null) {
                $clientbd->avata_user =  'avata-user.png';
            }

         }
         $avataUser->save();
         $client->save();
         $clientbd->save();

        return redirect()->route('home');
    }

    public function updatedAvataUser(Request $request) : RedirectResponse
    {
         // Gate admin 
        $this->canGate('client');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:500|',
            'id' => 'required',
        ]);


        $userDoc = Auth::user()->document;
        
        $client = Client::where('cpf', '=', $userDoc)->get();
        $clientbd = CustomerBasedVerification::where('cpf', '=', $userDoc)->get();
        $avataUser = User::findOrFail($request->id);

            
             //Hasndle File upload
         if($request->hasFile('imagem')){
            
            // Get filename with the extensuon
            $file = $request->file('imagem');
                
            $name = $file->hashName(); 
            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = $file->extension(); 
            $new_str = str_replace(' ', '_', $filename);
            $fileNameToStore = $new_str .'_'.time().'.'. $extension;
            $fileUrl = 'imagens/photocustomers/'.$avataUser->id;
            
            $filepath = $file->storeAs($fileUrl,$fileNameToStore);
        
            if($avataUser->count() != 0) {
                $avataUser->avata_user = $fileNameToStore;
            }
            
            $client->avata_user = $fileNameToStore;
            $clientbd->avata_user = $fileNameToStore;
         } else {
            if ($avataUser->avata_user == null && $avataUser->count() != 0) {
                $avataUser->avata_user =  'avata-user.png';

            }
            if ($client->avata_user == null) {
                $client->avata_user =  'avata-user.png';

            }
            if ($clientbd->avata_user == null) {
                $clientbd->avata_user =  'avata-user.png';
            }

         }
         $avataUser->save();
         $client->save();
         $clientbd->save();

        return redirect()->route('home');
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