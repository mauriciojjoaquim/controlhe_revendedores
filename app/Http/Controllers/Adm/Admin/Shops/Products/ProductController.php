<?php

namespace App\Http\Controllers\Adm\Admin\Shops\Products;

use App\Http\Controllers\Controller;
use App\Models\Adm\MagazineNumber\MagazineNumber;
use App\Models\Category;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    //Product Table
    public function table(): View
    {

        // gate
        //  

        
        $products = Product::with('supplier', 'category')->where('non_production', '=', 1)->get();
         

        
        return view('adm.admin.products.table-products', compact('products', 'conf'));

    }

    //Product New
    public function add(): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        Auth::user()->can('admin') ?: abort(403, 'You are not authorized o Product page');

        $suppliers = Supplier::all();
        $categories = Category::orderByDesc('category')->get();
         

        return view('adm.admin.products.add-products', compact('suppliers', 'categories', 'conf'));
    }

    //Product Edit
    public function edit($id = null): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $suppliers = Supplier::all();
        $categories = Category::orderByDesc('category')->get();
         

        $product = Product::with('supplier', 'category')->findOrFail($id);


        return view('adm.admin.products.edit-products', compact('product', 'suppliers','categories', 'conf'));

    }

    //Product Show
    public function show($id = null): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $product = Product::with('supplier', 'category')->findOrFail($id);
         

        return view('adm.admin.products.show-products', compact('product', 'conf'));
    }

    //Product Confirm delete
    public function confDelete($id = null): View
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $product = Product::findOrFail($id);
         

        return view('adm.admin.products.confirm-delete-products',compact('product', 'conf'));
    }
    public function statusConfirmed($id = null) 
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $product = Product::findOrFail($id);
        
        if($product->confirmed == 1) {
            $product->confirmed = 0;
        } else{
            $product->confirmed = 1;
        } 
        $product->save();
        
        return redirect()->back();
    }
    
     public function statusNonProduction($id = null) : RedirectResponse 
    {
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         
        
        $product = Product::findOrFail($id);
        
        if($product->non_production == 1) {
            $product->non_production = 0;
        } else{
            $product->non_production = 1;
        } 
        $product->save();
        
        return redirect()->back();
        
    }

    //Product Created
    public function created(Request $request) : RedirectResponse
    {
        
        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
            


        $request->validate([
            'imagem' => 'mimes:jpg,png|max:200|dimensions:min_width=150,min_height=150',
            'name' => 'required|string|max:150|unique:products,name',
            'description' => 'required|string|max:1000',
            'code' => 'required|string|max:40|unique:products,code',
            'departament' => 'required|string|max:150|',
            // 'purchase_price' => 'required|decimal:2',
            'resale_price' => 'required|decimal:2',
            'percentage' => 'required|string|max:40|',
            'points' => 'required|string|max:40|',
            'supplier_id' => 'required|',
            'category_id' => 'required|',
            // 'confirmed' => 'required|',
            // 'non_production' => 'required|'
        ]);

        if($request->category_id == 0 || $request->supplier_id == 0) {
            return redirect()->back();
        }
        
        $cicleNumber = MagazineNumber::where('activated', '=', 1)->first();
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

            $ingUrl = 'imagens/products/'. $request->supplier_id;

            $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

            $product->photo_url = $fileNameToStore;

        } else {

                $product->photo_url =  '150x150.png';

        }
        
        if($request->confirmed == 'on') {
            $product->confirmed = 1;
        } else {
            $product->confirmed = 0;
        }
        if($request->non_production == 'on') {
            $product->non_production = 1;
        } else {
            $product->non_production = 0;
        }

        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);

        $product->magazine_number = $cicleNumber->number;
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

        return redirect()->route('adm.products.table-product');

    }
 
    //Product Updated
    public function updated(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
        
        
        $id = $request->id;

        $request->validate([
            'imagem' => 'mimes:jpg,png|max:200|dimensions:min_width=150,min_height=150',
            'name' => 'required|string|max:150|unique:products,'.$id,
            'description' => 'required|string|max:1000',
            'code' => 'required|string|max:150|unique:products,'.$id,
            'departament' => 'required|string|max:150|',
            // 'purchase_price' => 'required|decimal:2',
            'resale_price' => 'required|decimal:2',
            'percentage' => 'required|string|max:40|',
            'points' => 'required|string|max:40|',
            'supplier_id' => 'required|',
            'category_id' => 'required|',
            'id' => 'required|',
            //'confirmed' => 'required|',
            // 'non_production' => 'required|',
        ]);


        if($request->category_id == 0 || $request->supplier_id == 0) {
            return redirect()->back();
        }
        $cicleNumber = MagazineNumber::where('activated', '=', 1)->first();
        
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

            $ingUrl = 'imagens/products/'. $request->supplier_id;

            $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

            $productadd->photo_url = $fileNameToStore;

        } else {

            if($product->photo_url == null) {
                $productadd->photo_url =  '150x150.png';
            }

        }

        if($request->confirmed == 'on') {
            $productadd->confirmed = 1;
        } else {
            $productadd->confirmed = 0;
        }
        if(!empty($request->non_production)) {
            if($request->non_production == 'on') {
                $productadd->non_production = 1;
            } else {
                $productadd->non_production = 0;
            }
        } else {
            $productadd->non_production = 0;
        }
        

        $percent = ($request->percentage / 100);
        $valorDesc =($percent * $request->resale_price); 
        $valor = ($request->resale_price - $valorDesc);

        $productadd->magazine_number = $cicleNumber->number;
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

        return redirect()->route('adm.products.table-product');
    }

       //Product Delete
    public function deleted(Request $request) : RedirectResponse
    {

        // Gate admin 
        $this->canGate('admin');
        // cofiguração das paginas
        $conf = $this->configPageAdm();
         

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $product = Product::findOrFail($id);
        $directory = 'imagens/products/'. $product->supplier_id.'/'.$product->photo_url;
        Storage::disk('public')->delete($directory);
        $product->delete();


        return redirect()->route('adm.products.table-product')->with([
                                'status' => true ,
                                'tipo_alert' => 'success',
                                'icon' => 'fas fa-check-circle',
                                'paricin' => 'text-dark',
                                'mesagem' => 'Este produto foi excluido com sucesso!',
                            ]);
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