<?php

namespace App\Http\Controllers\Adm\Resellers\reseller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class ProductSaleCustomerController extends Controller
{
    //Product Table
    public function tableProductSale(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $products = Product::with('supplier', 'category')->where('non_production', '=', 1)->get();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.products.product-sales.table-products', compact('conf', 'products'));

    }

    //Product New
    public function addProductSale(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o Product page');

        $suppliers = Supplier::all();
        $categories = Category::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.products.product-sales.add-products', compact('conf', 'suppliers', 'categories'));
    }

    //Product Edit
    public function editProductSale($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $suppliers = Supplier::all();
        $categories = Category::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        $product = Product::with('supplier', 'category')->findOrFail($id);


        return view('dealers.products.product-sales.edit-products', compact('conf', 'product', 'suppliers','categories'));

    }

    //Product Created
    public function createdProductSale(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:200|dimensions:min_width=150,min_height=150',
            'name' => 'required|string|max:150|unique:products,name',
            'description' => 'required|string|max:1000|unique:products,description',
            'code' => 'required|string|max:40|unique:products,code',
            'departament' => 'required|string|max:150|',
            // 'purchase_price' => 'required|decimal:2',
            'resale_price' => 'required|decimal:2',
            'percentage' => 'required|string|max:40|',
            'points' => 'required|string|max:40|',
            'supplier_id' => 'required|',
            'category_id' => 'required|',
        ]);

        $supplier = Supplier::findOrFail($request->supplier_id);
        $product = new Product();

        //Hasndle File upload
        if($request->hasFile('imagem')){
           // Get filename with the extensuon
           $filenameWithExt = $request->file('imagem')->getClientOriginalName();
           // Get just filename
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get just Ext
           $extension = $request->file('imagem')->getClientOriginalExtension();
           // File to store
           $fileNameToStore = $filename .'_'.time().'.'. $extension;
           // upload image
           $extension = $request->file('imagem')->getClientOriginalExtension();
           $extension = $request->file('imagem')->getClientOriginalExtension();

           $ingUrl = 'app/public/imagens/products/'. $supplier->supplier;

           $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

           $product->photo_url = $fileNameToStore;

        } else {

                $product->photo_url =  '150x150.png';
 
        }

        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);

        $product->supplier_id = $request->supplier_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->departament = $request->departament;
        $product->purchase_price = $valor;
        $product->resale_price = $request->resale_price;
        $product->percentage = $request->percentage;
        $product->code = $request->code;
        $product->points = $request->points;
        $product->save();

        return redirect()->route('admin.dealers.clients.product-clients.table-product');

    }

    //Product Updated
    public function updatedProductSale(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');
        
        $id = $request->id;

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:200|dimensions:min_width=150,min_height=150',
            'name' => 'required|string|max:150|unique:products,id',
            'description' => 'required|string|max:1000|unique:products,id',
            'code' => 'required|string|max:150|unique:products,id',
            'departament' => 'required|string|max:150|',
            // 'purchase_price' => 'required|decimal:2',
            'resale_price' => 'required|decimal:2',
            'percentage' => 'required|string|max:40|',
            'points' => 'required|string|max:40|',
            'supplier_id' => 'required|',
            'category_id' => 'required|',
            'id' => 'required|',
        ]);

 

        $supplier = Supplier::findOrFail($request->supplier_id);
        $product = Product::findOrFail($id);
        $productadd = Product::findOrFail($id);

        //Hasndle File upload
        if($request->hasFile('imagem')){
           // Get filename with the extensuon
           $filenameWithExt = $request->file('imagem')->getClientOriginalName();
           // Get just filename
           $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
           //Get just Ext
           $extension = $request->file('imagem')->getClientOriginalExtension();
           // File to store
           $fileNameToStore = $filename .'_'.time().'.'. $extension;
           // upload image
           $extension = $request->file('imagem')->getClientOriginalExtension();
           $extension = $request->file('imagem')->getClientOriginalExtension();

           $ingUrl = 'app/public/imagens/products/'. $supplier->supplier;

           $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

           $productadd->photo_url = $fileNameToStore;

        } else {

            if($product->photo_url == null) {
                $productadd->photo_url =  '150x150.png';
            }

        }

        $percent = ($request->percentage / 100);
        $valorDesc =($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);

        $productadd->supplier_id = $request->supplier_id;
        $productadd->category_id = $request->category_id;
        $productadd->name = $request->name;
        $productadd->description = $request->description;
        $productadd->departament = $request->departament;
        $productadd->purchase_price = $valor;
        $productadd->resale_price = $request->resale_price;
        $productadd->percentage = $request->percentage;
        $productadd->code = $request->code;
        $productadd->points = $request->points;
        $productadd->save();

        return redirect()->route('admin.dealers.clients.product-clients.table-product-clients');
    }

    //Product Show
    public function showProductSale($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $product = Product::with('supplier', 'category')->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.products.product-sales.show-products', compact('cnfo', 'product'));
    }

    //Product Confirm delete
    public function confDeleteProductSale($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $product = Product::findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('dealers.products.product-sales.confirm-delete-products',compact('conf', 'product'));
    }

    //Product Delete
    public function deletedProductSale(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $product = Product::findOrFail($id);
        $product->delete();


        return redirect()->route('admin.dealers.clients.product-clients.table-product');
    }
}