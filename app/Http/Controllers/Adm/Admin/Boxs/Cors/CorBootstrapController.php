<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\Cors;

use App\Http\Controllers\Controller;
use App\Models\CorBootstrap;
use App\Models\SettingsDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CorBootstrapController extends Controller
{
    //Cors Table
    public function table(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cors = CorBootstrap::all();
         

        return view('adm.admin.box.cor-bootstraps.table-cor-bootstraps', compact('cors', 'conf'));

    }

    //Cors New
    public function add(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

         

        return view('adm.admin.box.cor-bootstraps.add-Cor-bootstraps', compact('conf'));
    }

    //Cors Edit
    public function edit($id = null): View
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cor = CorBootstrap::findOrFail($id);
         


        return view('adm.admin.box.cor-bootstraps.edit-Cor-bootstraps', compact('cor', 'conf'));

    }

    

    // Show
    public function show($id = null): View
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cor = CorBootstrap::findOrFail($id);
         

        return view('adm.admin.box.cor-bootstraps.show-Cor-bootstraps', compact('cor', 'conf'));
    }

    // Confirm delete
    public function confDelete($id = null): View
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cor = CorBootstrap::findOrFail($id);
         

        return view('adm.admin.box.cor-bootstraps.confirm-delete-Cor-bootstraps',compact('cor', 'conf'));
    }

    // Created
    public function created(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin 
        $this->canGate('admin');


        $request->validate([
            'name' => 'required|string|max:150|unique:Cors,name',  
            'color_bg' => 'required|string|max:150|unique:Cors,color_bg',
            'color_table_bg' => 'required|string|max:150|unique:Cors,color_table_bg',
            'color_card_bg' => 'required|string|max:150|unique:Cors,color_card_bg', 
            'color_text' => 'required|string|max:150',
            'color_border' => 'required|string|max:150',
            
        ],
        [
            'name.required' => 'Este campo é obrigatório',
            'name.string' => 'Este campo deve ser texto',
            'name.unique' => 'Já exite este cadastro',

            'color_bg.required' => 'Este campo é obrigatório',
            'color_bg.string' => 'Este campo deve ser texto',
            'color_bg.unique' => 'Já exite este cadastro',

            'color_table_bg.required' => 'Este campo é obrigatório',
            'color_table_bg.string' => 'Este campo deve ser texto',
            'color_table_bg.unique' => 'Já exite este cadastro',
            
            'color_card_bg.required' => 'Este campo é obrigatório',
            'color_card_bg.string' => 'Este campo deve ser texto',
            'color_card_bg.unique' => 'Já exite este cadastro',

            'color_text.required' => 'Este campo é obrigatório',
            'color_text.string' => 'Este campo deve ser texto',
            
            'color_border.required' => 'Este campo é obrigatório',
            'color_border.string' => 'Este campo deve ser texto',

        ]);

        $cor = new CorBootstrap();
        $cor->name = $request->name;
        $cor->color_bg = $request->color_bg;
        $cor->color_table_bg = $request->color_table_bg;
        $cor->color_card_bg = $request->color_card_bg;
        $cor->color_text = $request->color_text;
        $cor->color_border = $request->color_border;
        $cor->save();


        // dd($request);

        return redirect()->route('adm.cor-bootstraps.table-Cor-bootstraps');
    }

    // Updated
    public function updated(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin 
        $this->canGate('admin');


        $request->validate([
            'name' => 'required|string|max:150|unique:Cors,name,id',  
            'color_bg' => 'required|string|max:150|unique:Cors,color_bg,id',
            'color_table_bg' => 'required|string|max:150|unique:Cors,color_table_bg,id',
            'color_card_bg' => 'required|string|max:150|unique:Cors,color_card_bg,id', 
            'color_text' => 'required|string|max:150',
            'color_border' => 'required|string|max:150',
            
        ],
        [
            'name.required' => 'Este campo é obrigatório',
            'name.string' => 'Este campo deve ser texto',
            'name.unique' => 'Já exite este cadastro',

            'color_bg.required' => 'Este campo é obrigatório',
            'color_bg.string' => 'Este campo deve ser texto',
            'color_bg.unique' => 'Já exite este cadastro',

            'color_table_bg.required' => 'Este campo é obrigatório',
            'color_table_bg.string' => 'Este campo deve ser texto',
            'color_table_bg.unique' => 'Já exite este cadastro',
            
            'color_card_bg.required' => 'Este campo é obrigatório',
            'color_card_bg.string' => 'Este campo deve ser texto',
            'color_card_bg.unique' => 'Já exite este cadastro',

            'color_text.required' => 'Este campo é obrigatório',
            'color_text.string' => 'Este campo deve ser texto',
            
            'color_border.required' => 'Este campo é obrigatório',
            'color_border.string' => 'Este campo deve ser texto',

        ]);

        $cor = CorBootstrap::findOrFail($request->id);
        $cor->name = $request->name;
        $cor->color_bg = $request->color_bg;
        $cor->color_table_bg = $request->color_table_bg;
        $cor->color_card_bg = $request->color_card_bg;
        $cor->color_text = $request->color_text;
        $cor->color_border = $request->color_border;
        $cor->save();

        return redirect()->route('adm.cor-bootstraps.table-Cor-bootstraps');

    }

    // Delete
    public function deleted(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin 
        $this->canGate('admin');


        $request->validate([
            'id' => 'required',
        ]);

        $id = $request->id;
        $cor = CorBootstrap::findOrFail($id);
        $cor->delete();


        return redirect()->route('adm.cor-bootstraps.table-Cor-bootstraps');
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