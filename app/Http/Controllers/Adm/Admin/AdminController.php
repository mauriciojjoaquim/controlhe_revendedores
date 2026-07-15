<?php


namespace App\Http\Controllers\Adm\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SettingsDetail;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home() : View
    {
    
         // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        // Collect data
        $data = [];

        //get total colaborators (delete at is null)
        $data['total_colaborators'] = User::whereNull('deleted_at')->count();

        //get total colaborators deleted
        $data['total_colaborators_deleted'] = User::onlyTrashed()->count();
        $data['total_produtos'] = Product::all()->count();

        // arecadação do pagamento com vendedor
        $dep = 'vende';
        $countVende = User::where('role', '=', $dep, 'and')->count();
        $valueVede = SettingsDetail::where('department_id', '=', 3)->get();
        $valueLider = SettingsDetail::where('user_id', '=', 4)->get();
        
        $salarioLiders = User::with('detail')->where('department_id', '=', 4)->get(); 
        $Vendes = User::All();

        $countLider = $salarioLiders->count();

        for ($i=0; $i < $countLider; $i++) { 
            $lider = User::with('detail')->where('leader_id', '=', $salarioLiders[$i]->id);
            $countvend = $lider->count();
            $salary = $valueLider[0]->price * $countvend;
            $lideradd = User::with('detail')->findOrFail($salarioLiders[$i]->id);
                $lideradd->detail->update([
                    'salary' => $salary,
                ]);
            
        }
    
        

        
        $data['pagamento_vededores'] = (($valueVede[0]['price'] * $countVende) - $valueVede[0]['price']);
        $data['pagamento_vededores'] = number_format($data['pagamento_vededores'], 2, ',', '.');


        //get total colaborators all salary
        $data['total_colaborators_salary'] = User::withoutTrashed()
                                                        ->with('detail')
                                                        ->get()->sum(function($colaborator){
                                                            return $colaborator->detail->salary;
                                                        });

        $data['total_colaborators_salary'] = number_format($data['total_colaborators_salary'], 2, ',', '.');

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
                                
        //get total colaborators department
        $data['total_colaborators_per_department'] = User::withoutTrashed()
                                                        ->with('department')
                                                        ->get()
                                                        ->groupBy('department_id')
                                                        ->map(function($department){
                                                            return [
                                                                'department' => $department->first()->department->name ?? '-',
                                                                'total' => $department->count(),
                                                            ];
                                                        });
                                                        
        //get total products per supplier
        $data['total_products_per_supplier'] = Product::with('supplier')
                                    ->get()
                                    ->groupBy('supplier_id')
                                    ->map(function($supplier){
                                        return [
                                            'supplier' => $supplier->first()->supplier->supplier ?? '-',
                                            'total' => $supplier->count(),
                                        ];
                                    }); 

        // get total salary by department
        $data['total_salary_by_department'] = User::withoutTrashed()
                                                   ->with('detail', 'department')
                                                   ->get()
                                                   ->groupBy('department_id')
                                                   ->map(function($department){
                                                    return [
                                                        'department' => $department->first()->department->name ?? '-',
                                                        'total' => $department->sum(function($colaborator){
                                                            return $colaborator->detail->salary;
                                                       }),
                                                    ];
                                                });

          // format salary
          $data['total_salary_by_department'] = $data['total_salary_by_department']->map(function($department){
            return [
                'department' => $department['department'],
                'total' => number_format($department['total'], 2, ',', '.'),
            ];
          });


          
        return view('home', compact('data', 'conf'));
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
        return Gate::allows($gateUser) ?: abort(403, 'You are not authorized to customerstockdetail page');
    }
}