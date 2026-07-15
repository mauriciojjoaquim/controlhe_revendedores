<?php

namespace App\Http\Controllers\Adm\Admin\Boxs\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SettingsDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
{
    // Table
    public function table(): View
    {

        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $categories = Category::all();
 

        return view('adm.admin.box.categories.table-categories', compact('categories', 'conf'));

    }

    //add
    public function add(): View
    {

        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
 

        return view('adm.admin.box.categories.add-categories', \compact('conf'));
    }

    // Show
    public function show($id = null): View
    {

        //gate
        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $category = Category::findOrFail($id);
 

        return view('adm.admin.box.categories.show-categories', compact('category', 'conf'));
    }

    //Edit
    public function edit($id = null): View
    {

        //gate
        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $category = Category::findOrFail($id);
 


        return view('adm.admin.box.categories.edit-categories', compact('category', 'conf'));

    }

    // Confirm delete
    public function confDelete($id = null) : View|RedirectResponse
    {

        //gate
        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $category = Category::findOrFail($id);
        $products = Product::where('category_id', '=', $id)->get();
 
        if(!empty($products->category_id)) {
            return redirect()->route('adm.categories.table-category');
        }

        return view('adm.admin.box.categories.confirm-delete-categories',compact('category', 'conf'));
    }

    // Created
    public function created(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'category' => 'required|string|max:40|unique:categories,category',
        ]);

        $category = new Category();
        $category->category = $request->category;
        $category->save();

        return redirect()->route('adm.categories.table-category');
    }

    // Updated
    public function updated(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'category' => 'required|string|max:150|unique:categories,category,id',
            'id' => 'required'
        ]);


        $id = $request->id;

        // create update categories
        $category = Category::findOrFail($id);
        $category->category = $request->category;
        $category->save();

        return redirect()->route('adm.categories.table-category');

    }

    //categories Delete
    public function deleted(Request $request) : RedirectResponse
    {

        //gate
        // Gate admin
       $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->delete();


        return redirect()->route('adm.categories.table-category');
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