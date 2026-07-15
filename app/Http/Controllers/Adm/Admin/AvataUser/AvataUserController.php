<?php

namespace App\Http\Controllers\Adm\Admin\AvataUser;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class AvataUserController extends Controller
{
    public function add() : View
    {


        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        return view('adm.admin.avata-user.add-avata-user', [
            'conf' => $conf,
        ]);
    }

    public function edit($id = null) : View
    {

        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        $avataUser = User::findOrFail($id);


            return view('adm.admin.avata-user.edit-avata-user', [
                'conf' => $conf,
                'avataUser' => $avataUser,
            ]);
    }

    public function created(Request $request) : RedirectResponse
    {
        //gate
        // Auth::user()->can('admin') ?: abort(403, 'You are not authorized to invoices page');

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

    public function updated(Request $request) : RedirectResponse
    {


        $request->validate([
            'imagem' => 'mimes:jpg,png|max:500|',
            'id' => 'required',
        ]);




         $avataUser = User::findOrFail($request->id);


         //Hasndle File upload
         if($request->hasFile('imagem')){

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

    // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    //Gate
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to page');
    }

}