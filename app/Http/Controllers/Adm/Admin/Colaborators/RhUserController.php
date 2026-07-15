<?php

namespace App\Http\Controllers\Adm\Admin\Colaborators;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmAccountEmail;
use App\Models\Access;
use App\Models\Department;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RhUserController extends Controller
{
    public function table() : View
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $colaborators = User::with('detail')
                    ->withTrashed()
                    ->where('role', '=', 'rh')
                    ->get();
                    
          

        return view('colaborators.rh.rh-user', compact('colaborators', 'conf'));
    }

    public function add() : View
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $departments = Department::all();
        $access = Access::all();
         

        return view('colaborators.rh.add-rh-user', compact('departments', 'access', 'conf'));
    }

    
    // Edit
    public function edit($id = null) : View
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $departments = Department::all();
        $access = Access::all();
        $colaborator = User::withTrashed()
                        ->with('detail')
                        ->where('role', 'rh')
                        ->findOrFail($id);

         

        return view('colaborators.rh.edit-rh-user', compact(['colaborator', 'departments', 'access', 'conf']));
    }

    
    // Conf Delete
    public function confDelete($id = null) : View
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        // create new RH
        $colaborator = User::findOrFail($id);
         

        return view('colaborators.rh.delete-rh-user', compact('colaborator', 'conf'));
    }
    
    // Restore
    public function restore($id = null) : RedirectResponse
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $colaborator = User::withTrashed()
                            ->with('detail')
                            ->where('role', 'rh')
                            ->findOrFail($id);
        $colaborator->restore();                    

        
        return redirect()->route('colaborators.rh.colaborators')->with([
                'status' => true ,
                'tipo_alert' => 'success',
                'icon' => 'fas fa-check-circle',
                'paricin' => 'text-dark',
                'mesagem' => 'Este colaborador foi restaurado com sucesso!',
            ]);
    }

    

    // Validação do cpf
    public function validaCPF($cpf)
    {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;

    }

    // Created
    public function created(Request $request) : RedirectResponse
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // validator
        $request->validate([
            'name' => 'required|max:255',
            'cpf' => 'required|max:40|unique:users,document',
            'email' => 'required|email|max:255|unique:users,email,',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
            'neighborhood' => 'required',
        ]);
   

        $token = Str::random(60);
        $cpf = $request->cpf;
        
        $this->validaCPF($cpf);

        if($this->validaCPF($cpf) == false){
            return redirect()->back() ->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Verifique o CPF inconsistência no numeros!',
            ]);
        }

        $permicaoStr =  implode(',', $request->permicao);
        
        // create new RH
        $user = new User();
        $user->name = $request->name;
        $user->document = $request->cpf;
        $user->email = $request->email;
        $user->confirmation_token = $token;
        $user->role = $permicaoStr;
        $user->department_id = $request->select_department;
        $user->permissions = $permicaoStr;
        $user->save();

        // create details user
        $user->detail()->create([
            'zip_code' => $request->zip_code, 
            'address' => $request->address, 
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city, 
            'phone' => $request->phone,  
            'salary' => $request->salary, 
            'admission_date' => $request->admission_date, 
        ]);

        // email
        Mail::to($user->email)->send(new ConfirmAccountEmail(route('colaborators.rh.confirm-account', $token)));



        return redirect()->route('colaborators.rh.colaborators')->with('success', 'Colaborator created successfully')
                                    ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este colaborador foi criado com sucesso!',
                                ]);
    }

    // Update
    public function updated(Request $request) : RedirectResponse
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // validator
        $request->validate([
            'select_department' => 'required|exists:departments,id',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
            'user_id' => 'required'
        ]);
        
        $cpf = $request->cpf;
        
        $this->validaCPF($cpf);

        if($this->validaCPF($cpf) == false){
            return redirect()->back() ->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Verifique o CPF inconsistência no numeros!',
            ]);
        }


        $id = $request->user_id;

        // create new RH
        $user = User::findOrFail($id);
        $user->department_id = $request->select_department;
        $user->save();

        // create details user
        $user->detail()->findOrFail($id)->update([ 
            'salary' => $request->salary, 
            'admission_date' => $request->admission_date, 
        ]);
        

        return redirect()->route('colaborators.rh.colaborators')->with('success', 'Colaborator updated successfully')
                                                ->with([
                                                    'status' => true ,
                                                    'tipo_alert' => 'success',
                                                    'icon' => 'fas fa-check-circle',
                                                    'paricin' => 'text-dark',
                                                    'mesagem' => 'Este colaborador foi atualizado com sucesso!',
                                                ]);
    }

    // Deleted
    public function deleted(Request $request) : RedirectResponse
    {
         
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id;

        $colaborator = User::with('detail')->findOrFail($id);
        $colaborator->delete([
            'id' => $id,
        ]);
        

        return redirect()->route('colaborators.rh.colaborators') ->with([
            'status' => true ,
            'tipo_alert' => 'success',
            'icon' => 'fas fa-check-circle',
            'paricin' => 'text-dark',
            'mesagem' => 'Este colaborador foi excluido com sucesso!',
        ]);
    }

    // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

     
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }
}