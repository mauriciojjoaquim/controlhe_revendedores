<?php

namespace App\Http\Controllers\Adm\Resellers;


use App\Http\Controllers\Controller;
use App\Models\AddToCart\AddToCart;
use App\Models\Adm\admin\PurchaseStatu;
use App\Models\Client;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Total\TotalAnnualClosing;
use App\Models\Total\TotalMonthlyClosing;
use App\Models\User;
use App\Models\Verification\InstallmentClientDetail;
use Illuminate\Support\Facades\Auth;


class ResellerController extends Controller
{
    public function home()
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to customerstockdetail page');

        // Cofigurações do app do vendedor
        $user_id = Auth::user()->id;
        $conf = $this->wConf();


        // date
        $date = now();
        $dataSomadafor = strtotime($date);
        $datean = date('Y', $dataSomadafor);
        $datemo = date('m', $dataSomadafor);

        // Collect data
        $data = [];


        $user = User::with('settingsdetail')->findOrFail($user_id);
        $installmentClientDetails = InstallmentClientDetail::where('user_id', '=', $user_id)->get();
        $totalan = TotalAnnualClosing::where('user_id', '=', $user_id)->get();
        $totalmo = TotalMonthlyClosing::where('user_id', '=', $user_id)->get();



        $quant = $installmentClientDetails->count();
        $total_annual_closings = TotalAnnualClosing::where('user_id', '=', $user_id)->get();
        $total_monthly_closings = TotalMonthlyClosing::where('user_id', '=', $user_id)->get();
        $client_installment_detail = InstallmentClientDetail::where('user_id', '=', $user_id)->orderByDesc('client_id')->get();

  

