<?php

namespace App\Http\Controllers\Adm\Admin\Plans;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\SettingsDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    //suppliers Table
    public function table(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $plans = Plan::all();
         

        return view('adm.admin.plans.table-plans', compact('plans', 'conf'));

    }
    
    //suppliers New
    public function add(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o suppliers page');
         
        
        return view('adm.admin.plans.add-plans', compact('conf'));
    }
    
    //suppliers Edit
    public function edit($id = null): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $plan = Plan::findOrFail($id);
         


        return view('adm.admin.plans.edit-plans', compact('plan', 'conf'));

    }

    //suppliers Show
    public function show($id = null): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $plan = Plan::findOrFail($id);
         

        return view('settings.plans.show-plans', compact('plan', 'conf'));
    }
    
    //suppliers Confirm delete
    public function confDelete($id = null): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $plan = Plan::findOrFail($id);
         

        return view('adm.admin.plans.confirm-delete-plans',compact('plan', 'conf'));
    }


    //suppliers Created
    public function created(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        // dd( $request);
        $request->validate([
            'name' => 'required|string|max:40|unique:plans,name',
            'product_id' => 'required|string|max:200|',
            'price_id' => 'required|string|max:200|',
            'percente' => 'required|max:3|',
            'customer_status'=> 'required|max:30',
            'price'=> 'required|decimal:2',
            // 'discount_price'=> 'required|decimal:2',
        ]);

        $perc = $request->percente / 100;
        $val = $request->price - ($perc * $request->price);
        
        // dd($val, $request);
        
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->product_id = $request->product_id;
        $plan->price_id = $request->price_id;
        $plan->percente = $request->percente;
        $plan->customer_status = $request->customer_status;
        $plan->price = $request->price;
        $plan->discount_price = $val;
        $plan->save();

        return redirect()->route('adm.plans.table-plans');
    }

    //suppliers Updated
    public function updated(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        // dd( $request);
        $request->validate([
            'name' => 'required|string|max:40|unique:plans,name',
            'product_id' => 'required|string|max:200|',
            'price_id' => 'required|string|max:200|',
            'percente' => 'required|max:3|',
            'customer_status'=> 'required|max:30',
            'price'=> 'required|decimal:2',
            // 'discount_price'=> 'required|decimal:2',
        ]);

        $perc = $request->percente / 100;
        $val = $request->price - ($perc * $request->price);
        
        // dd($val, $request);
        
        $plan = Plan::findOrFail($request->id);
        $plan->name = $request->name;
        $plan->product_id = $request->product_id;
        $plan->price_id = $request->price_id;
        $plan->percente = $request->percente;
        $plan->customer_status = $request->customer_status;
        $plan->price = $request->price;
        $plan->discount_price = $val;
        $plan->save();

        return redirect()->route('adm.plans.table-plans');

    }
    
    //suppliers Delete
    public function deleted(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $plan = Plan::findOrFail($id);
        $plan->delete();
        

        return redirect()->route('adm.plans.table-plans');
    }
    
    public function vis()
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $plans = Plan::all();
         

        return view('plans', compact('plans', 'conf'));
    }

    public function selected($id = null)
    {
         // check i idf is valid
         $plan = Crypt::decryptString($id);
        
         if(!$plan) {
             return redirect()->route('adm.plans.vis-plans');
         }
         $plan = explode('|', $plan);
         $product_id = $plan[0];
         $price_id = $plan[1];

         return Auth::user()
                     ->newSubscription($product_id, $price_id)
                     ->checkout([
                         'success_url' => route('adm.plans.subscription-success-plans'),
                         'cancel_url' => route('adm.plans.vis-plans'),
                     ]);
    }
    
    // config pages adm
    public function configPageAdm()
    {
        $id = Auth::user()->id;
        $infor = SettingsDetail::where('user_id', $id)->first();
        return $infor;
    }

    // Gate
    public function canGate($gateUser = null)
    {
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }
}