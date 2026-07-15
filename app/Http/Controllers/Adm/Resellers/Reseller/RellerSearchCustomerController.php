<?php

namespace App\Http\Controllers\Adm\Resellers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientOrderDetail;
use App\Models\SettingsDetail;
use App\Models\User;
use App\Models\Verification\CustomerBasedVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RellerSearchCustomerController extends Controller
{
    public function searchClient() : View
    {
                //gate
                Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');
                
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

                
        return view('adm.resellers.reseller-search.search-reseller', compact('conf'));
    }

    public function searchFormClient(Request $request)
    {
   
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $request->validate(
            ['search' => 'required|'], ['search.required'=> 'É necesario preecher o campo de verificação']
        );
        $search = $request->search;

        $client = CustomerBasedVerification::with('customerBasedVerificationDetail')
                            ->where('cpf', '=', $search)
                            ->orWhere('name', '=', $search)
                            ->get();


        if($client->count() == 0) {

            return redirect()->route('adm.resellers.add-resellers')->with([
                'status' => true ,
                'tipo_alert' => 'warning',
                'icon' => 'fas fa-exclamation-triangle',
                'paricin' => 'text-danger',
                'mesagem' => 'Não foi encontrado cadastro para este cliente ou verifique o dados estão correto!',
                'data' => $search,
                'cod' => 'mcgad',
            ]);
        }

        elseif ($client->count() != 0 and $client[0]['situation'] == null and $client[0]['user_id'] != Auth::user()->id) {


            return redirect()->route('adm.resellers.reseller-search.info-resellers', compact('client'))
                                    ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este cliente esta cadastrado com outro vendedora dezeja adicionar a sua carteira!',
                                            'data' => $search,
                                            'cod' => 'mcgsd',
                                            'metrica' => $client[0]['id'],
                                        ]);
        }
        elseif ($client->count() != 0 and $client[0]['situation'] == null and $client[0]['user_id'] == Auth::user()->id) {

            return redirect()->route('adm.resellers.reseller-search.info-resellers', compact('client'))
                                    ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este cliente esta cadastrado a sua carteira!',
                                            'data' => $search,
                                            'cod' => 'mczsd',
                                            'metrica' => $client[0]['id'],
                                        ]);
        }
        elseif ($client->count() != 0 and $client[0]['situation'] == 'liberado' and $client[0]['user_id'] != Auth::user()->id) {

            return redirect()->route('adm.resellers.reseller-search.info-resellers', compact('client'))
                                    ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este cliente esta liberado para venda na sua carteira!',
                                            'data' => $search,
                                            'cod' => 'mcgsd',
                                            'metrica' => $client[0]['id'],
                                        ]);
        }
        elseif ($client->count() != 0 and $client[0]['situation'] == 'liberado' and $client[0]['user_id'] == Auth::user()->id) {

            return redirect()->route('adm.resellers.reseller-search.info-resellers', compact('client'))
                                    ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este cliente esta liberado para venda a sua carteira!',
                                            'data' => $search,
                                            'cod' => 'mczsd',
                                            'metrica' => $client[0]['id'],
                                        ]);
        }
        elseif ($client->count() != 0 and $client[0]['situation'] == 'liberado' and $client[0]['user_id'] != Auth::user()->id) {


            return redirect()->route('adm.resellers.reseller-search.info-resellers', compact('client'))
                                    ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'success',
                                            'icon' => 'fas fa-check-circle',
                                            'paricin' => 'text-dark',
                                            'mesagem' => 'Este cliente esta cadastrado e liberado com outro vendedora dezeja adicionar a sua carteira!',
                                            'data' => $search,
                                            'cod' => 'mcgsd',
                                            'metrica' => $client[0]['id'],
                                        ]);
        }
        else {


            return redirect()->route('adm.resellers.reseller-search.info-resellers', compact('client'))
                                    ->with([
                                            'status' => true ,
                                            'tipo_alert' => 'warning',
                                            'icon' => 'fas fa-exclamation-triangle',
                                            'paricin' => 'text-danger',
                                            'mesagem' => 'Este cliente não recomendamos a venda, está por conta e risco do vendedor!',
                                            'data' => $search,
                                            'cod' => 'mcgsd',
                                            'metrica' => $client[0]['id'],
                                        ]);
        }
        dd($client);
    }

    public function infoClient($id = 0) : View
    {
        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        
        $id = session('metrica');
        
        // dd($id);
        
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();
        if($id == 0){
            return view('adm.resellers.reseller-search.info-reseller', compact('conf'));
        } else {

            $client = CustomerBasedVerification::with('CustomerBasedVerificationDetail')->findOrFail($id);
   

            return view('adm.resellers.reseller-search.info-reseller', compact('conf', 'client'));
        }

    }

    public function infoFormClient(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $request->validate(
            ['client_id' => 'required|'], ['client_id.required'=> 'É necesario código do cliente']);
        
        $id = $request->client_id;

        $client = CustomerBasedVerification::with('customerBasedVerificationDetail')
                            ->where('id','=', $id)->get();
        // dd($client, $id);

        if($id == $client[0]['id'] and $client[0]['user_id'] == Auth::user()->id) {
            return redirect()->route('adm.resellers.table-resellers')
                                    ->with([
                                        'status' => true ,
                                        'tipo_alert' => 'success',
                                        'icon' => 'fas fa-check-circle',
                                        'paricin' => 'text-dark',
                                        'mesagem' => 'Este cliente esta cadastrado!',
                                    ]);
        }


        $clientN = new Client();
        $clientN->user_id = Auth::user()->id;
        $clientN->name = $client[0]['name'];
        $clientN->email = $client[0]['email'];
        $clientN->cpf = $client[0]['cpf'];
        $clientN->save();


        // create details user
        $clientN->clientdetail()->create([
            'zip_code' => $client[0]['customerBasedVerificationDetail']['zip_code'],
            'address' => $client[0]['customerBasedVerificationDetail']['address'],
            'number' => $client[0]['customerBasedVerificationDetail']['number'],
            'complement' => $client[0]['customerBasedVerificationDetail']['complement'],
            'neighborhood' => $client[0]['customerBasedVerificationDetail']['neighborhood'],
            'city' => $client[0]['customerBasedVerificationDetail']['city'],
            'phone' => $client[0]['customerBasedVerificationDetail']['phone'],
            'register_date' => now(),
        ]);

        $clientN->clientorderdetail()->create([
            'user_id' => Auth::user()->id,
            'total_price' => '0.00',
            'number_of_installments' => 0,
            'price_per_installment' => '0.00',
            'installments_paid' => 0,
            'installment_due_date' => now(),
            'installment_payment_date' => now(),
            'situation' => 'liberado',
        ]);


        return redirect()->route('adm.resellers.table-resellers')
                        ->with([
                            'status' => true ,
                            'tipo_alert' => 'success',
                            'icon' => 'fas fa-check-circle',
                            'paricin' => 'text-dark',
                            'mesagem' => 'Este cliente esta cadastrado a sua carteira!',
                        ]);

    }

    public function showInfoClient($id): View
    {


        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $data = CustomerBasedVerification::findOrFail($id);
        
 
        $user_id = Auth::user()->id;
    
        $clientP = Client::where('cpf','=', $data['cpf'])
                        ->where('user_id','=', $user_id)
                        ->get();

        
        $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($clientP[0]['id']);
        $clientordendetails = ClientOrderDetail::all();

        $users = User::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.clients.client-search.show-info-vende-clients', compact('conf', 'client', 'clientordendetails', 'users'));
    }

    public function showOrderClient($id): View
    {

         //gate
         Auth::user()->can('vende') ?: abort(403, 'You are not authorized to clients page');

        $client = Client::with('clientdetail', 'clientorderdetail')->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();



        return view('dealers.clients.client-search.detail.show-order-vende-clients', compact('conf', 'client'));

    }

}