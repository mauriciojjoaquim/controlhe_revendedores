<?php

namespace App\Http\Controllers\Adm\Admin\Colaborators;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Department;
use App\Models\SettingsDetail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use App\Models\UserInstallmentDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ColaboratorAllController extends Controller
{
    //  table
    public function table()
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $colaborators = User::withTrashed()
                                ->with('detail', 'department', 'settingsdetail')
                                ->where('role', '<>', 'admin')
                                ->get();
                                
         
        
        return view('adm.admin.colaborators.all-colaborators.table-all-colaborators', compact('colaborators', 'conf'));
    }

    //  Add
    public function add(): View
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $departments = Department::all();
        $access = Access::all();
         

        return view('adm.admin.colaborators.all-colaborators.add-all-colaborators', compact('departments', 'access', 'conf'));

    }
    
    //  Edit
    public function edit($id): View
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $departments = Department::all();
        $access = Access::all();
        $colaborator = User::with('detail', 'settingsdetail')->findOrFail($id);
         

        return view('adm.admin.colaborators.all-colaborators.edit-all-colaborators', compact('colaborator', 'departments',  'access', 'conf'));
    }
    
    //  Detail
    public function detail($id): View
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();


        $colaborator = User::with('detail')->findOrFail($id);
         


        return view('adm.admin.colaborators.all-colaborators.detailall-colaborators', compact('colaborator', 'conf'));
    }

    //  Confirma Delete
    public function confDelete($id): View
    {
        Auth::user()->can('admin', 'admin') ?: abort(403, 'You are not authorized to access page');


        $colaborator = User::findOrFail($id);
         

        return view('colaborators.colaborator.confirm-delete-colaborator', compact('colaborator', 'conf'));
    }

    //  Restore
    public function restore($id): View|RedirectResponse
    {
        //gate
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $colaborator = User::withTrashed()
                            ->with('detail')
                            ->where('role', 'admin')
                            ->findOrFail($id);
        $colaborator->restore();


        return redirect()->route('adm.all-colaborators.table-all-colaboratorsss')->with('success', 'Colaborator restored successfully');

    }
    
    //  Created
    public function created(Request $request) : RedirectResponse
    {
        // dd($request);

        // validator
        $request->validate([
            'name' => 'required|max:255|unique:users,name',
            'cpf' => 'required|string|max:20|unique:users,document',
            'email' => 'required|email|max:255|unique:users,email,',
            'new_password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'new_password_confirmation' => 'required|required|same:new_password',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'salary' => 'required|decimal:2',
            'admission_date' => 'required|date_format:Y-m-d',
            'number' => 'required',
            'neighborhood' => 'required',
            'permicao' => 'required',
        ]);

        $cpf = $request->cpf;
        
        $this->validaCPF($cpf);

        if($this->validaCPF($cpf) == false){
            return redirect()->back()->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Verifique o CPF inconsistência no numeros!',
            ]);
        }

        //dd($request);


        $permicaoStr =  implode(',', $request->permicao);

        

        // create new RH
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->document = $cpf;
        $user->email_verified_at = now();
        $user->password = bcrypt($request->new_password);
        $user->role = $permicaoStr;
        $user->department_id = $request->select_department;
        $user->permissions = $permicaoStr;
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
            'salary' => $request->salary,
            'admission_date' => $request->admission_date,
        ]);
        
        $user->settingsdetail()->create([
            'pix' => 'sem',
            'price' => '0.00',
            'percentage' => 30,
            'color_border' => 'border-primary',
            'bg_color_site' => 'bg-primary',
            'color_site_bg' => 'bg-primary',
            'text_color_site' => 'text-dark',
            'bg_color_table' => 'table-primary',
            'color_table_text' => 'text-dark',
            'color_card_bg' => 'bg-primary',
            'color_card_text' => 'text-dark',
            'bg_color_menu' => 'bg-primary',
            'text_color' => 'text-dark',
        ]);
    
        $quantmonth = 12;
        $ordennums = UserInstallmentDetail::all();
        $num = $ordennums->count() - 1;
        $ordennum = $ordennums[$num]->order_number_id;
        
        if($user->department_id == 3) {
            for ($i=1; $i <= $quantmonth; $i++) { 
                

                $orden = UserInstallmentDetail::all();
                $numt = $orden->count() - 1;
                $ordennum = $orden[$numt]->order_number_id;
                    
                if($orden->count() > 0) {
                    $ordennum = $orden[$numt]->order_number_id + 1;
                    
                } else {
                    $ordennum = 1;
                }
                // dd($ordennum);
                $dataSomada1 = strtotime('+'.$i.' month'); 
                $payment_date = date('Y-m-d H:i:s', $dataSomada1);
                $month = date('m', $dataSomada1);
                $year = date('Y', $dataSomada1);
                $user->userinstallmentdetail()->create([
                    'order_number_id' => $ordennum,
                    'month' => $month,
                    'year' => $year,
                    'installment_number' => $i,
                    'installment_price' => 35.0,
                    'due_date' => $payment_date,
                ]);
            }
        
        }

        return redirect()->route('adm.all-colaborators.table-all-colaborators')->with([
            'status' => true ,
            'tipo_alert' => 'success',
            'icon' => 'fas fa-check-circle',
            'paricin' => 'text-dark',
            'mesagem' => 'Este colaborador foi criado com sucesso!',
        ]);
    }

     //  Updated
    public function updated(Request $request) : RedirectResponse
    {
        // dd($request);

        // validator
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,id',
            'new_password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'new_password_confirmation' => 'required|required|same:new_password',
            'select_department' => 'required|exists:departments,id',
            'address' => 'required|max:255',
            'number' => 'required',
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

        $permicaoStr =  implode(',', $request->permicao);

        // create edit RH
        $user = User::with('detail')->findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->document = $cpf;
        $user->email_verified_at = now();
        $user->password = bcrypt($request->new_password);
        $user->role = $permicaoStr;
        $user->department_id = $request->select_department;
        $user->permissions = $permicaoStr;
        $user->save();

        // create details user
        $user->detail->update([
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'phone' => $request->phone,
            'admission_date' => $request->admission_date,
            'salary' => $request->salary,
        ]);



        return redirect()->route('adm.all-colaborators.table-all-colaborators')->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este colaborador foi atualizado com sucesso!',
                                ]);
    }
    
    //  Deleted
    public function delete(Request $request) : RedirectResponse
    {
        Auth::user()->can('admin', 'admin') ?: abort(403, 'You are not authorized to access page');


        $colaborator = User::with('detail')->findOrFail($request->id);

        $colaborator->delete();

        return redirect()->route('adm.all-colaborators.table-all-colaborators');
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