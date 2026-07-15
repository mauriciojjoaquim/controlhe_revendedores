<?php

namespace App\Http\Controllers\Adm\Rh\Colaborators;

use App\Http\Controllers\Controller;
use App\Mail\ConfirmAccountEmail;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RhMagementUserController extends Controller
{
    // tabela
    public function colaboratorsManager()
    {  
        // Gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

        $colaborators = User::with('detail', 'department')
                        ->where('role', 'colaborator')
                        ->withTrashed()
                        ->get();

       return view('colaborators.colaborator.manager.colaborators', compact('colaborators'));             

    }
    
    // adicionar
    public function newColaboratorsManager()
    {
        // Gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');
        $departments = Department::where('id', '>', '2')->get();

        if($departments->count() === 0) {
            abort(403, 'There are no departmebts to add new colaborator. Please contact the system adminitrator to add a new department.');

        }

        return view('colaborators.colaborator.manager.add-colaborators', compact('departments'));
    }

    // Criar
    public function createColaboratorsManager(Request $request)
    {
        // Gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

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
            'number' => 'required',
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

        if ($request->select_department <= 2) {
            return redirect()->route('home');

        }

        $permicaoStr =  implode(',', $request->permicao);
        $token = Str::random(60);

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

         return redirect()->route('home')->with('success', 'Colaborator created successfully');
     
    }
    
    // editar
    public function editColaboratorsManager($id)
    {
        //gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

        $departments = Department::where('id', '>', '2')->get();


        $colaborator = User::withTrashed()
                        ->with('detail')
                        ->where('role', 'colaborator')
                        ->findOrFail($id);

        return view('colaborators.colaborator.manager.edit-colaborators', compact(['colaborator', 'departments']));
    }
    
    // atualizar
    public function updateColaboratorsManager(Request $request)
    {
        //gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

        // validator
        $request->validate([
            'select_department' => 'required|exists:departments,id',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
            'user_id' => 'required|exists:users,id'
        ]);

        if ($request->select_department <= 2) {
            return \redirect()->route('home');
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
        
        return redirect()->route('home')->with('success', 'Colaborator updated successfully');
    
    }
    
    public function detailColaboratorsManager($id)
    {
        //Gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

   

        $colaborator = User::with('detail', 'department')
                                ->where('id', '=', $id)
                                ->first();                   

        return view('colaborators.colaborator.manager.detail-colaborators', compact('colaborator'));
    }

    public function delColaboratorsManager($id)
    {
        //gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');


        // create new RH
        $colaborator = User::findOrFail($id);

        return view('colaborators.colaborator.manager.delete-colaborators', compact('colaborator'));
    }
    public function deleteColaboratorsManager(Request $request)
    {
        //gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

        $request->validate([
            'id' => 'required',
        ]);
        $id = $request->id;

        $colaborator = User::with('detail')->findOrFail($id);
        $colaborator->delete([
            'id' => $id,
        ]);
        
        return redirect()->route('home')->with('success', 'Colaborator deleted successfully');
    
    }
    public function restoreColaboratorsManager($id)
    {
        //gate
        Auth::user()->can('rh') ?: abort(403, 'You are not authorized to access page');

        $colaborator = User::withTrashed()
                            ->with('detail')
                            ->where('role', 'colaborator')
                            ->findOrFail($id);
        $colaborator->restore();                    

        
        return redirect()->route('home')->with('success', 'Colaborator restored successfully');
    
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

}