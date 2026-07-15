<?php

namespace App\Http\Controllers\Adm\Resellers\ResellerAvataUser;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResellerAvataUserController extends Controller
{
    public function addAvataUser() : View
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.reseller-avata-user.add-reseller-avata-user', [
            'conf' => $conf,
        ]);
    }

    public function editAvataUser($id) : View
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
        $avataUser = User::findOrFail($id);

       
            return view('adm.resellers.reseller-avata-user.edit-reseller-avata-user', [
                'conf' => $conf,
                'avataUser' => $avataUser,
            ]);
    }

    public function createdAvataUser(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:500|',
            'id' => 'required',
        ]);




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
            $fileUrl = 'imagens/photousers/'.$avataUser->id;
            
            $filepath = $file->storeAs($fileUrl,$fileNameToStore);

            $avataUser->avata_user = $fileNameToStore;
         } else {
            if ($avataUser->avata_user == null) {
                $avataUser->avata_user =  'avata-user.png';
            }

         }
         $avataUser->save();

        return redirect()->route('home');
    }
    
    public function updatedAvataUser(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:500|',
            'id' => 'required',
        ]);




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
            $fileUrl = 'imagens/photousers/'.$avataUser->id;
            
            $filepath = $file->storeAs($fileUrl,$fileNameToStore);

            $avataUser->avata_user = $fileNameToStore;
         } else {
            if ($avataUser->avata_user == null) {
                $avataUser->avata_user =  'avata-user.png';
            }

         }
         $avataUser->save();

        return redirect()->route('home');
    }
    
}