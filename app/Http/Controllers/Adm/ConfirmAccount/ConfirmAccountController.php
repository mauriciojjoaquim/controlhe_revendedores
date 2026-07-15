<?php

namespace App\Http\Controllers\Adm\ConfirmAccount;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfirmAccountController extends Controller
{
    public function ConfirmAccount($token = null)
    {
        // check the token is valid

        $user = User::where('confirmation_token', $token)->first();
        $conf = SettingsDetail::findOrFail(Auth::user()->id);
        if(!$user) {
            abort(403, 'Invalid confirmation token');
        }

        return view('auth.confirm-account', compact('user', 'conf'));

    }
    public function updateConfirmAccount(Request $request)
    {

        // form validation
        $request->validate([
                'id_token' => 'required|string|size:60',
                'password' => 'required|confirmed|min:8|max:16|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ]);

        $user = User::where('confirmation_token', $request->id_token)->first();
        $user->password = bcrypt($request->password);
        $user->confirmation_token = null;
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('welcome', ['id' => $user->id]);
    }

    public function welcome($id = null)
    {
        //
        $user = User::findOrFail($id);
        $conf = SettingsDetail::findOrFail(Auth::user()->id);

        return view('auth.welcome', compact('user', 'conf'));
    }
}