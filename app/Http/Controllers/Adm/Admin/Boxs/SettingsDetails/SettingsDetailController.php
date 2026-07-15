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

class SettingsDetailController extends Controller
{
    //settings Table
    public function table(): View 
    {

         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $settings = SettingsDetail::all();
        $users = User::all();
        $boots = CorBootstrap::all();
         

        return view('adm.admin.box.setting.table-settings', compact('settings', 'users', 'conf', 'boots'));

    }
    
    //settings New
    public function add(): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
         
        
        return view('adm.admin.box.setting.add-settings', compact('cors', 'users', 'conf', 'boots'));
    }
    
    // Edit
    public function editSettings($id = null): View 
    {

        //gate
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        
        $setting = SettingsDetail::findOrFail($id);
        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
         


        return view('adm.admin.box.setting.edit-settings', compact('setting','cors', 'users', 'conf', 'boots'));

    }
    
    // Show
    public function showSettings($id = null): View 
    {

        //gate
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $setting = SettingsDetail::findOrFail($id);
        
        $cors = Cor::all();
        $users = User::all();
         

        return view('adm.admin.box.setting.show-settings', compact('cors', 'users', 'setting', 'conf'));
    }
    
    // Confirm delete
    public function confDelete($id = null): View 
    {

        //gate
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $setting = SettingsDetail::findOrFail($id);

        $cors = Cor::all();
        $users = User::all();
         

        return view('adm.admin.box.setting.confirm-delete-settings',compact('cors', 'users', 'setting', 'conf'));
    }

    // Created
    public function created(Request $request) : RedirectResponse
    {

        //gate
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'id' => 'required|',
            'user_id' => 'required|',
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
            'user_id.required' => 'Selecione um usuário',
            'cor_id.required' => 'Campo é obrigatório',
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
        

        $setting = new SettingsDetail();
        $setting->user_id = $request->user_id;
        $setting->cor_id = $request->cor_id;
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
        $setting->created_at = now();
        $setting->save();



        return redirect()->route('adm.settings.table-settings');
    }

    //  Updated
    public function updated(Request $request) : RedirectResponse 
    {

        //gate
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
          // dd($request);
        
        $request->validate([
            'id' => 'required|',
            'user_id' => 'required|',
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
            'user_id.required' => 'Selecione um usuário',
            'cor_id.required' => 'Campo é obrigatório',
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
        // dd($request);
        $cor = Cor::findOrFail($request->cor_id);

        $setting = SettingsDetail::findOrFail($request->id);
        $setting->user_id = $request->user_id;
        $setting->cor_id = $request->cor_id;
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

        return redirect()->route('adm.settings.table-settings')->with([
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
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $aces = SettingsDetail::findOrFail($id);
        $aces->delete();
        

        return redirect()->route('adm.settings.settings.table-settings');
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