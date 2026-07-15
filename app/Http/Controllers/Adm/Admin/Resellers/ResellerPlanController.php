<?php

namespace App\Http\Controllers\Adm\Admin\Resellers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\View\View;

class ResellerPlanController extends Controller
{
    public function loginPage(): View
    {
        return view('auth.login');
    }


    public function plans(): View
    {
        $prices = [
            'month' => Crypt::encryptString(env('STRIPRE_PRODUCT_ID') . "|" . env('STRIPRE_MONTHLY_PRICE_ID')),
            'yearly' => Crypt::encryptString(env('STRIPRE_PRODUCT_ID') . "|" . env('STRIPRE_YEARLY_PRICE_ID')),
            'longest' => Crypt::encryptString(env('STRIPRE_PRODUCT_ID') . "|" . env('STRIPRE_LONGEST_PRICE_ID')),
        ];

        return view('plans', compact('prices'));
    }

    public function dashboard(): View
    {
        return view('dashboard');
    }

    public function planSelected($id = null)
    {
        // check i idf is valid
        $plan = Crypt::decryptString($id);

        if(!$plan) {
            return redirect()->route('plans');
        }
        $plan = explode('|', $plan);
        $product_id = $plan[0];
        $prceu_id = $plan[1];

        return Auth::user()
                    ->newSubscription($product_id, $prceu_id)
                    ->checkout([
                        'success_url' => route('subscription.success'),
                        'cancel_url' => route('plans'),
                    ]);

    }

    public function subscriptionSuccess(): View
    {
        return view('subscription_success');
    }


}
