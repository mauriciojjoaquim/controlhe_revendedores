<?php

namespace App\Http\Controllers\Adm\Resellers\ResellerInvoiceRegistrationForPayment;

use App\Http\Controllers\Controller;
use App\Models\SettingsDetail;
use App\Models\Resellers\InvoiceRegistrationForPayment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ResellerInvoiceRegistrationForPaymentController extends Controller
{
    //invoices Table
    public function tableInvoice(): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        $invoices = InvoiceRegistrationForPayment::where('user_id','=', Auth::user()->id)->get();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-invoice-registration-for-payment.table-reseller-invoice', compact('conf', 'invoices'));

    }
    
    //invoices New
    public function addInvoice(): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o invoices page');
        
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-invoice-registration-for-payment.add-reseller-invoice', compact('conf'));
    }
    
    //invoices Edit
    public function editInvoice($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        $invoice = InvoiceRegistrationForPayment::where('user_id','=', Auth::user()->id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.reseller-invoice-registration-for-payment.edit-reseller-invoice', compact('conf', 'invoice'));

    }
    
    //invoices Created
    public function createdInvoice(Request $request) 
    {


        // dd($request);
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        
        $request->validate([
            //'imagem' => 'mimes:pdf,jpg,png|max:2048|',
            'invoice_number' => 'required|',
            'description' => 'required|max:250|',
            'barcode' => 'required|',
            'price' => 'required|decimal:2',
            'pix_invoice_number' => 'required|',
            'installment_number' => 'required|',
            'due_date' => 'required|',

        ],
        [
            //'imagem.mimes' => 'Este campo aceito (PNG, JPG e PDF).',
            'invoice_number.required' => 'Este campo é obrigatório.',
            'description.required' => 'Este campo é obrigatório.',
            'barcode.required' => 'Este campo é obrigatório.',
            'price.required' => 'Este campo é obrigatório.',
            'pix_invoice_number.required' => 'Este campo é obrigatório.',
            'installment_number.required' => 'Este campo é obrigatório.',
            'due_date.required' => 'Este campo é obrigatório.',
        ]);

        
        
        $user_id = Auth::user()->id;
        $invoice = new InvoiceRegistrationForPayment();

        //Hasndle File upload
        if($request->hasFile('imagem')){
            // Get filename with the extensuon
            $filenameWithExt = $request->file('imagem')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension = $request->file('imagem')->getClientOriginalExtension();
            // File to store
            $fileNameToStore = $filename .'_'.time().'.'. $extension;
            // upload image
            $extension = $request->file('imagem')->getClientOriginalExtension();
            $extension = $request->file('imagem')->getClientOriginalExtension();
 
            $ingUrl = 'imagens/invoices/'. $user_id.'/';
 
            $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);
 
            $invoice->invoice_file = $fileNameToStore;
 
         } else {
            $invoice->invoice_file =  '150x150.png';
         }


        
        $invoice->user_id = $user_id;
        $invoice->invoice_status = 'NC';
        $invoice->invoice_number = $request->invoice_number;
        $invoice->description = $request->description;
        $invoice->barcode = $request->barcode;
        $invoice->pix_code = $request->pix_invoice_number;
        $invoice->price = $request->price;
        $invoice->installment_number = $request->installment_number;
        $invoice->due_date = $request->due_date;
        $invoice->payment_date = $request->payment_date;
        $invoice->save();

        return redirect()->route('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este boleto foi Adicionado com sucesso!',
                                ]);
    }

    //invoices Updated
    public function updatedInvoice(Request $request) 
    {
        
        // dd($request);
        
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');
        
        $request->validate([
            'imagem' => 'mimes:jpg,png,pdf|max:500|',
            'invoice_number' => 'required|',
            'description' => 'required|max:250|',
            'barcode' => 'required|',
            'pix_invoice_number' => 'required|',
            'installment_number' => 'required|',
            'due_date' => 'required|',

        ],
        [
            'imagem.mimes' => 'Este campo aceito (PNG, JPG e PDF).',
            'invoice_number.required' => 'Este campo é obrigatório.',
            'description.required' => 'Este campo é obrigatório.',
            'barcode.required' => 'Este campo é obrigatório.',
            'pix_invoice_number.required' => 'Este campo é obrigatório.',
            'installment_number.required' => 'Este campo é obrigatório.',
            'due_date.required' => 'Este campo é obrigatório.',
        ]);


        $user_id = Auth::user()->id;
        $id = $request->id;
  
        // create update invoices
        $invoice = InvoiceRegistrationForPayment::findOrFail($id);

        //Hasndle File upload
        if($request->hasFile('imagem')){
            // Get filename with the extensuon
            $filenameWithExt = $request->file('imagem')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get just Ext
            $extension = $request->file('imagem')->getClientOriginalExtension();
            // File to store
            $fileNameToStore = $filename .'_'.time().'.'. $extension;
            // upload image
            $extension = $request->file('imagem')->getClientOriginalExtension();
            $extension = $request->file('imagem')->getClientOriginalExtension();
 
            $ingUrl = 'imagens/invoices/'. $user_id;
 
            $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);
 
            $invoice->invoice_file = $fileNameToStore;
 
         } else {
 
             if($invoice->invoice_file == null) {
                $invoice->invoice_file =  '150x150.png';
             }
 
         }


        
        $invoice->user_id = $user_id;
        $invoice->invoice_status = 'NC';
        $invoice->invoice_number = $request->invoice_number;
        $invoice->description = $request->description;
        $invoice->barcode = $request->barcode;
        $invoice->pix_code = $request->pix_invoice_number;
        $invoice->price = $request->price;
        $invoice->installment_number = $request->installment_number;
        $invoice->due_date = $request->due_date;
        $invoice->payment_date = $request->payment_date;
        $invoice->save();

        return redirect()->route('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este boleto foi atualizado com sucesso!',
                                ]);

    }
    
    //invoices Show
    public function showInvoice($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');
        
        $invoice = InvoiceRegistrationForPayment::where('user_id','=', Auth::user()->id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-invoice-registration-for-payment.show-reseller-invoice', compact('conf', 'invoice'));
                        
    }
    
    //invoices Confirm delete
    public function confDeleteInvoice($id): View 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');

        $invoice = InvoiceRegistrationForPayment::where('user_id','=', Auth::user()->id)->findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-invoice-registration-for-payment.confirm-delete-reseller-invoice',compact('conf', 'invoice'));
    }

    //invoices Delete
    public function deletedInvoice(Request $request) 
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $invoice = InvoiceRegistrationForPayment::where('user_id','=', Auth::user()->id)->findOrFail($id);
        $directory = 'imagens/invoices/'.Auth::user()->id.'/'.$invoice->invoice_file;
        Storage::disk('public')->delete($directory);
        $invoice->delete();
        

        return redirect()->route('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este boleto foi excluido com sucesso!',
                                ]);
    }
    
    // confirmPaymentInvoice
    public function confirmPaymentInvoice($id)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to invoices page');
        
        $invoice = InvoiceRegistrationForPayment::where('user_id','=', Auth::user()->id)->findOrFail($id);
        $invoice->invoice_status = 'PG';
        $invoice->  payment_date = now();
        $invoice->save();



        
        return redirect()->back()->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este boleto foi confirmado o pagamento com sucesso!',
                                ]);
        
    }
} 