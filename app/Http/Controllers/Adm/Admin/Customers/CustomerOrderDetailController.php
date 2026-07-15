<?php

namespace App\Http\Controllers\Adm\Admin\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Client;
use App\Models\ClientOrderDetail;
use App\Models\SettingsDetail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CustomerOrderDetailController extends Controller
{
    
    use Notifiable;
    use SoftDeletes;
    
    // Table
    public function table(): View 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 

        $clientOrderdetails = ClientOrderDetail::all();
        $clients = Client::all();
        $users = User::all();
         

        return view('adm.admin.customers.customer-order-detail.table-customer-order-details', compact('users', 'clientOrderdetails','clients', 'conf'));

    }

    // Add
    public function add(): View 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o clients page');

         
        $clients = Client::all();
        $users = User::all();

        return view('adm.admin.customers.customer-order-detail.add-customer-order-details', compact('clients', 'users', 'conf'));
    }
    
    // Edit
    public function edit($id = null): View 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 

        
        $ClientOrderDetail = ClientOrderDetail::findOrFail($id);
         
        $clients = Client::all();
        $users = User::all();


        return view('adm.admin.customers.customer-order-detail.edit-customer-order-details', compact('clients', 'users', 'ClientOrderDetail', 'conf'));

    }
    
    // Show
    public function show($id = null): View 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 
        
        $client = Client::with('clientdetail')->findOrFail($id);
         


        return view('adm.admin.customers.customer-order-detail.show-customer-order-details', compact('client', 'conf'));
    }
    
    // Confirm delete
    public function confDelete($id = null): View 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 

        $clients = Client::all() ;
        $clientOrderDetail = ClientOrderDetail::findOrFail($id);
         

        return view('adm.admin.customers.customer-order-detail.confirm-delete-customer-order-details',compact('clientOrderDetail', 'conf', 'clients'));
    }

    // Created
    public function created(Request $request) : RedirectResponse
    {
        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 


        $request->validate([
            'client_id' => 'required|',
            'user_id' => 'required|',
            'total_price' => 'required|decimal:2',
            'number_of_installments' => 'required|string|max:140|',
            'price_per_installment' => 'required|decimal:2',
            'installments_paid' => 'required|string|max:140|',
            // 'installment_due_date' => 'required|string|max:140|',
            // 'installment_payment_date' => 'required|string|max:140|',
            'customer_status' => 'required|string|max:140|',
            // 'situation' => 'required|string|max:140|',
        ]);
        

        // create details user
        $ClientOrderDetail = new ClientOrderDetail();
            $ClientOrderDetail->client_id = $request->client_id; 
            $ClientOrderDetail->user_id = $request->user_id; 
            $ClientOrderDetail->total_price = $request->total_price;
            $ClientOrderDetail->number_of_installments = $request->number_of_installments;
            $ClientOrderDetail->price_per_installment = $request->price_per_installment;
            $ClientOrderDetail->installments_paid = $request->installments_paid; 
            $ClientOrderDetail->installment_due_date = $request->installment_due_date;
            $ClientOrderDetail->installment_payment_date = $request->installment_payment_date;
            $ClientOrderDetail->customer_status = $request->customer_status;
            $ClientOrderDetail->situation = $request->situation;
            $ClientOrderDetail->save();  

            

        return redirect()->route('adm.customers.customer-order-detail.table-customer-order-detail');
    }

    // Updated
    public function updated(Request $request) : RedirectResponse 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 

        $request->validate([ 
            'client_id' => 'required|',
            'user_id' => 'required|',
            'total_price' => 'required|decimal:2',
            'number_of_installments' => 'required|string|max:140|',
            'price_per_installment' => 'required|decimal:2',
            'installments_paid' => 'required|string|max:140|',
            // 'installment_due_date' => 'required|string|max:140|',
            // 'installment_payment_date' => 'required|string|max:140|',
            'customer_status' => 'required|string|max:140|',
            // 'situation' => 'required|string|max:140|',

        ]);
        
        $id = $request->id;
        

        // create details user
         // create details user
         $ClientOrderDetail = ClientOrderDetail::where('client_id', '=', $request->client_id)
                                                ->where('user_id', '=', $request->user_id)
                                                ->findOrFail($id);
            $ClientOrderDetail->client_id = $request->client_id; 
            $ClientOrderDetail->user_id = $request->user_id; 
            $ClientOrderDetail->total_price = $request->total_price;
            $ClientOrderDetail->number_of_installments = $request->number_of_installments;
            $ClientOrderDetail->price_per_installment = $request->price_per_installment;
            $ClientOrderDetail->installments_paid = $request->installments_paid; 
            $ClientOrderDetail->installment_due_date = $request->installment_due_date;
            $ClientOrderDetail->installment_payment_date = $request->installment_payment_date;
            $ClientOrderDetail->customer_status = $request->customer_status;
            $ClientOrderDetail->situation = $request->situation;
            $ClientOrderDetail->save(); 
            

        return redirect()->route('adm.customers.customer-order-detail.table-customer-order-detail');

    }

    //Delete
    public function deleted(Request $request) : RedirectResponse 
    {

        // gate admin 
        $this->cangate('admin');
        // cofiguração das paginas
        $conf = $this->configpageadm();
 
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        
        $client = ClientOrderDetail::with('client')->findOrFail($id);
        $client->delete();
        

        return redirect()->route('adm.customers.customer-order-detail.table-customer-order-detail');
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
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to access page');
    }

}