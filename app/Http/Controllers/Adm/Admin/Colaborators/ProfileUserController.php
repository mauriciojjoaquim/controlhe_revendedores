<?php

namespace App\Http\Controllers\Adm\Admin\Colaborators;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\CorBootstrap;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    public function index(): View
    {
        $colaborator = User::with('detail', 'department')->findOrFail(Auth::user()->id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);
        
        return view('user.profile', compact('colaborator', 'conf'));
    }
    
    public function setting($id = null): View
    {

        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        
        $setting = SettingsDetail::where('user_id','=',$id)->first();
        $cors = Cor::all();
        $boots = CorBootstrap::all();

        // dd($setting);
        
        return view('user.profile-setting', compact('setting', 'conf', 'cors', 'boots'));
    }
    
    public function updatedSetting(Request $request) 
    {

        $request->validate([
            'id' => 'required|',
            'cor_id' => 'required|',
            'pix' => 'required|string|max:250',
            'percentage' => 'required|max:3',
            'installment_number' => 'required|',
            'price' => 'required|decimal:2',
            'minimum_price_for_installment' => 'required|decimal:2',
            'text_color' => 'required|string|max:150',
            'text_color_site' => 'required|string|max:150',
            'color_site_bg' => 'required|string|max:150',
            'bg_color_menu_vertical' => 'required|string|max:150',
            'color_menu_vertical_text' => 'required|string|max:150',
            'bg_color_menu_horisontal' => 'required|string|max:50',
            'color_menu_horisontal_text' => 'required|string|max:150',
            'bg_color_table' => 'required|string|max:150',
            'color_table_text' => 'required|string|max:150',
            'color_card_bg' => 'required|string|max:150',
            'color_card_text' => 'required|string|max:150',
            'color_border' => 'required|string|max:150',
        ],
        [
            'id.required' => 'Selecione um usuário',
            'cor_id.required' => 'Selecione um usuário',
            'pix.required' => 'Campo é obrigatório',
            'percentage.required' => 'Campo é obrigatório',
            'installment_number.required' => 'Campo é obrigatório',
            'price.required' => 'Campo é obrigatório',
            'minimum_price_for_installment.required' => 'Campo é obrigatório',
            'text_color.required' => 'Campo é obrigatório',
            'color_site_bg.required' => 'Campo é obrigatório',
            'text_color_site.required' => 'Campo é obrigatório',
            'bg_color_menu_vertical.required' => 'Campo é obrigatório',
            'color_menu_vertical_text.required' => 'Campo é obrigatório',
            'bg_color_menu_horisontal.required' => 'Campo é obrigatório',
            'color_menu_horisontal_text.required' => 'Campo é obrigatório',
            'bg_color_table.required' => 'Campo é obrigatório',
            'color_table_text.required' => 'Campo é obrigatório',
            'color_card_bg.required' => 'Campo é obrigatório',
            'color_card_text.required' => 'Campo é obrigatório',
            'color_border.required' => 'Campo é obrigatório',
        ]);

        $cor = Cor::findOrFail($request->cor_id);

        $setting = SettingsDetail::findOrFail($request->id);
        $setting->user_id = Auth::user()->id;
        $setting->cor_id = $cor->id;
        $setting->pix = $request->pix;
        $setting->price = $request->price;
        $setting->minimum_price_for_installment = $request->minimum_price_for_installment;
        $setting->percentage = $request->percentage;
        $setting->installment_number = $request->installment_number;
        $setting->bg_color_site = $cor->cor_tag;
        $setting->color_site_bg = $request->color_site_bg;
        $setting->text_color_site = $request->text_color_site;
        $setting->color_card_bg = $request->color_card_bg;
        $setting->color_card_text = $request->color_card_text;
        $setting->bg_color_table = $request->bg_color_table;
        $setting->color_table_text = $request->color_table_text;
        $setting->bg_color_menu_vertical = $request->bg_color_menu_vertical;
        $setting->color_menu_vertical_text = $request->color_menu_vertical_text;
        $setting->bg_color_menu_horisontal = $request->bg_color_menu_horisontal;
        $setting->color_menu_horisontal_text = $request->color_menu_horisontal_text;
        $setting->text_color = $request->text_color;
        $setting->color_border = $request->color_border;
        $setting->updated_at = now();
        $setting->save();

        return redirect()->route('home')->with([
                        'status' => true ,
                        'tipo_alert' => 'success',
                        'icon' => 'fa-regular fa-circle-check',
                        'paricin' => 'text-darck',
                        'mesagem' => 'Foi atualizado a cofiguração com sucesso.',
                    ]);
    }
    
    
    public function updatePassword(Request $request) : RedirectResponse
    {
        // form validation
        $request->validate(
            [
                'current_password' => 'required|min:8|max:16',
                'new_password' => 'required|min:8|max:16|different:current_password',
                'new_password_confirmation' => 'required|same:new_password',
            ]
        );
        $user = Auth::user();

        // rerifica se a senha esta correta
        if(!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Corrent password is incorrect.');
        }

        // atualisar senha no banco de dados
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateUserData(Request $request) : RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|min:4|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            ]
        );

        // update user data
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();


        return redirect()->back()->with('success_change_data', 'User Data updated successfully.');
    }

    public function updateUserDetail(Request $request) : RedirectResponse
    {

        // validator
        $request->validate([
            'address' => 'required|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'bairro' => 'required',
            'user_id' => 'required'
        ]);

        $address = $request->address . " - " . $request->bairro;

        $id = Auth::user()->id;

        $user = User::with('detail')->findOrFail($id);


        $user->detail->zip_code = $request->zip_code;
            $user->detail->address = $request->address; 
            $user->detail->number = $request->number;
            $user->detail->complement = $request->complement;
            $user->detail->neighborhood = $request->neighborhood;
            $user->detail->city = $request->city; 
            $user->detail->phone = $request->phone;  
            $user->detail->salary = $request->salary; 
            $user->detail->admission_date = $request->admission_date; 
        $user->detail->save();



    
        return redirect()->back()->with('success_change_detail', 'User Data updated successfully.');
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
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }
}


/** 
 
        "pix" => "mauriciojjjoaquim+c6@msn.com"
      "price" => "0.00"
      "percentage" => "30"
      "color_site_bg" => "bg-black"
      "text_color_site" => "text-light"
      "bg_color_table" => "table-dark"
      "color_table_text" => "text-light"
      "color_card_bg" => "bg-dark"
      "color_card_text" => "text-light"
      "bg_color_menu_vertical" => "whitepers"
      "color_menu_vertical_text" => "bg-dark"
      "bg_color_menu_horisontal" => "lightseagreen"
      "color_menu_horisontal_text" => "bg-dark"
      "text_color" => "text-light"
      "color_border" => "border-light"
      "bg_color_site" => "whitepers"
      "id" => "1"
  
 
  
 
*/