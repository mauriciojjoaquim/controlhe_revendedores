<?php

namespace App\Http\Controllers\Adm\Admin\Shops\Installments;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\User;
use App\Models\UserInstallmentDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersInstallmentDetailController extends Controller
{
    // Table
    public function table(): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $userinstallmentdetails = UserInstallmentDetail::all();
        $users = User::with('userinstallmentdetail')->get();
         
        // $users = User::all();
        $dataSomada1 = now();

        // dd($userinstallmentdetails);

        return view('admin.user-installment-details.table-user-installment-details', compact('userinstallmentdetails', 'users', 'dataSomada1', 'conf'));

    }
    
    // Add
    public function add(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o suppliers page');

        $userinstallmentdetails = UserInstallmentDetail::all();
         
        $users = User::all();
        

        
        return view('admin.user-installment-details.add-user-installment-details', compact('users', 'userinstallmentdetails','conf' ));
    }
    
    // Edit
    public function edit($id = null): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $userinstallmentdetail = UserInstallmentDetail::findOrFail($id);    
        $users = User::all();
        
        
        return view('admin.user-installment-details.edit-user-installment-details', compact('users', 'userinstallmentdetail', 'conf'));

    }

    // confirmar pagamento
    public function payment($id = null): RedirectResponse 
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $userinstallmentdetails = UserInstallmentDetail::findOrFail($id);
        $userinstallmentdetails->customer_status = 'PG';
        $userinstallmentdetails->payment_date = now();
        $userinstallmentdetails->save();

        return redirect()->route('admin.user-installment-details.table-user-installment-details');
    }

    // Show
    public function show($id = null): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $category = UserInstallmentDetail::findOrFail($id);
         

        return view('settings.categories.show-categories', compact('category', 'conf'));
    }
    
    // Confirm delete
    public function confDelete($id = null): View 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $category = UserInstallmentDetail::findOrFail($id);
         

        return view('settings.categories.confirm-delete-categories',compact('category', 'conf'));
    }
    
    // Created
    public function created(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $request->validate([
            'user_id' => 'required|',
        ]);

    
       $user = User::findOrFail($request->user_id);
       $virifelds = UserInstallmentDetail::where('user_id', '=', $user->id)->get();


       if ($virifelds->count() != 0) {
        return redirect()->route('admin.user-installment-details.add-user-installment-details')->with([
            'status' => true ,
            'tipo_alert' => 'warning',
            'icon' => 'fas fa-exclamation-triangle',
            'paricin' => 'text-danger',
            'mesagem' => 'Não foi poxivel criar pagamento para este cliente já foi criado!',
            'cod' => 'mcgad',
        ]);
       }
       
        $quantmonth = 12;
        $ordennums = UserInstallmentDetail::all();
        $num = $ordennums->count() - 1;
        $ordennum = $ordennums[$num]->order_number_id;
        
        if($user->department_id == 3) {
            for ($i=1; $i <= $quantmonth; $i++) { 
                

                $orden = UserInstallmentDetail::all();
                $numt = $orden->count() - 1;
                $ordennum = $orden[$numt]->order_number_id;
            

                                
                if($orden->count() > 0){
                    $ordennum = $orden[$numt]->order_number_id + 1;
                    
                } else {
                    $ordennum = 1;
                }
                // dd($ordennum);
                
                $dataSomada1 = strtotime('+'.$i.' month'); 
                $payment_date = date('Y-m-d H:i:s', $dataSomada1);
                $month = date('m', $dataSomada1);
                $year = date('Y', $dataSomada1);
                $userinstallmentdetail = new UserInstallmentDetail();
                $userinstallmentdetail->user_id = $request->user_id;
                $userinstallmentdetail->order_number_id = $ordennum;
                $userinstallmentdetail->month = $month;
                $userinstallmentdetail->year = $year;
                $userinstallmentdetail->installment_number = $i;
                $userinstallmentdetail->installment_price = 35.0;
                $userinstallmentdetail->customer_status = 'NC';
                $userinstallmentdetail->due_date = $payment_date;
                $userinstallmentdetail->save();
            }
            
        } else {
            return redirect()->route('admin.user-installment-details.add-user-installment-details')->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Não foi poxivel criar pagamento para este cliente ele não é vendedor!',
                'cod' => 'mcgad',
            ]);
        }

        return redirect()->route('admin.user-installment-details.table-user-installment-details')->with([
            'status' => true ,
            'tipo_alert' => 'success',
            'icon' => 'fas fa-check-circle',
            'paricin' => 'text-dark',
            'mesagem' => 'Foi criado com sucesso o meio de pagamentos para este cliente!',
        ]);
    }

    // Updated
    public function updated(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
 
          
        $request->validate([
            'category' => 'required|string|max:150|unique:categories,category,id',
            'id' => 'required'
        ]);

        
        $id = $request->id;
  
        // create update suppliers
        $category = UserInstallmentDetail::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->route('admin.settings.categories.table-category');

    }

    // Delete
    public function deleted(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');

         
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $category = UserInstallmentDetail::findOrFail($id);
        $category->delete();
        

        return redirect()->route('admin.settings.categories.table-category');
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