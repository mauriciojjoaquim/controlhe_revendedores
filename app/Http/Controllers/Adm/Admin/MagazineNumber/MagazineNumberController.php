<?php

namespace App\Http\Controllers\Adm\Admin\MagazineNumber;

use App\Http\Controllers\Controller;
use App\Models\Adm\MagazineNumber\MagazineNumber;
use App\Models\Cor;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MagazineNumberController extends Controller
{
    
    //Magazine Number Table
    public function tableMagazineNumber(): View 
    {

        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $cors = Cor::all();
        $magazineNumbers = magazineNumber::with('supplier')->get();
        $suppliers = Supplier::all();
         

        return view('adm.magazine-number.table-magazine-numbers', compact('suppliers', 'magazineNumbers', 'conf'));

    }
    
    //Magazine Number New
    public function addMagazineNumber(): View
    {

        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $suppliers = Supplier::all();
         
        
        return view('adm.magazine-number.add-magazine-numbers', compact('suppliers', 'conf'));
    }
    
    //Magazine Number Edit
    public function editMagazineNumber($id = null): View 
    {

        $magazineNumber = magazineNumber::findOrFail($id);
        $suppliers = Supplier::all();
         


        return view('adm.magazine-number.edit-magazine-numbers', compact('suppliers', 'magazineNumber', 'conf'));

    }
    
    //Magazine Number Show
    public function showMagazineNumber($id = null): View 
    {

        $magazineNumber = magazineNumber::findOrFail($id);
        
          

        return view('adm.magazine-number.show-magazine-numbers', compact('magazineNumber', 'conf'));
    }
    
    //Magazine Number Show
    public function showTableMagazineNumber(Request $request): View 
    {

        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        if ($request->supplier_id != "Selecione um Fornecedor") {

            $magazineNumbers = magazineNumber::when($request->has('supplier_id'), function ($whenQuery) use ($request){
                $whenQuery->where('supplier_id', '=', $request->supplier_id);
            })
            // ->orderByDesc('number')
            ->paginate(20)
            ->withQueryString();
        } else {

            $magazineNumbers = magazineNumber::paginate(20)
            ->withQueryString();
            
        }

        $suppliers = Supplier::all();
         

        return view('adm.magazine-number.show-table-magazine-numbers', [
                        'suppliers' => $suppliers, 
                        'magazineNumbers' => $magazineNumbers, 
                        'conf' => $conf,
                        'supplier_id' => $request->supplier_id,
                    ]);
    }
    
    //Magazine Number Show
    public function showCustomerMagazineNumber(Request $request): View 
    {

        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        if ($request->supplier_id != "Selecione um Fornecedor") {

            $magazineNumbers = magazineNumber::when($request->has('supplier_id'), function ($whenQuery) use ($request){
                $whenQuery->where('supplier_id', '=', $request->supplier_id);
            })
            // ->orderByDesc('number')
            ->paginate(20)
            ->withQueryString();
        } else {

            $magazineNumbers = magazineNumber::paginate(20)
            ->withQueryString();
            
        }

        $suppliers = Supplier::all();
         

        return view('adm.magazine-number.show-customer-magazine-numbers', [
                        'suppliers' => $suppliers, 
                        'magazineNumbers' => $magazineNumbers, 
                        'conf' => $conf,
                        'supplier_id' => $request->supplier_id,
                    ]);
    }
    
    //Magazine Number Confirm delete
    public function confDeleteMagazineNumber($id = null): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $magazineNumber = magazineNumber::findOrFail($id);



        return view('adm.magazine-number.confirm-delete-magazine-numbers',compact('magazineNumber', 'conf'));
    }

    // Magazine Number activated
    public function activatedMagazineNumber($id = null) : RedirectResponse
    {
        // id MagazineNumber
        $magazineNumberviews = magazineNumber::all();
        $magazineNumberUpd = magazineNumber::findOrFail($id);

        foreach ($magazineNumberviews as $magazineNumber) {
            if($magazineNumber->activated == 1) {
                $magazineNumberUp = magazineNumber::findOrFail($magazineNumber->id);
                $magazineNumberUp->activated = 0;
                $magazineNumberUp->save();
            }
        }
        
        $magazineNumberUpd->activated = 1;
        $magazineNumberUpd->save();

        return redirect()->back();
    }

    // Magazine Number Delete
    public function deletedMagazineNumber(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $magazineNumber = magazineNumber::findOrFail($id);
        $magazineNumber->delete();
        

        return redirect()->route('adm.magazine-numbers.table-magazine-numbers');
    }

    //Magazine Number Created
    public function createdMagazineNumber(Request $request) : RedirectResponse 
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'number' => 'required|',
            'start_date' => 'required|',
            'end_date' => 'required|',
            'supplier_id' => 'required|',
        ]);
        
        // Data mes e ano
        $start_data = $request->start_date;
        $end_data = $request->end_date;
        
        $year = date('Y', strtotime($start_data));
        
        $start_month = date('m', strtotime($start_data));
        $start_day = date('d', strtotime($start_data));
        $start_data = date('d-m', strtotime($start_data));

        $end_month = date('m', strtotime($end_data));
        $end_day = date('d', strtotime($end_data));
        $end_data = date('d-m', strtotime($end_data));

        $magazineNumber = new MagazineNumber();
        $magazineNumber->supplier_id = $request->supplier_id;
        $magazineNumber->number = $request->number;
        $magazineNumber->start_date = $start_data;
        $magazineNumber->end_date = $end_data;
        $magazineNumber->start_day = $start_day;
        $magazineNumber->end_day = $end_day;
        $magazineNumber->start_month = $start_month;
        $magazineNumber->end_month = $end_month;
        $magazineNumber->year = $year;
        $magazineNumber->save();

        return redirect()->route('adm.magazine-numbers.table-magazine-numbers');
    }

    //Magazine Number Updated
    public function updatedMagazineNumber(Request $request) : RedirectResponse 
    {

        // Gate admin 
        $this->canGate('admin');

        
        $request->validate([
            'number' => 'required|',
            'start_date' => 'required|',
            'end_date' => 'required|',
            'supplier_id' => 'required|',
        ]);

        
        $id = $request->id;
    
        // Data mes e ano
        $start_data = $request->start_date;
        $end_data = $request->end_date;

        $year = date('Y', strtotime($start_data));

        $start_month = date('m', strtotime($start_data));
        $start_day = date('d', strtotime($start_data));
        $start_data = date('d-m', strtotime($start_data));

        $end_month = date('m', strtotime($end_data));
        $end_day = date('d', strtotime($end_data));
        $end_data = date('d-m', strtotime($end_data));

        $magazineNumber = MagazineNumber::findOrFail($id);
        $magazineNumber->supplier_id = $request->supplier_id;
        $magazineNumber->number = $request->number;
        $magazineNumber->start_date = $start_data;
        $magazineNumber->end_date = $end_data;
        $magazineNumber->start_day = $start_day;
        $magazineNumber->end_day = $end_day;
        $magazineNumber->start_month = $start_month;
        $magazineNumber->end_month = $end_month;
        $magazineNumber->save();

        return redirect()->route('adm.magazine-numbers.table-magazine-numbers');

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
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to page');
    }
    
}