<?php

namespace App\Http\Controllers\Adm\Resellers\Box;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SettingsDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResellerCategoryController extends Controller
{
    //suppliers Table
    public function tableCategory(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $categories = Category::where('user_id','=', Auth::user()->id)->get();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.box-reseller.reseller-categories.table-reseller-categories', compact('conf', 'categories'));

    }

    //suppliers New
    public function addCategory(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o suppliers page');

        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.box-reseller.reseller-categories.add-reseller-categories', compact('conf'));
    }

    //suppliers Edit
    public function editCategory($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');
        
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        $category = Category::where('user_id','=', Auth::user()->id)->findOrFail($id);


        return view('dealers.client-categories.edit-client-categories', compact('conf', 'category'));

    }

    //suppliers Created
    public function createdCategory(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $request->validate([
            'category' => 'required|string|max:40|unique:categories,category',
        ]);

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->category = $request->category;
        $category->save();

        return redirect()->route('adm.resellers.reseller-categories.table-reseller-categories')
                            ->with([
                                'status' => true ,
                                'tipo_alert' => 'success',
                                'icon' => 'fas fa-check-circle',
                                'paricin' => 'text-dark',
                                'mesagem' => 'Esta Categoria foi adicionado com sucesso!',
                            ]);
    }

    //suppliers Updated
    public function updatedCategory(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $request->validate([
            'category' => 'required|string|max:150|unique:categories,category,id',
            'id' => 'required'
        ]);


        $id = $request->id;

        // create update suppliers
        $category = Category::where('user_id','=', Auth::user()->id)->findOrFail($id);
        $category->user_id = Auth::user()->id;
        $category->category = $request->category;
        $category->save();

        return redirect()->route('adm.resellers.reseller-categories.table-reseller-categories')
                                    ->with([
                                        'status' => true ,
                                        'tipo_alert' => 'success',
                                        'icon' => 'fas fa-check-circle',
                                        'paricin' => 'text-dark',
                                        'mesagem' => 'Esta Categoria foi atualizado com sucesso!',
                                    ]);

    }

    //suppliers Show
    public function showCategory($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $category = Category::where('user_id','=', Auth::user()->id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.client-categories.show-client-categories', compact('conf', 'category'));

        
    }

    //suppliers Confirm delete
    public function confDeleteCategory($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $category = Category::where('user_id','=', Auth::user()->id)->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.box-reseller.reseller-categories.confirm-delete-reseller-categories',compact('conf', 'category'));
    }

    //suppliers Delete
    public function deletedCategory(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to suppliers page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $category = Category::where('user_id','=', Auth::user()->id)->findOrFail($id);
        $category->delete();


        return redirect()->route('adm.resellers.reseller-categories.table-reseller-categories')
                            ->with([
                                'status' => true ,
                                'tipo_alert' => 'success',
                                'icon' => 'fas fa-check-circle',
                                'paricin' => 'text-dark',
                                'mesagem' => 'Esta Categoria foi excluido com sucesso!',
                            ]);
    }
}