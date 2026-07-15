<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\SettingsDetails;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\CorBootstrap;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SettingsDetailResellersController extends Controller
{
    // Table
    public function table(): View 
    {

        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        
        $settings = SettingsDetail::all();
        $users = User::all();
 

        return view('adm.resellers.box-reseller.reseller-setting.table-settings', compact('settings', 'users', 'conf'));

    }
    
    // Add
    public function add(): View 
    {

        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
 
        
        return view('adm.resellers.box-reseller.reseller-setting.add-settings', compact('boots', 'cors', 'users', 'conf'));
    }

    // Edit
    public function edit($id = null): View 
    {

        //gate
        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        
        $setting = SettingsDetail::findOrFail($id);
        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
 


        return view('adm.resellers.box-reseller.reseller-setting.edit-settings', compact('boots', 'setting','cors', 'users', 'conf'));

    }
 
    // Show
    public function showVendeSettings($id = null): View 
    {

        //gate
        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $setting = SettingsDetail::findOrFail($id);
        
        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
 

        return view('adm.resellers.box-reseller.reseller-setting.show-settings', compact('boots', 'cors', 'users', 'setting', 'conf'));
                                       
    }
    
    // Confirm delete
    public function confDelete($id = null): View 
    {

        //gate
        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $setting = SettingsDetail::findOrFail($id);

        $cors = Cor::all();
        $users = User::all();
 

        return view('adm.resellers.box-reseller.reseller-setting.confirm-delete-settings',compact('cors', 'users', 'setting', 'conf'));
    }

    // Created
    public function createdVendeSettings(Request $request) : RedirectResponse
    {

        //gate
        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'user_id' => 'required|',
            'pix' => 'required|string|max:50',
            // 'price' => 'required|decimal:2',
            'percentage' => 'required|max:3',
            // 'bg_color_site' => 'required|string|max:50',
            'color_site_bg' => 'required|string|max:50',
            'color_site_bg' => 'required|string|max:50',
            'text_color_site' => 'required|string|max:50',
            'color_card_bg' => 'required|string|max:50',
            'color_card_text' => 'required|string|max:50',
            'bg_color_table' => 'required|string|max:50',
            'color_table_text' => 'required|string|max:50',
            'bg_color_menu' => 'required|string|max:50',
            'color_menu_vertical_text' => 'required|string|max:50',
            'color_border' => 'required|string|max:50',
            'text_color' => 'required|string|max:50', 
            'cor_id' => 'required|',
        ],
        [
            'user_id.required' => 'Selecione um usuário',
            // 'pix.required' => 'Campo é obrigatório',
            'price.required' => 'Campo é obrigatório',
            'bg_color_table.required' => 'Campo é obrigatório',
            // 'bg_color_site.required' => 'Campo é obrigatório',
            'color_site_bg.required' => 'Campo é obrigatório',
            'color_card_bg.required' => 'Campo é obrigatório',
            'color_site_bg.required' => 'Campo é obrigatório',
            'bg_color_menu.required' => 'Campo é obrigatório',
            'color_menu_vertical_text.required' => 'Campo é obrigatório',
            'text_color_site.required' => 'Campo é obrigatório',
            'color_table_text.required' => 'Campo é obrigatório',
            'text_color.required' => 'Campo é obrigatório',
            'color_border.required' => 'Campo é obrigatório',
            'percentage.required' => 'Campo é obrigatório',
            'color_card_text.required' => 'Campo é obrigatório',
            'cor_id' => 'Campo é obrigatório',
        ]);

        $cor = Cor::findOrFail($request->cor_id);
        $user_id = Auth::user()->id;

        
        $setting = new SettingsDetail();
        $setting->user_id = $user_id;
        $setting->cor_id = $request->cor_id;
        $setting->pix = $request->pix;
        // $setting->price = $request->price;
        $setting->percentage = $request->percentage;
        $setting->bg_color_site = $cor->cor_tag;
        $setting->color_site_bg = $request->color_site_bg;
        $setting->text_color_site = $request->text_color_site;
        $setting->color_card_bg = $request->color_card_bg;
        $setting->color_card_text = $request->color_card_text;
        $setting->bg_color_table = $request->bg_color_table;
        $setting->color_table_text = $request->color_table_text;
        $setting->bg_color_menu = $request->bg_color_menu;
        $setting->color_menu_vertical_text = $request->color_menu_vertical_text;
        $setting->text_color = $request->text_color;
        $setting->color_border = $request->color_border;
        $setting->save();


        return redirect()->route('adm.settings-resellers.table-vende-settings')
                            ->with([
                                'status' => true ,
                                'tipo_alert' => 'success',
                                'icon' => 'fa-regular fa-circle-check',
                                'paricin' => 'text-darck',
                                'mesagem' => 'Foi criado a cofiguração com sucesso.',
                            ]);
    }
    
    //settings Updated
    public function updated(Request $request) : RedirectResponse
    {
        //gate
        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        // dd($request);
        $request->validate([
            // 'user_id' => 'required|',
            'pix' => 'required|string|max:50',
            // 'price' => 'required|decimal:2',
            'minimum_price_for_installment' => 'required|decimal:2',
            'percentage' => 'required|max:3',
            'installment_number' => 'required|max:3',
            // 'bg_color_site' => 'required|string|max:50',
            'color_site_bg' => 'required|string|max:50',
            'text_color_site' => 'required|string|max:50',
            'color_card_bg' => 'required|string|max:50',
            'color_card_text' => 'required|string|max:50',
            'bg_color_table' => 'required|string|max:50',
            'color_table_text' => 'required|string|max:50',
            'bg_color_menu' => 'required|string|max:50',
            'color_menu_vertical_text' => 'required|string|max:50',
            'color_border' => 'required|string|max:50',
            'text_color' => 'required|string|max:50', 
            'cor_id' => 'required|',
            'id' => 'required|',
        ],
        [
            // 'user_id.required' => 'Selecione um usuário',
            'pix.required' => 'Campo é obrigatório',
            // 'price.required' => 'Campo é obrigatório',
            'minimum_price_for_installment.required' => 'Campo é obrigatório',
            'bg_color_table.required' => 'Campo é obrigatório',
            // 'bg_color_site.required' => 'Campo é obrigatório',
            'color_site_bg.required' => 'Campo é obrigatório',
            'color_card_bg.required' => 'Campo é obrigatório',
            'bg_color_menu.required' => 'Campo é obrigatório',
            'color_menu_vertical_text.required' => 'Campo é obrigatório',
            'text_color_site.required' => 'Campo é obrigatório',
            'color_table_text.required' => 'Campo é obrigatório',
            'text_color.required' => 'Campo é obrigatório',
            'color_border.required' => 'Campo é obrigatório',
            'percentage.required' => 'Campo é obrigatório',
            'installment_number.required' => 'Campo é obrigatório',
            'color_card_text.required' => 'Campo é obrigatório',
            'cor_id' => 'Campo é obrigatório',
        ]);

        // dd($request);
        $cor = Cor::findOrFail($request->cor_id);
        $user_id = Auth::user()->id;

        $setting = SettingsDetail::findOrFail($request->id);
        $setting->user_id = $user_id;
        $setting->cor_id = $request->cor_id;
        $setting->pix = $request->pix;
        // $setting->price = $request->price;
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
        $setting->bg_color_menu = $request->bg_color_menu;
        $setting->color_menu_vertical_text = $request->color_menu_vertical_text;
        $setting->text_color = $request->text_color;
        $setting->color_border = $request->color_border;
        $setting->save();

        return redirect()->route('adm.settings-resellers.table-vende-settings')
                        ->with([
                            'status' => true ,
                            'tipo_alert' => 'success',
                            'icon' => 'fa-regular fa-circle-check',
                            'paricin' => 'text-darck',
                            'mesagem' => 'Foi atualizado a cofiguração com sucesso.',
                        ]);

    }

    //settings Delete
    public function deleted(Request $request) : RedirectResponse 
    {

        //gate
        // Gate Vende
        $this->canGate('vende');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $aces = SettingsDetail::findOrFail($id);
        $aces->delete();
        

        return redirect()->route('adm.settings-resellers.table-vende-settings')
                    ->with([
                        'status' => true ,
                        'tipo_alert' => 'success',
                        'icon' => 'fa-regular fa-circle-check',
                        'paricin' => 'text-darck',
                        'mesagem' => 'Foi excluido a cofiguração com sucesso.',
                    ]);
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
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to customerstockdetail page');
    }
}