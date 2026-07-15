<?php

namespace App\Http\Controllers\Adm\Admin\Colaborators;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColaboratorController extends Controller
{

    // home
    public function home() : View
    {
        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $iduser = Auth::user()->id;
        $colaborator = User::withTrashed()
        ->with('detail', 'department')
        ->where('id', $iduser)
        ->first();
         

        return view('colaborators.colaborator.show-detail', compact('colaborator', 'conf'));

    }

    // table
    public function table() : View
    {
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $colaborators = User::withTrashed()
                                ->with('detail', 'department')
                                ->where('role', '<>', 'admin')
                                ->get();
                                
          

        return view('colaborators.colaborator.colaborator', compact('colaborators', 'conf'));
    }

    // show
    public function show($id = null) : View|RedirectResponse
    {
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        if(Auth::user()->id === $id){
            return redirect()->route('home');
        }

        $colaborator = User::with('detail', 'department')
                                ->where('id', '=', $id)
                                ->first();
                                

        if($colaborator) {
            abort(404);
        }
         

        return view('colaborators.colaborator.detail-colaborator', compact('colaborator', 'conf'));
    }

    // conf delete
    public function confDelete($id = null) : View|RedirectResponse
    {
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        if(Auth::user()->id === $id){
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);
         

        return view('colaborators.colaborator.confirm-delete-colaborator', compact('colaborator', 'conf'));
    }

    // restere
    public function restore($id) : RedirectResponse
    {
        //gate
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $colaborator = User::withTrashed()
                            ->with('detail')
                            ->where('role', 'rh')
                            ->findOrFail($id);
        $colaborator->restore();
         


        return redirect()->route('colaborators.colaborator.colaborators', 'conf')->with('success', 'Colaborator restored successfully');

    }

    // deleted
    public function deleted(Request $request) : RedirectResponse
    {
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        if(Auth::user()->id === $request->id){
            return redirect()->route('home');
        }

        $colaborator = User::with('detail')->findOrFail($request->id);

        $colaborator->delete();

        return redirect()->route('colaborators.colaborator.colaborators');
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