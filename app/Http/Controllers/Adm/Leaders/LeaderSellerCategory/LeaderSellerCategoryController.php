<?php

namespace App\Http\Controllers\Adm\Leaders\LeaderSellerCategory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SettingsDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderSellerCategoryController extends Controller
{
    //categories Table
    public function tableLeaderCategory(): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');

        $categories = Category::all();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();

        return view('adm.leaders.box-leader-seller.leader-seller-category.table-leader-seller-categories', compact('categories', 'conf'));

    }
    
    //categories New
    public function addLeaderCategory(): View
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized o categories page');
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();
        
        return view('adm.leaders.box-leader-seller.leader-seller-category.add-leader-seller-categories', \compact('conf'));
    }
    
    //categories Edit
    public function editLeaderCategory($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');

        $category = Category::findOrFail($id);
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();


        return view('adm.leaders.box-leader-seller.leader-seller-category.edit-leader-seller-categories', compact('category', 'conf'));

    }
    
    //categories Created
    public function createdLeaderCategory(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');
        
        $request->validate([
            'category' => 'required|string|max:40|unique:categories,category',
        ]);

        $category = new Category();
        $category->category = $request->category;
        $category->save();

        return redirect()->route('adm.categories.table-category');
    }

    //categories Updated
    public function updatedLeaderCategory(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');
        
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
    
    //categories Show
    public function showLeaderCategory($id): View 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');
        
        $category = Category::findOrFail($id);
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();

        return view('adm.leaders.box-leader-seller.leader-seller-category.show-leader-seller-categories', compact('category', 'conf'));
    }
    
    //categories Confirm delete
    public function confDeleteLeaderCategory($id)
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');

        $category = Category::findOrFail($id);
        $products = Product::where('category_id', '=', $id)->get();
        $conf = SettingsDetail::where('user_id', '=', Auth::user()->id)->first();
        if(!empty($products->category_id)) {
            return redirect()->route('adm.categories.table-category');
        }

        return view('adm.leaders.box-leader-seller.leader-seller-category.confirm-delete-leader-seller-categories',compact('category', 'conf'));
    }

    //categories Delete
    public function deletedLeaderCategory(Request $request) 
    {

        //gate
        Auth::user()->can('lider') ?: abort(403, 'You are not authorized to categories page');
        
        $request->validate([
            'id' => 'required'
        ]);
        
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->delete();
        

        return redirect()->route('adm.categories.table-category');
    }
}