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

class ProfileCustomerController extends Controller
{
    public function index(): View
    {
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $colaborator = User::with('detail', 'department')->findOrFail(Auth::user()->id);
         
        
        return view('user.customer-profile', compact('colaborator', 'conf'));
    }

    public function updateCustomerPassword(Request $request)
    {
        // form validation
        $request->validate(
            [
                'current_password' => 'required|min:8|max:16',
                'new_password' => 'required|min:8|max:16|different:current_password',
                'new_password_confirmation' => 'required|same:new_password',
            ]
        );
        $user = Auth::user();

        // rerifica se a senha esta correta
        if(!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Corrent password is incorrect.');
        }

        // atualisar senha no banco de dados
        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    public function updateCustomerData(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:4|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . Auth::user()->id,
            ]
        );

        // update user data
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();


        return redirect()->back()->with('success_change_data', 'User Data updated successfully.');
    }

    public function updateCustomerDetail(Request $request)
    {

        // validator
        $request->validate([
            'address' => 'required|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:50',
            'phone' => 'required|string|max:20',
            'bairro' => 'required',
            'user_id' => 'required'
        ]);

        $address = $request->address . " - " . $request->bairro;

        $id = Auth::user()->id;

        $user = User::with('detail')->findOrFail($id);


        $user->detail->zip_code = $request->zip_code;
            $user->detail->address = $request->address; 
            $user->detail->number = $request->number;
            $user->detail->complement = $request->complement;
            $user->detail->neighborhood = $request->neighborhood;
            $user->detail->city = $request->city; 
            $user->detail->phone = $request->phone;  
            $user->detail->salary = $request->salary; 
            $user->detail->admission_date = $request->admission_date; 
        $user->detail->save();



    
        return redirect()->back()->with('success_change_detail', 'User Data updated successfully.');
    }

    // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->leader_id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    //Gate
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to customerstockdetail page');
    }
}