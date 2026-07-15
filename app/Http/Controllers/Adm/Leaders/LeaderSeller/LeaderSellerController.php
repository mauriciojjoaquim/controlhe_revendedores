<?php

namespace App\Http\Controllers\Adm\Leaders\LeaderSeller;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Department;
use App\Models\SettingsDetail;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class LeaderSellerController extends Controller
{

    use Notifiable;
    use SoftDeletes;

    // Colaborator table
    public function tableLeaderSeller()
    {
        // Gate
         Auth::user()->can('lider') ?: abort(403, 'You are not authorized to access page');
 
         $colaborators = User::withTrashed()
                                 ->with('detail', 'department')
                                 ->where('role', '=', 'vende')
                                 ->where('leader_id', '=', Auth::user()->id)
                                 ->get();
          
                                 // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
 
         return view('adm.leaders.leader-seller.table-leader-seller', compact('colaborators', 'conf'));
    }
 
     // Colaborator Add
     public function addLeaderSeller(): View
     {
         Auth::user()->can( 'lider') ?: abort(403, 'You are not authorized to access page');
 
         $departments = Department::all();
         $access = Access::all();
         $conf = SettingsDetail::findOrFail(Auth::user()->id);
 
         return view('adm.leaders.leader-seller.add-leader-seller', compact('departments', 'access', 'conf'));
 
     }
   
    // Colaborator Edit
    public function editLeaderSeller($id)
    {
        Auth::user()->can( 'lider') ?: abort(403, 'You are not authorized to access page');


        $colaborator = User::with('detail')
                                    ->where('id','=',$id)
                                    ->where('leader_id', '=', Auth::user()->id)
                                    ->first();

        if($colaborator->leader_id == null) {
            return redirect()->back();
        }
        $conf = SettingsDetail::findOrFail(Auth::user()->id);


        return view('adm.leaders.leader-seller.edit-leader-seller', compact(  'colaborator', 'conf'));
    }

    // Colaborator Detail
    public function showLeaderSeller($id)
    {
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to access page');


        $colaborator = User::with('detail')->findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);


        return view('adm.leaders.leader-seller.show-leader-seller', compact('colaborator', 'conf'));
    }

     // Colaborator Confirma Delete
     public function confDeleteLeaderSeller($id)
     {
         Auth::user()->can('lider', 'admin') ?: abort(403, 'You are not authorized to access page');
 
 
         $colaborator = User::findOrFail($id);
         $conf = SettingsDetail::findOrFail(Auth::user()->id);
 
         return view('adm.leaders.leader-seller.confirm-delete-leader-seller', compact('colaborator', 'conf'));
     }

     // Colaborator Created
    public function createdLeaderSeller(Request $request)
    {
        // Gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to access page');
            
        // validator
        $request->validate(
            [
            'name' => 'required|max:255|min:4',
            'cpf' => 'required|max:40|unique:users,document,',
            'email' => 'required|email|max:255|unique:users,email,',
            'new_password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'new_password_confirmation' => 'required|required|same:new_password',
            'address' => 'required|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'number' => 'required',
            'complement' => 'required',
            'neighborhood' => 'required',
            ],
            [
                'name.required' => 'O novo campo de nome é obrigatório.',
                'name.min' => 'Deve ter no mímimo :min de Caracteres.',
                'name.max' => 'Deve ter no maximo :max de Caracteres.',
                
                'email.required' => 'O novo campo de e-mail é obrigatório.',
                'email.min' => 'Deve ter no mímimo :min de Caracteres.',
                'email.max' => 'Deve ter no maximo :max de Caracteres.',
                
                'new_password.required' => 'O novo campo de senha é obrigatório.',
                'new_password.min' => 'Deve ter no mímimo :min de Caracteres.',
                'new_password.max' => 'Deve ter no maximo :max de Caracteres.',
                
                'new_password_confirmation.required' => 'O novo campo de confirmação de senha é obrigatório.',
                'new_password_confirmation.min' => 'Deve ter no mímimo :min de Caracteres',
                'new_password_confirmation.max' => 'Deve ter no maximo :max de Caracteres',
                ]
        );

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
        
        $id_user = Auth::user()->id;
        $userConf = SettingsDetail::where('user_id', '=', $id_user)->get();

        $salaryB = $userConf[0]['price'];

        // create new RH
        $user = new User();
        $user->leader_id = $id_user;
        $user->name = $request->name;
        $user->document = $request->cpf;
        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->password = bcrypt($request->new_password);
        $user->role = 'vende';
        $user->department_id = '3';
        $user->permissions = 'vende';
        $user->save();

        // create details user
        $user->detail()->create([
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'phone' => $request->phone,
            'salary' => $salaryB,
            'admission_date' => now(),
        ]);
        
        $user->settingsdetail->create([
            'cor_id' => 2,
            'pix' => 'sem',
            'text_color' => 'text-light',
            'text_color_site' => 'text-light',
            'bg_color_site' => 'lightcyan',
            'color_site_bg' => 'bg-black',
            'bg_color_menu' => 'lightseagreen',
            'color_menu_vertical_text' => 'text-dark',
            'bg_color_table' => 'table-dark',
            'color_table_text' => 'text-light',
            'color_card_bg' => 'bg-dark',
            'clor_card_text' => 'text-light',
            'color_border' => 'border-light',
            'percentage' => 30,
            'price' => 0.00,
        ]);


        return redirect()->route('adm.leaders.leader-seller.table-leader-seller')->with([
            'status' => true,
            'tipo_alert' => 'success',
            'mesagem' => 'Vendedor Adicionado com sucesso',
        ]);
    }
 
     // Colaborator Updated
     public function updatedLeaderSeller(Request $request)
     {
          // Gate
          Auth::user()->can('lider') ?: abort(403, 'You are not authorized to access page');
 
 
         // validator
         $request->validate([
             'name' => 'required|max:255',
             'cpf' => 'required|max:255|unique:users,document,'.$request->user_id,
             'email' => 'required|email|max:255|unique:users,email,'.$request->user_id,
             'new_password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
             'new_password_confirmation' => 'required|required|same:new_password',
             'select_department' => 'required|exists:departments,id',
             'address' => 'required|max:255',
             'number' => 'required',
             'complement' => 'required',
             'neighborhood' => 'required',
             'zip_code' => 'required|string|max:10',
             'city' => 'required|string|max:50',
             'phone' => 'required|string|max:20',
             'salary' => 'required|decimal:2',
             'admission_date' => 'required|date_format:Y-m-d',
             'permicao' => 'required',
             'user_id' => 'required',
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
         $leaderB_id = Auth::user()->id;
         $salaryB = '5.00';
 
         $permicaoStr =  implode(',', $request->permicao);
 
         // create edit RH
         $userDetail = UserDetail::where('user_id',$id);
         $user = User::findOrFail($id);
         $user->leader_id = $leaderB_id;
         $user->name = $request->name;
         $user->document = $request->cpf;
         $user->email = $request->email;
         $user->email_verified_at = now();
         $user->password = bcrypt($request->new_password);
         $user->role = 'vende';
          $user->department_id = '3';
          $user->permissions = 'vende';
         $user->save();
 
         // create details user
         $userDetail->address = $request->address;
         $userDetailzip_code = $request->zip_code;
         $userDetail->number = $request->number;
         $userDetail->complement = $request->complement;
         $userDetail->neighborhood = $request->neighborhood;
         $userDetail->city = $request->city;
         $userDetail->phone = $request->phone;
         $userDetail->salary = $salaryB;
         $userDetail->admission_date = $request->admission_date;
         $userDetail->save();
 
 
         return redirect()->route('adm.leaders.leader-seller.table-leader-seller')->with([
            'status' => true,
            'tipo_alert' => 'success',
            'mesagem' => 'Vendedor Atualizado com sucesso',
        ]);
     }
 
     // Colaborator Deletar
     public function deletedLeaderSeller(Request $request)
     {
         Auth::user()->can('lider') ?: abort(403, 'You are not authorized to access page');
 
 
         $colaborator = User::with('detail')->findOrFail($request->id);
         $colaborator->delete();
 
         return redirect()->route('adm.adm.leaders.leader-seller.table-leader-seller')->with([
            'status' => true,
            'tipo_alert' => 'success',
            'mesagem' => 'Vendedor excluido com sucesso',
        ]);
     }
 
     // Colaborator Restore
     public function restoreLeaderSeller($id)
     {
         //gate
         Auth::user()->can('lider') ?: abort(403, 'You are not authorized to access page');
 
         $colaborator = User::withTrashed()
                             ->with('detail')
                             ->where('leader_id', '=', Auth::user()->id)
                             ->findOrFail($id);
         $colaborator->restore();
 
 
         return redirect()->route('adm.leaders.leader-seller.table-leader-seller')->with('success', 'Vendedor restored successfully');
 
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