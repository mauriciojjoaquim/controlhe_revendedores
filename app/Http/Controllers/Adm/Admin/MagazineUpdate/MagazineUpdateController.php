<?php

namespace App\Http\Controllers\Adm\Admin\MagazineUpdate;

use App\Http\Controllers\Controller;
use App\Models\Adm\MagazineNumber\MagazineNumber;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;


class MagazineUpdateController extends Controller
{

    // Conirmedf
    public function confirmedMagazineUpdateProduct($id = null) : RedirectResponse
    {

    // dd($request);
    $productadd = Product::findOrFail($id);

    if($productadd->confirmed == 1) {
        $productadd->confirmed = 0;
    } else {
        $productadd->confirmed = 1;
    }
    $productadd->save();

        return redirect()->back();
    }

    // non_production
    public function nonProductionMagazineUpdateProduct($id = null) : RedirectResponse
    {

    // dd($request);
    $productadd = Product::findOrFail($id);

    if($productadd->non_production == 1) {
        $productadd->non_production = 0;
    } else {
        $productadd->non_production = 1;
    }
    $productadd->save();

        return redirect()->back();
    }
    
    //Product Table
    public function tableMagazineUpdateProduct(Request $request) : View|RedirectResponse
    {

        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        // Data mes e ano
        $data = now();
        $year = date('Y', strtotime($data));
        $month = date('m', strtotime($data));
        $day = date('d', strtotime($data));
        $t_data = date('d-m', strtotime($data));

  
        $suppliers = Supplier::all();


        
        $magazineUpdate = MagazineNumber::where('activated', '=', 1)->first();

        // dd($year, $month, $day, $t_data, $magazineUpdate['start_date'], $magazineUpdate['end_date']);

        if ($request->supplier_id != "Selecione um Fornecedor" || $request->code != null) {

            $products = Product::when($request->has('code'), function ($whenQuery) use ($request){
                $whenQuery->where('code', 'like', '%'.$request->code.'%');
            })
            ->when($request->filled('supplier_id'), function ($whenQuery) use ($request){
                $whenQuery->where('supplier_id', '=', $request->supplier_id);
            })
            ->orderByDesc('code')
            ->paginate(10)
            ->withQueryString();
        } else {

            $products = Product::orderByDesc('code')
            ->paginate(10)
            ->withQueryString();
            
        }

        return view('adm.magazine-update-products.table-magazine-update-products', [
                        'suppliers' => $suppliers,
                        'magazineUpdate' => $magazineUpdate,
                        'products' => $products,
                        'conf' => $conf,
                        'code' => $request->code,
                        'supplier_id' => $request->supplier_id,
                    ]);

    }

    //Product Updated
    public function updatedMagazineUpdateProduct(Request $request) : RedirectResponse
    {

        $request->validate([
            'resale_price' => 'required|decimal:2',
            'percentage' => 'required|string|max:40|',
            'magazine_number' => 'required|string|max:40|',
            'id' => 'required|',
        ]);


        $id = $request->id;
        // dd($request);
        $productadd = Product::findOrFail($id);

        // calculo da para ver valor a paga na compra
        $percent = ($request->percentage / 100);
        $valorDesc =($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);


        $productadd->purchase_price = $valor;
        $productadd->resale_price = $request->resale_price;
        $productadd->percentage = $request->percentage;
        $productadd->magazine_number = $request->magazine_number;
        $productadd->save();

        return redirect()->back();
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