<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\Cors;

use App\Http\Controllers\Controller;
use App\Models\Cor;
use App\Models\SettingsDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CorController extends Controller
{
    //Cors Table
    public function table(): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cors = Cor::all();
         

        return view('adm.admin.box.cors.table-cors', compact('cors', 'conf'));

    }
    
    //Cors New
    public function add(): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
         

        return view('adm.admin.box.cors.add-Cors', compact('conf'));
    }
    
    //Cors Edit
    public function edit($id = null): View 
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cor = Cor::findOrFail($id);
         


        return view('adm.admin.box.cors.edit-Cors', compact('cor', 'conf'));

    }
    
    //Cors Show
    public function show($id = null): View 
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $cor = Cor::findOrFail($id);
         

        return view('adm.admin.box.cors.show-cors', compact('cor', 'conf'));
    }
    
    //Cors Confirm delete
    public function confDelete($id = null): View 
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cor = Cor::findOrFail($id);
         

        return view('adm.admin.box.cors.confirm-delete-cors',compact('cor', 'conf'));
    }

    //Cors Created
    public function created(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin 
        $this->canGate('admin');

        
        $request->validate([
            'cor_name_br' => 'required|string|max:40|unique:Cors',
            'cor_tag' => 'required|string|max:40|unique:Cors',
            'text_cor' => 'required|string|max:40',
        ],
        [
            'cor_name_br.required' => 'Este campo é obrigatório',
            'cor_name_br.string' => 'Este campo deve ser texto',
            'cor_name_br.unique' => 'Já exite este cadastro',
            
            'cor_tag.required' => 'Este campo é obrigatório',
            'cor_tag.string' => 'Este campo deve ser texto',
            'cor_tag.unique' => 'Já exite este cadastro',
            
            'text_cor.required' => 'Este campo é obrigatório',
            'text_cor.string' => 'Este campo deve ser texto',
            'text_cor.unique' => 'Já exite este cadastro',
        ]);

        $cor = new Cor();
        $cor->cor_name_br = $request->cor_name_br; 
        $cor->cor_tag = $request->cor_tag; 
        $cor->text_cor = $request->text_cor; 
        $cor->save();
        

        // dd($request);

        return redirect()->route('adm.cors.table-cors');
    }

    // Updated
    public function updated(Request $request) : RedirectResponse 
    {

        //gate
        // Gate admin 
        $this->canGate('admin');
 
        
        $request->validate([
            'cor_name_br' => 'required|string|max:40|unique:Cors,id',
            'cor_tag' => 'required|string|max:40|unique:Cors,id',
            'text_cor' => 'required|string|max:40',
            'id' => 'required',
        ],
        [
            'cor_name_br.required' => 'Este campo é obrigatório',
            'cor_name_br.string' => 'Este campo deve ser texto',
            'cor_name_br.unique' => 'Já exite este cadastro',
            
            'cor_tag.required' => 'Este campo é obrigatório',
            'cor_tag.string' => 'Este campo deve ser texto',
            'cor_tag.unique' => 'Já exite este cadastro',
            
            'text_cor.required' => 'Este campo é obrigatório',
            'text_cor.string' => 'Este campo deve ser texto',
            'text_cor.unique' => 'Já exite este cadastro',

            'id.required' => 'Este campo é obrigatório',
        ]);

        $cor = Cor::findOrFail($request->id);
        $cor->cor_name_br = $request->cor_name_br; 
        $cor->cor_tag = $request->cor_tag; 
        $cor->text_cor = $request->text_cor; 
        $cor->save();

        return redirect()->route('adm.cors.table-cors');

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
        $cor = Cor::findOrFail($id);
        $cor->delete();
        

        return redirect()->route('adm.cors.table-cors');
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