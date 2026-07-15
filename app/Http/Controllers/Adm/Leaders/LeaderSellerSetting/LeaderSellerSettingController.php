<?php

namespace App\Http\Controllers\Adm\Leaders\LeaderSellerSetting;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\CorBootstrap;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LeaderSellerSettingController extends Controller
{
    //settings Table
    public function tableLeaderSettings(): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');

        
        $settings = SettingsDetail::all();
        $users = User::all();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();

        return view('adm.leaders.box-leader-seller.leader-seller-setting.table-leader-seller-settings', compact('settings', 'users', 'conf'));

    }
    
    //settings New
    public function addLeaderSettings(): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized o settings page');

        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();
        
        return view('adm.leaders.box-leader-seller.leader-seller-setting.add-leader-seller-settings', compact('boots', 'cors', 'users', 'conf'));
    }

    //settings Edit
    public function editLeaderSettings($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');

        
        $setting = SettingsDetail::findOrFail($id);
        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();


        return view('adm.leaders.box-leader-seller.leader-seller-setting.edit-leader-seller-settings', compact('boots', 'setting','cors', 'users', 'conf'));

    }
    
    //settings Show
    public function showLeaderSettings($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');
        
        $setting = SettingsDetail::findOrFail($id);
        
        $cors = Cor::all();
        $users = User::all();
        $boots = CorBootstrap::all();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();

        return view('adm.leaders.box-leader-seller.leader-seller-setting.show-leader-seller-settings', compact('boots', 'cors', 'users', 'setting', 'conf'));
                                       
    }
    
    //settings Confirm delete
    public function confDeleteLeaderSettings($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');

        $setting = SettingsDetail::findOrFail($id);

        $cors = Cor::all();
        $users = User::all();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();

        return view('adm.leaders.box-leader-seller.leader-seller-setting.confirm-delete-settings',compact('cors', 'users', 'setting', 'conf'));
    }
    
    //settings Created
    public function createdLeaderSettings(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');
        
        $request->validate([
            'user_id' => 'required|',
            'pix' => 'required|string|max:50',
            'price' => 'required|decimal:2',
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
            'pix.required' => 'Campo é obrigatório',
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
        $setting->price = $request->price;
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


        return redirect()->route('adm.Leaders.leader-seller-setting.table-leader-seller-setting')
                            ->with([
                                'status' => true ,
                                'tipo_alert' => 'success',
                                'icon' => 'fa-regular fa-circle-check',
                                'paricin' => 'text-darck',
                                'mesagem' => 'Foi criado a cofiguração com sucesso.',
                            ]);
    }

    
    
    //settings Updated
    public function updatedLeaderSettings(Request $request) 
    {
        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');
        
        $request->validate([
            // 'user_id' => 'required|',
            'pix' => 'required|string|max:50',
            'price' => 'required|decimal:2',
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
            // 'user_id.required' => 'Selecione um usuário',
            'pix.required' => 'Campo é obrigatório',
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

        // dd($request);
        $cor = Cor::findOrFail($request->cor_id);
        $user_id = Auth::user()->id;

        $setting = SettingsDetail::findOrFail($request->id);
        $setting->user_id = $user_id;
        $setting->cor_id = $request->cor_id;
        $setting->pix = $request->pix;
        $setting->price = $request->price;
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

        return redirect()->route('adm.Leaders.leader-seller-setting.table-leader-seller-setting')
                        ->with([
                            'status' => true ,
                            'tipo_alert' => 'success',
                            'icon' => 'fa-regular fa-circle-check',
                            'paricin' => 'text-darck',
                            'mesagem' => 'Foi atualizado a cofiguração com sucesso.',
                        ]);

    }
    
    

    //settings Delete
    public function deletedLeaderSettings(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to settings page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $aces = SettingsDetail::findOrFail($id);
        $aces->delete();
        

        return redirect()->route('adm.Leaders.leader-seller-setting.table-leader-seller-setting')
                    ->with([
                        'status' => true ,
                        'tipo_alert' => 'success',
                        'icon' => 'fa-regular fa-circle-check',
                        'paricin' => 'text-darck',
                        'mesagem' => 'Foi excluido a cofiguração com sucesso.',
                    ]);
    }
}