        if($totalan->count()  < 1 and $totalmo->count() < 1) {

            // TotalMonthlyClosing
            $data['total_clients_annual'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                            ->where('payment_date', '!=', null)
                                            ->orderByDesc('year')
                                            ->get()
                                            ->groupBy('year')
                                            ->map(function($vende){
                                            return [
                                                'user_id' => $vende->first()->user_id ?? '-',
                                                'totalan' => $vende->first()->year ?? '-',
                                                'totalmo' => $vende->first()->month ?? '-',
                                                'quanttotal' => $vende->sum(function($colaborator){
                                                    return $colaborator->point;
                                                }),
                                                'total' => $vende->sum(function($colaborator){
                                                    return $colaborator->installment_price;
                                                }),
                                                'totalqt' => $vende->sum(function($num) {
                                                    return $num->quantity_product;
                                                }),
                                            ];
                                        });



            // TotalAnnualClosing
            $data['total_clients_month'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                                ->where('payment_date', '!=', null)
                                                ->get()
                                                ->groupBy('month')
                                                ->map(function($vende){
                                                return [
                                                    'user_id' => $vende->first()->user_id ?? '-',
                                                    'totalan' => $vende->first()->year ?? '-',
                                                    'totalmo' => $vende->first()->month ?? '-',
                                                    'quanttotal' => $vende->sum(function($colaborator){
                                                        return $colaborator->point;
                                                    }),
                                                    'total' => $vende->sum(function($colaborator){
                                                        return $colaborator->installment_price;
                                                    }),
                                                    'totalqt' => $vende->sum(function($num) {
                                                        return $num->quantity_product;
                                                    }),
                                                ];
                                            });



            if($data['total_clients_annual']->count() > 0) {


                foreach($data['total_clients_annual'] as $annual) {

                        $porcent = $conf->percentage / 100;
                        $desc = $annual['total'] * $porcent;
                        $reselleprice  = $annual['total'] - $desc ;

                        $reseller_profit = $annual['total'] * $porcent;
                        if($annual['totalan'] == $datean) {

                            $paya = new TotalAnnualClosing();
                            $paya->user_id = $annual['user_id'];
                            $paya->year = $annual['totalan'];
                            $paya->month = $annual['totalmo'];
                            $paya->product_quantity = $annual['totalqt'];
                            $paya->point = $annual['quanttotal'];
                            $paya->reselle_price = $reselleprice;
                            $paya->magazine_price = $annual['total'];
                            $paya->reseller_profit = $reseller_profit;
                            $paya->save();

                        }

                }
            } else {
                if($data['total_clients_annual']->count() > 0) {
                    foreach($data['total_clients_annual'] as $annual) {

                        $porcent = $conf->ercentage / 100;
                        $desc = $annual['total'] * $porcent;
                        $reselleprice  = $annual['total'] - $desc ;

                        $reseller_profit = $annual['total'] * $porcent;
                        if($annual['totalan'] == $datean) {

                            $paya = TotalAnnualClosing::where('user_id', '=', $user_id)
                                                    ->where('year', '=', $annual['totalan'])
                                                    ->where('month', '=', $annual['totalmo'])
                                                    ->get();
                            $paya->user_id = $annual['user_id'];
                            $paya->year = $annual['totalan'];
                            $paya->month = $annual['totalmo'];
                            $paya->product_quantity = $annual['totalqt'];
                            $paya->point = $annual['quanttotal'];
                            $paya->reselle_price = $reselleprice;
                            $paya->magazine_price = $annual['total'];
                            $paya->reseller_profit = $reseller_profit;
                            $paya->save();

                        }

                    }
                }

            }

            if($data['total_clients_month']->count() > 0) {


                foreach($data['total_clients_month'] as $month) {

                    $porcent = $conf->percentage / 100;
                        $desc = $month['total'] * $porcent;
                        $reselleprice  = $month['total'] - $desc ;

                        $reseller_profit = $month['total'] * $porcent;
                        if($month['totalmo'] == $datemo) {
                            $paym = new TotalMonthlyClosing();
                            $paym->user_id = $month['user_id'];
                            $paym->year = $month['totalan'];
                            $paym->month = $month['totalmo'];
                            $paym->product_quantity = $month['totalqt'];
                            $paym->reselle_price = $reselleprice;
                            $paym->magazine_price = $month['total'];
                            $paym->reseller_profit = $reseller_profit;
                            $paym->save();
                        }


                }
            } else {

                if($data['total_clients_month']->count() > 0) {
                    foreach($data['total_clients_month'] as $month) {

                        $porcent = $conf->percentage / 100;
                            $desc = $month['total'] * $porcent;
                            $reselleprice  = $month['total'] - $desc;

                            $reseller_profit = $month['total'] * $porcent;
                            if($month['totalmo'] == $datemo) {
                                $paym = TotalMonthlyClosing::where('user_id', '=', $user_id)
                                                            ->where('year', '=', $annual['totalan'])
                                                            ->where('month', '=', $annual['totalmo'])
                                                            ->get();
                                $paym->user_id = $month['user_id'];
                                $paym->year = $month['totalan'];
                                $paym->month = $month['totalmo'];
                                $paym->product_quantity = $month['totalqt'];
                                $paym->reselle_price = $reselleprice;
                                $paym->magazine_price = $month['total'];
                                $paym->reseller_profit = $reseller_profit;
                                $paym->save();
                            }


                    }
                }

            }


        }


        //get total Clients (delete at is null)
        $data['total_clients'] = Client::where('user_id', '=', $user_id)
                                        //->whereNull('deleted_at')
                                        ->count();

        //get total clients deleted
        $data['total_clients_deleted'] = Client::where('user_id', '=', $user_id)
                                ->onlyTrashed()->count();

        //get total clients all debt
        $data['total_clients_debt'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                                ->where('payment_date', '=', null)
                                                ->get()->sum(function($cliente){
                                                    return $cliente->installment_price;
                                                });


        $data['total_clients_debt'] = number_format($data['total_clients_debt'], 2, ',', '.');



         //get total clients all debt
        $data['total_debt_installment_by_deve'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                            ->where('payment_date', '=', null)
                                            ->get()->sum(function($cliente){
                                                return $cliente->installment_price;
                                            });


        $data['total_debt_installment_by_deve'] = number_format($data['total_debt_installment_by_deve'], 2, ',', '.');


        //get total clints
        $data['total_clients_per_vende'] = Client::where('user_id', '=', $user_id)
                                            ->withoutTrashed()
                                            ->with('clientdetail', 'clientorderdetail')
                                            ->get()
                                            ->groupBy('user_id')
                                            ->map(function($vende){
                                                return [
                                                    'vende' => $vende->first()->user_id ?? '-',
                                                    'total' => $vende->count(),
                                                ];
                                            });


        // get total product by Clients
        $data['total_product_by_deve'] = AddToCart::where('user_id', '=', $user_id)
                                    ->orderByDesc('code')
                                    ->get()
                                    ->groupBy('client_id')
                                    ->map(function($product) {
                                        return [
                                            'client_id' => $product->first()->client_id ?? '-',
                                            'quant' => $product->sum(function($pro_quant){
                                                return $pro_quant->amount;
                                            }),
                                            'price' => $product->sum(function($price){
                                                return $price->price;
                                            }),
                                            'total' => $product->sum(function($pro_total){
                                                return $pro_total->total_price;
                                            }),
                                            'lucro' => $product->sum(function($lucro,){
                                                $conf = $this->wConf();
                                                $porc = $conf['percentage'] / 100.0;
                                                $totalV = ($porc * $lucro->total_price) ;
                                                return $totalV;
                                            }),
                                        ];
                                    });


        // format product
        $data['total_product_by_deve'] = $data['total_product_by_deve']->map(function($vende){
            return [
                'client_id' => $vende['client_id'],
                'quant' => $vende['quant'],
                'price' => number_format($vende['price'], 2, '.', ','),
                'total' => number_format($vende['total'], 2, '.', ','),
                'lucro' => number_format($vende['lucro'], 2, '.', ','),
            ];
        });


        // get total product lucro
        $data['total_product_lucro'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                    ->where('payment_date', '=', null)
                                    ->get()
                                    ->groupBy('user_id')
                                    ->map(function($vende){
                                    return [
                                        'user_id' => $vende->first()->user_id ?? '-',
                                        'total' => $vende->sum(function($colaborator){
                                            $conf = $this->wConf();
                                            $perc =$conf['percentage'] / 100.0;
                                            $total = ($perc * $colaborator->installment_price ) ;
                                            return $total;
                                        }),
                                    ];
                                });


        // format total product lucrot
        $data['total_product_lucro'] = $data['total_product_lucro']->map(function($vende){
            return [
                'user_id' => $vende['user_id'],
                'total' => number_format($vende['total'], 2, '.', ','),
            ];
        });

        // get total gasto product
        $data['total_gasto_product'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                            ->where('payment_date', '=', null)
                            ->get()
                            ->groupBy('user_id')
                            ->map(function($vende){
                            return [
                                'user_id' => $vende->first()->user_id ?? '-',
                                'total' => $vende->sum(function($colaborator){
                                    $conf = $this->wConf();
                                    $perc =$conf['percentage'] / 100.0;
                                    $total = $colaborator->installment_price - ($perc * $colaborator->installment_price) ;
                                    return $total;
                                }),
        ];
        });



        // format total gasto product
        $data['total_gasto_product'] = $data['total_gasto_product']->map(function($vende){
            return [
            'user_id' => $vende['user_id'],
            'total' => number_format($vende['total'], 2, '.', ','),
            ];
        });


        // get total debt by Clients
        $data['total_debt_by_deve'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                    ->where('payment_date', '=', null)
                                    ->get()
                                    ->groupBy('user_id')
                                    ->map(function($vende){
                                    return [
                                        'user_id' => $vende->first()->user_id ?? '-',
                                        'total' => $vende->sum(function($colaborator){
                                            return $colaborator->installment_price;
                                        }),
                                    ];
                                });

        // format debt
        $data['total_debt_by_deve'] = $data['total_debt_by_deve']->map(function($vende){
            return [
                'user_id' => $vende['user_id'],
                'total' => number_format($vende['total'], 2, '.', ','),
            ];
        });

        // confirmar todas as parcelas dos cliente
        $data['confirm_installment_paid'] = InstallmentClientDetail::where('user_id', '=', $user_id)
                                                    ->get();


        //get total products department
        $data['total_products_per_supplier'] = Product::with('supplier')
                                ->get()
                                ->groupBy('supplier_id')
                                ->map(function($supplier){
                                    return [
                                        'supplier' => $supplier->first()->supplier->supplier ?? '-',
                                        'total' => $supplier->count(),
                                    ];
                                });  
                                     
            $clients = Client::with('clientorderdetail')
                            ->where('user_id', '=', $user_id)
                            ->withoutTrashed()->get();

        // $data['clients'] = Client::all();
        $data['status'] = PurchaseStatu::all();
        
        // Grafico
        $addToCarts = AddToCart::where('user_id', Auth::user()->id)->get();
        $codes = $addToCarts->pluck('code');
        $amounts = $addToCarts->pluck('amount');
        
  
        

        // dd($amounts,$codes);

            return view('adm.resellers.reseller-home', compact('amounts', 'codes', 'conf', 'data','clients', 'total_annual_closings', 'total_monthly_closings', 'client_installment_detail'));
    }
    
     // Riseller setup fɔ wɛbsayt ɛn klaynt saytayshɔn.
     public function wConf()
     {
         $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();
         return $conf;
     }
}