<?php

namespace App\Http\Controllers\Adm\Resellers\ResellerMySales;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class RellerCustomerMySalesController extends Controller
{
    //Reseller my sales Table
    public function tableResellerMySales(Request $request): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        // dd($request);

        $user_id = Auth::user()->id;
        $clients = Client::all();
        $mysales = InstallmentClientDetail::where('user_id', '=', $user_id)
                ->when($request->has('client_id'), function ($whenQuery) use ($request){
                    $whenQuery->where('client_id', 'like', '%'.$request->client_id.'%');
                })
                ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('due_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                })
                ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('due_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                })
                ->orderByDesc('due_date')
                ->paginate(10)
                ->withQueryString();
                
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view(  'adm.resellers.reseller-my-sales.table-reseller-my-sales', [
            'clients' => $clients, 
            'mysales' => $mysales, 
            'conf' => $conf,
            'client_id' => $request->client_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

    }


    //Reseller my sales New
    public function addResellerMySales(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o InstallmentClientDetail page');


        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
        $clients = Client::all();


        return view('adm.resellers.reseller-my-sales.add-reseller-my-sales', compact( 'clients', 'conf'));
    }

    //Reseller my sales Edit
    public function editResellerMySales($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $mysale = InstallmentClientDetail::findOrFail($id);
        $clients = Client::all();
        
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.reseller-my-sales.edit-reseller-my-sales', compact( 'mysale', 'clients', 'conf'));

    }

    //Reseller my sales Created
    public function createdResellerMySales(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');



        $request->validate([
            'code' => 'required|',
            // 'client_id' => 'required|',
            'percentage' => 'required|',
            'amount' => 'required|',
            'resale_price' => 'required|decimal:2',
        ]);



        $codes = Product::where('code', '=', $request->code)->get();



        $product_id = $codes[0]['id'];
        $client_id = Auth::user()->id;

        $InstallmentClientDetails = [];

        $InstallmentClientDetails['data'] = InstallmentClientDetail::where('product_id', '=', $product_id)
                                                    ->Where('client_id', '=', $client_id)
                                                    ->get();




        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);


        if($codes->count() == 0) {
            return redirect()->back();
        }

        if(!$InstallmentClientDetails['data']) {

            $csd_id = $InstallmentClientDetails['data'][0]['id'];
            $product_csd_id = $InstallmentClientDetails['data'][0]['product_id'];

            $client_csd_id = $InstallmentClientDetails['data'][0]['client_id'];
            $amount_csd = $InstallmentClientDetails['data'][0]['amount'];

            if($product_id == $product_csd_id && $client_id == $client_csd_id) {

                $mysale = InstallmentClientDetail::findOrFail($csd_id);


                $amontn = $amount_csd + $request->amount;


                $mysale->product_id = $product_id;
                $mysale->client_id = $client_id;
                $mysale->percentage = $request->percentage;
                $mysale->amount = $amontn;
                $mysale->purchase_price = $valor;
                $mysale->resale_price = $request->resale_price;
                $mysale->save();

                return redirect()->route('adm.resellers.reseller-my-sales.table-reseller-my-sales');

            }
        }else {

            $mysale = new InstallmentClientDetail();

            $amontn = $request->amount;

            $mysale->product_id = $codes[0]['id'];
            $mysale->client_id = $request->client_id;
            $mysale->percentage = $request->percentage;
            $mysale->amount = $amontn;
            $mysale->purchase_price = $valor;
            $mysale->resale_price = $request->resale_price;
            $mysale->save();

            return redirect()->route('adm.resellers.reseller-stock-detail.add-reseller-stock-detail');
        }



    }

    //Reseller my sales Updated
    public function updatedResellerMySales(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        dd($request);

        $request->validate([
            'id' => 'required|',
            'client_id' => 'required|',
            'installment_price' => 'required|decimal:2',
            'due_date' => 'required|',
        ]);




        $user_id = Auth::user()->id;
        $client_id = $request->client_id;
        $id = $request->id;


        $mysale = InstallmentClientDetail::where('user_id', '=', $user_id)
                                                    ->Where('client_id', '=', $client_id)
                                                    ->findOrFail($id);



        $mysale->installment_price = $request->installment_price;
        $mysale->due_date = $request->due_date;
        $mysale->save();



            return redirect()->route('adm.resellers.reseller-my-sales.table-reseller-my-sales')
                                    ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fa-regular fa-circle-check',
                                    'paricin' => 'text-darck',
                                    'mesagem' => 'Registro foi atualizado com sucesso.',
                                ]);

    }

    //Reseller my sales Show
    public function showResellerMySales($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;

        $clients = Client::all();
        $mysale = InstallmentClientDetail::where('user_id', '=', $user_id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-my-sales.show-reseller-my-sales', compact('clients', 'mysale', 'conf'));
    }

    //Reseller my sales Confirm delete
    public function confDeleteResellerMySales($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $mysale = InstallmentClientDetail::findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-my-sales.confirm-delete-reseller-my-sales',compact('mysale', 'conf'));
    }

    //Reseller my sales Delete
    public function deletedResellerMySales(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $aces = InstallmentClientDetail::findOrFail($id);
        $aces->delete();


        return redirect()->route('adm.resellers.reseller-my-sales.table-reseller-my-sales')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fa-regular fa-circle-check',
                                    'paricin' => 'text-darck',
                                    'mesagem' => 'Registro foi excluido com sucesso.',
                                ]);
    }

    //  Reseller My Sales Relatorio PDF
    public function relatorioResellerMySales(Request $request)
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to InstallmentClientDetail page');

        $user_id = Auth::user()->id;
        $clients = Client::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
        $mysales = InstallmentClientDetail::where('user_id', '=', $user_id)
                ->when($request->has('client_id'), function ($whenQuery) use ($request){
                    $whenQuery->where('client_id', '=', $request->client_id);
                })
                ->when($request->filled('start_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('due_date', '>=', Carbon::parse($request->start_date)->format('Y-m-d'));
                })
                ->when($request->filled('end_date'), function ($whenQuery) use ($request){
                    $whenQuery->where('due_date', '<=', Carbon::parse($request->end_date)->format('Y-m-d'));
                })
                ->orderByDesc('due_date')->get();

        $pdfmysales = Pdf::loadView('adm.resellers.reseller-my-sales.report-reseller-my-sales',
                        ['mysales' => $mysales, 'clients' => $clients])
                            ->setPaper('a4', 'portrait');

        return $pdfmysales->download('Relatorio_minhas_vendas.pdf');
    }
    


}