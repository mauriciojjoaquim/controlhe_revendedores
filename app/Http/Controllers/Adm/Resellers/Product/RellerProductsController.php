<?php

namespace App\Http\Controllers\Adm\Resellers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SettingsDetail;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RellerProductsController extends Controller
{
    //Product Table
    public function tableProduct(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $products = Product::with('supplier', 'category')->where('non_production', '=', 1)->get();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();


        return view('adm.resellers.reseller-products.reseller-products.table-reseller-products', compact('conf', 'products'));

    }

    //Product New
    public function addProduct(): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized o Product page');

        $suppliers = Supplier::all();
        $categories = Category::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-products.reseller-products.add-reseller-products', compact('conf', 'suppliers', 'categories'));
    }

    //Product Edit
    public function editProduct($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $suppliers = Supplier::all();
        $categories = Category::all();
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        $product = Product::with('supplier', 'category')->findOrFail($id);


        return view('adm.resellers.reseller-products.reseller-products.edit-reseller-products', compact('conf', 'product', 'suppliers','categories'));

    }

    //Product Created
    public function createdProduct(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $request->validate([
                'imagem' => 'mimes:jpg,png|max:200|dimensions:min_width=150,min_height=150',
                'name' => 'required|string|max:150|unique:products,name',
                'description' => 'required|string|max:1000|unique:products,description',
                'code' => 'required|string|max:40|unique:products,code',
                'departament' => 'required|string|max:1000|',
                'resale_price' => 'required|decimal:2',
                'percentage' => 'required|string|max:40|',
                'points' => 'required|string|max:40|',
                'supplier_id' => 'required|',
                'category_id' => 'required|',
            ],
            [
                'imagem.mimes' => 'A extenção deve ser png ou jpg',
                'imagem.max' => 'A imagen deve ter no maximo de 200 de caracter, e não deve conter spaços ',
                'name.required' => 'Este campo deve ser preenxido',
                'name.string' => 'Este campo de ser de texto',
                'name.max' => 'Este campo de conter no maximo de 150 caracteres',
                'name.unique' => 'Este cadastro ja esta cadastrado',
                'description.required' => 'Este campo deve ser preenxido',
                'description.string' => 'Este campo de ser de texto',
                'description.max' => 'Este campo de conter no maximo de 1000 caracteres',
                'description.unique' => 'Este cadastro ja esta cadastrado unique:',
                'code.required' => 'Este campo deve ser preenxido',
                'code.string' => 'Este campo de ser de texto',
                'code.max' => 'Este campo de conter no maximo de 40 caracteres',
                'code.unique' => 'Este cadastro ja esta cadastrado',
                'departament.required' => 'Este campo deve ser preenxido',
                'departament.string' => 'Este campo de ser de texto',
                'departament.max' => 'Este campo de conter no maximo de 1000 caracteres',
                'resale_price.required' => 'Este campo deve ser preenxido',
                'percentage.required' => 'Este campo deve ser preenxido',
                'points.required' => 'Este campo deve ser preenxido',
                'supplier_id.required' => 'Este campo deve ser preenxido',
                'category_id.required' => 'Este campo deve ser preenxido',
                'id.required' => 'Este campo deve ser preenxido',
            ]);

        $supplier = Supplier::findOrFail($request->supplier_id);
        $supplier_id =$request->supplier_id;
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

        $ingUrl = 'imagens/products/'. $supplier_id;

        $path = $request->file('imagem')->storeAs($ingUrl,$fileNameToStore);

        $product->photo_url = $fileNameToStore;

        } else {

                $product->photo_url =  '150x150.png';

        }

        $percent = ($request->percentage / 100.0);
        $valorDesc = ($percent * $request->resale_price);
        $valor = ($request->resale_price - $valorDesc);

        $product->user_id = Auth::user()->id;
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

        return redirect()->route('adm.resellers.reseller-products.table-reseller-products')
                                ->with([
                                    'status' => true ,
                                    'tipo_alert' => 'success',
                                    'icon' => 'fas fa-check-circle',
                                    'paricin' => 'text-dark',
                                    'mesagem' => 'Este produto foi adicionado com sucesso!',
                                ]);

    }

    //Product Updated
    public function updatedProduct(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $id = $request->id;

        $request->validate(
            [
                'imagem' => 'mimes:jpg,png|max:200|',
                'name' => 'required|string|max:150|unique:products,id',
                'description' => 'required|string|max:1000|unique:products,id',
                'code' => 'required|string|max:150|unique:products,id',
                'departament' => 'required|string|max:1000|',
                // 'purchase_price' => 'required|decimal:2',
                'resale_price' => 'required|decimal:2',
                'percentage' => 'required|string|max:40|',
                'points' => 'required|string|max:40|',
                'supplier_id' => 'required|',
                'category_id' => 'required|',
                'id' => 'required|',
            ],
            [
                'imagem.mimes' => 'A extenção deve ser mimes:',
                'imagem.max' => 'A imagen deve ter no maximo de max: de caracter, e não deve conter spaços ',
                'imagem.dimensions' => 'As dimençoes não deve utraçar dimensions: !',

                'name.required' => 'Este campo deve ser preenxido',
                'name.string' => 'Este campo de ser de texto',
                'name.max' => 'Este campo de conter no maximo de max: caracteres',
                'name.unique' => 'Este cadastro ja esta cadastrado unique:',

                'description.required' => 'Este campo deve ser preenxido',
                'description.string' => 'Este campo de ser de texto',
                'description.max' => 'Este campo de conter no maximo de max: caracteres',
                'description.unique' => 'Este cadastro ja esta cadastrado unique:',

                'code.required' => 'Este campo deve ser preenxido',
                'code.string' => 'Este campo de ser de texto',
                'code.max' => 'Este campo de conter no maximo de max: caracteres',
                'code.unique' => 'Este cadastro ja esta cadastrado unique:',

                'departament.required' => 'Este campo deve ser preenxido',
                'departament.string' => 'Este campo de ser de texto',
                'departament.max' => 'Este campo de conter no maximo de max: caracteres',

                //'purchase_price.required' => 'Este campo deve ser preenxido',
                'resale_price.required' => 'Este campo deve ser preenxido',
                'percentage.required' => 'Este campo deve ser preenxido',
                'points.required' => 'Este campo deve ser preenxido',
                'supplier_id.required' => 'Este campo deve ser preenxido',
                'category_id.required' => 'Este campo deve ser preenxido',
                'id.required' => 'Este campo deve ser preenxido',
            ]);



        $supplier = Supplier::findOrFail($request->supplier_id);
        $product = Product::findOrFail($id);
        $productadd = Product::findOrFail($id);
        $supplier_id =$request->supplier_id;

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

           $ingUrl = 'imagens/products/'. $supplier_id;

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

        $productadd->user_id = Auth::user()->id;
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

        return redirect()->route('adm.resellers.reseller-products.table-reseller-products')
                            ->with([
                                'status' => true ,
                                'tipo_alert' => 'success',
                                'icon' => 'fas fa-check-circle',
                                'paricin' => 'text-dark',
                                'mesagem' => 'Este produto foi atualizado com sucesso!',
                            ]);
    }

    //Product Show
    public function showProduct($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $product = Product::with('supplier', 'category')->findOrFail($id);
        // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-products.reseller-products.show-reseller-products', compact('conf', 'product'));
    }

    //Product Confirm delete
    public function confDeleteProduct($id): View
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $product = Product::findOrFail($id);
                // Cofigurações do app do vendedor
        $id_user = Auth::user()->id;
        $conf = SettingsDetail::where('user_id', '=', $id_user)->first();

        return view('adm.resellers.reseller-products.reseller-products.confirm-delete-reseller-products',compact('cnfo', 'product'));
    }

    //Product Delete
    public function deletedProduct(Request $request)
    {

        //gate
        Auth::user()->can('vende') ?: abort(403, 'You are not authorized to Product page');

        $request->validate([
            'id' => 'required'
        ]);

        $id = $request->id;
        $product = Product::findOrFail($id);
        $directory = 'imagens/products/'. $product->supplier_id.'/'.$product->photo_url;
        Storage::disk('public')->delete($directory);
        $product->delete();


        return redirect()->route('adm.resellers.reseller-products.table-reseller-products')
                        ->with([
                            'status' => true ,
                            'tipo_alert' => 'success',
                            'icon' => 'fas fa-check-circle',
                            'paricin' => 'text-dark',
                            'mesagem' => 'Este produto foi excluido com sucesso!',
                        ]);
    }
}