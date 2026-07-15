<?php

namespace App\Http\Controllers\Adm\Leaders;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\SettingsDetail;
use Illuminate\View\View;

class LeaderController extends Controller
{
    public function home(): View
        {

            //gate
            Auth::user()->can('lider') ?: abort(403, 'You are not authorized to customerstockdetail page');



            // Collect data
            $data = [];

            //get total vendedors (delete at is null)
            $data['total_vendedors'] = User::where('role', '=', 'vende')
                                            ->where('leader_id', '=', Auth::user()->id)
                                            ->whereNull('deleted_at')->count();

            //get total vendedors deleted
            $data['total_vendedors_deleted'] = User::where('role', '=', 'vende')
                                            ->where('leader_id', '=', Auth::user()->id)
                                            ->onlyTrashed()->count();

            $countvende = $data['total_vendedors'];
            if($countvende >= 100){

                $countvenderes = $countvende - 100;
                $countvendecem = $countvende - $countvenderes;
                $countvendecinco = 5.00 * $countvendecem;
                $countvendedes = 10.00 * $countvendecem;
                $data['total_vendedors_salary'] = $countvendecinco + $countvendedes;

                $user = User::with('detail')->findOrFail(Auth::user()->id);
                $user->detail->salary = $data['total_vendedors_salary'];
                $user->detail->save();
            } else {
                $data['total_vendedors_salary'] =  5.00 * $countvende;
                $user = User::with('detail')->findOrFail(Auth::user()->id);
                $user->detail->salary = $data['total_vendedors_salary'];
                $user->detail->save();
            }

            //get total vendedors all salary
            $data['total_vendedors_salary_vende'] = User::where('role', '=', 'vende')
                                            ->where('leader_id', '=', Auth::user()->id)
                                            ->withoutTrashed()
                                            ->where('role', '=', 'vende')
                                            ->where('leader_id', '=', Auth::user()->id)
                                            ->with('detail')
                                            ->get()->sum(function($vendedor){
                                                return $vendedor->detail->salary;
                                            });


        $data['total_vendedors_salary'] = number_format($data['total_vendedors_salary'], 2, ',', '.');

        //get total vendedors department
        $data['total_vendedors_per_department'] = User::where('role', '=', 'vende')
                                            ->where('leader_id', '=', Auth::user()->id)
                                            ->withoutTrashed()
                                            ->with('department')
                                            ->get()
                                            ->groupBy('department_id')
                                            ->map(function($department){
                                                return [
                                                    'department' => $department->first()->department->name ?? '-',
                                                    'total' => $department->count(),
                                                ];
                                            });

        // get total salary by department
        $data['total_salary_by_department'] = User::where('role', '=', 'vende')
                                    ->where('leader_id', '=', Auth::user()->id)
                                    ->withoutTrashed()
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

            // dd($data);
            $conf = SettingsDetail::findOrFail(Auth::user()->id);

            return view('leadership.home', compact('data', 'conf'));
        }

}