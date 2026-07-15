<?php

use App\Http\Controllers\Adm\Admin\AdminController;
use App\Http\Controllers\Adm\Admin\Colaborators\ColaboratorsController;
use App\Http\Controllers\Adm\Admin\Colaborators\ProfileUserController;
use App\Http\Controllers\Adm\ConfirmAccount\ConfirmAccountController;
use App\Http\Controllers\Adm\Customers\CustomersController;
use App\Http\Controllers\Adm\Leaders\LeaderController;
use App\Http\Controllers\Adm\Resellers\reseller\ResellerProductController;
use App\Http\Controllers\Adm\Resellers\ResellerController;
use App\Http\Controllers\Adm\Rh\Colaborators\RhMagementUserController;
 use App\Http\Controllers\Adm\Admin\Customers\AdmCustomersController;
use App\Http\Controllers\Adm\Admin\MagazineNumber\MagazineNumberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function() {
    //Email confirmation account colaborator
    Route::get('/colaborator/rh/confirm-account/{token}', [ConfirmAccountController::class, 'confirmAccount'])->name('colaborators.rh.confirm-account');
    Route::post('/update-confirm-account/', [ConfirmAccountController::class, 'updateConfirmAccount'])->name('update-confirm-account');
    Route::get('/welcome/{id}', [ConfirmAccountController::class, 'welcome'])->name('welcome');
});

Route::middleware('auth')->group(function(){
    Route::redirect('/', 'home');
    Route::get('/home', function(){
        // ccheck if user is admin
        if(Auth::user()->role === 'admin') {
            return redirect()->route('admin.home');
        }elseif(Auth::user()->role === 'rh') {
           return redirect()->route('colaborators.colaborator.colaborators-manager');
        } elseif(Auth::user()->role === 'colaborator') {
            return redirect()->route('colaborator.home');
        } elseif(Auth::user()->role === 'vende') {
            return redirect()->route('reseller.home');
        } elseif(Auth::user()->role === 'lider') {
            return redirect()->route('leadership.home');
        } elseif(Auth::user()->role === 'client') {
            return redirect()->route('customers.home');
        } else {
            return redirect()->route('login');
        }
    })->name('home');

    // HOMES PAGES
    Route::get('/adm/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/adm/leadership/home', [LeaderController::class, 'home'])->name('leadership.home');
    Route::get('/adm/customers/home', [CustomersController::class, 'home'])->name('customers.home');
    Route::get('/adm/resellers/home', [ResellerController::class, 'home'])->name('reseller.home');
    Route::get('/adm/colaborator/home', [ColaboratorsController::class, 'home'])->name('colaborator.home');





    // ADM USER PROFILE
    Route::get('/adm/user/profile', [ProfileUserController::class, 'index'])->name('user.profile');
    Route::get('/adm/user/profile-setting/{id}', [ProfileUserController::class, 'setting'])->name('user.profile-setting');
    Route::post('/adm/user/profile/update-password', [ProfileUserController::class, 'updatePassword'])->name('user.profile.update-password');
    Route::post('/adm/user/profile/update-user-data', [ProfileUserController::class, 'updateUserData'])->name('user.profile.update-user-data');
    Route::post('/adm/user/profile/update-user-detail', [ProfileUserController::class, 'updateUserDetail'])->name('user.profile.update-user-detail');
    Route::post('/adm/user/profile/update-user-setting', [ProfileUserController::class, 'updatedSetting'])->name('user.profile.update-user-setting');

     // ADM RH COLABORATOR MANAGE PAGES
     Route::get('/adm/rh/colaborators/colaborators-manager', [RhMagementUserController::class, 'colaboratorsManager'])->name('colaborators.colaborator.colaborators-manager');
     Route::get('/adm/rh/colaborators/new-colaborators-manager', [RhMagementUserController::class, 'newColaboratorsManager'])->name('colaborators.colaborator.new-colaborators-manager');
     Route::post('/adm/rh/colaborators/create-colaborators-manager', [RhMagementUserController::class, 'createColaboratorsManager'])->name('colaborators.colaborator.create-colaborators-manager');
     Route::get('/adm/rh/colaborators/edit-colaborators-manager/{id}', [RhMagementUserController::class, 'editColaboratorsManager'])->name('colaborators.colaborator.edit-colaborators-manager');
     Route::post('/adm/rh/colaborators/update-colaborators-manager/', [RhMagementUserController::class, 'updateColaboratorsManager'])->name('colaborators.colaborator.update-colaborators-manager');
     Route::get('/adm/rh/colaborators/detail-colaborators-manager/{id}', [RhMagementUserController::class, 'detailColaboratorsManager'])->name('colaborators.colaborator.detail-colaborators-manager');
     Route::get('/adm/rh/colaborators/confirm-delete-colaborators-manager/{id}', [RhMagementUserController::class, 'delColaboratorsManager'])->name('colaborators.colaborator.del-colaborators-manager');
     Route::post('/adm/rh/colaborators/delete-colaborators-manager/', [ColaboratorsController::class, 'deleteColaboratorsManager'])->name('colaborators.colaborator.delete-colaborators-manager');
     Route::get('/adm/rh/colaborators/retore-colaborators-manager/{id}', [RhMagementUserController::class, 'restoreColaboratorsManager'])->name('colaborators.colaborator.retore-colaborators-manager');


    // ADM RESELLER PRODUCT PAGES
    Route::get('/adm/dealers/reseller-products/table-client-product', [ResellerProductController::class, 'tableProduct'])->name('admin.dealers.client-products.table-client-product');
    Route::get('/adm/dealers/reseller-products/add-client-product', [ResellerProductController::class, 'addProduct'])->name('admin.dealers.client-products.add-client-product');
    Route::get('/adm/dealers/reseller-products/edit-client-product/{id}', [ResellerProductController::class, 'editProduct'])->name('admin.dealers.client-products.edit-client-product');
    Route::get('/adm/dealers/reseller-products/conf-delete-client-product/{id}', [ResellerProductController::class, 'confDeleteProduct'])->name('admin.dealers.client-products.conf-delete-client-product');
    Route::get('/adm/dealers/reseller-pPAGESroducts/show-client-product/{id}', [ResellerProductController::class, 'showProduct'])->name('admin.dealers.client-products.show-client-product');
    Route::post('/adm/dealers/reseller-products/created-client-product', [ResellerProductController::class, 'createdProduct'])->name('admin.dealers.client-products.created-client-product');
    Route::post('/adm/dealers/reseller-products/updated-client-product', [ResellerProductController::class, 'updatedProduct'])->name('admin.dealers.client-products.updated-client-product');
    Route::post('/adm/dealers/reseller-products/deleted-client-product', [ResellerProductController::class, 'deletedProduct'])->name('admin.dealers.client-products.deleted-client-product');

    // CUSTOMERS PAGES
    // ADM CUSTOMERS PAGES
    // Route::get('/adm/customers/table-installment-client-detail', [CustomersController::class, 'tableInstallmentClientDetail'])->name('client-dealer.table-installment-client-detail');
    // Route::get('/adm/customers/add-installment-client-detail', [CustomersController::class, 'addInstallmentClientDetail'])->name('client-dealer.add-installment-client-detail');
    // Route::get('/adm/customers/online-installment-client-detail/{id}', [CustomersController::class, 'onlineInstallmentClientDetail'])->name('client-dealer.online-installment-client-detail');
    // Route::get('/adm/customers/cart-installment-client-detail/{id}', [CustomersController::class, 'cartInstallmentClientDetail'])->name('client-dealer.cart-installment-client-detail');
    // Route::get('/adm/customers/confirma-cart-payment-detail/{id}', [CustomersController::class, 'confirmaCartPayment'])->name('client-dealer.confirma-cart-payment-detail');
    // Route::get('/adm/customers/client-confirma-cart-payment-detail/{id}', [CustomersController::class, 'clientConfirmaCartPayment'])->name('client-dealer.client-confirma-cart-payment-detail');
    // Route::get('/adm/customers/edit-installment-client-detail/{id}', [CustomersController::class, 'editInstallmentClientDetail'])->name('client-dealer.edit-installment-client-detail');
    // Route::get('/adm/customers/conf-delete-installment-client-detail/{id}', [CustomersController::class, 'confDeleteInstallmentClientDetail'])->name('client-dealer.conf-delete-installment-client-detail');
    // Route::get('/adm/customers/show-installment-client-detail/{id}', [CustomersController::class, 'showInstallmentClientDetail'])->name('client-dealer.show-installment-client-detail');
    // Route::get('/adm/customers/qr-installment-pix-client-detail/{id}', [CustomersController::class, 'qrInstallmentPixClientDetail'])->name('client-dealer.qr-installment-pix-client-detail');
    // Route::post('/adm/customers/created-installment-client-detail', [CustomersController::class, 'createdInstallmentClientDetail'])->name('client-dealer.created-installment-client-detail');
    // Route::post('/adm/customers/updated-installment-client-detail', [CustomersController::class, 'updatedInstallmentClientDetail'])->name('client-dealer.updated-installment-client-detail');
    // Route::post('/adm/customers//deleted-installment-client-detail', [CustomersController::class, 'deletedInstallmentClientDetail'])->name('client-dealer.deleted-installment-client-detail');
    // Route::post('/adm/customers/cart-shopping-clients', [CustomersController::class, 'cartShopping'])->name('client-dealer.cart-shopping-clients');
    // Route::post('/adm/customers/addToCart', [CustomersController::class, 'addToCart'])->name('client-dealer.add-to-cart');
    // Route::post('/adm/customers/closingToCart', [CustomersController::class, 'closingToCart'])->name('client-dealer.closing-to-cart');
    // Route::post('/adm/customers/client-confirma-form-payment-detail/', [CustomersController::class, 'clientConfirmaFormPayment'])->name('client-dealer.client-confirma-form-payment-detail');

    Route::get('/adm/resellers/reseller-installment-detail/online-reseller-installment-detail/{id}', [CustomersController::class, 'onlineInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.online-reseller-installment-detail');

   
      // ADM CUSTOMERS
      Route::get('/adm/resellers/customers/table-vende-clients', [AdmCustomersController::class, 'tableClient'])->name('admin.dealers.clients.client.table-vende-clients');
      Route::get('/adm/resellers/customers/add-vende-clients', [AdmCustomersController::class, 'addClient'])->name('admin.dealers.clients.client.add-vende-clients');
      Route::get('/adm/resellers/customers/edit-vende-clients/{id}', [AdmCustomersController::class, 'editClient'])->name('admin.dealers.clients.client.edit-vende-clients');
      Route::get('/adm/resellers/customers/conf-delete-vende-clients/{id}', [AdmCustomersController::class, 'confDeleteClient'])->name('admin.dealers.clients.client.conf-delete-vende-clients');
      Route::get('/adm/resellers/customers/show-vende-clients/{id}', [AdmCustomersController::class, 'showClient'])->name('admin.dealers.clients.client.show-vende-clients');
      Route::post('/adm/resellers/customers/created-vende-clients', [AdmCustomersController::class, 'createdClient'])->name('admin.dealers.clients.client.created-vende-clients');
      Route::post('/adm/resellers/customers/client/updated-vende-clients', [AdmCustomersController::class, 'updatedClient'])->name('admin.dealers.clients.client.updated-vende-clients');
      Route::post('/adm/resellers/customers/deleted-vende-clients', [AdmCustomersController::class, 'deletedClient'])->name('admin.dealers.clients.client.deleted-vende-clients');
  
  
    // ADM RESELLER PRODUCT PAGES
    Route::get('/adm/magazine-numbers/table-magazine-numbers', [MagazineNumberController::class, 'tableMagazineNumber'])->name('adm.magazine-numbers.table-magazine-numbers');
    Route::get('/adm/magazine-numbers/show-table-magazine-numbers', [MagazineNumberController::class, 'showTableMagazineNumber'])->name('adm.magazine-numbers.show-table-magazine-numbers');
    Route::get('/adm/magazine-numbers/show-custome-magazine-numbers', [MagazineNumberController::class, 'showCustomerMagazineNumber'])->name('adm.magazine-numbers.show-custome-magazine-numbers');
    Route::get('/adm/magazine-numbers/add-magazine-numbers', [MagazineNumberController::class, 'addMagazineNumber'])->name('adm.magazine-numbers.add-magazine-numbers');
    Route::get('/adm/magazine-numbers/edit-magazine-numbers/{id}', [MagazineNumberController::class, 'editMagazineNumber'])->name('adm.magazine-numbers.edit-magazine-numbers');
    Route::get('/adm/magazine-numbers/activated-magazine-numbers/{id}', [MagazineNumberController::class, 'activatedMagazineNumber'])->name('adm.magazine-numbers.activated-magazine-numbers');
    Route::get('/adm/magazine-numbers/conf-delete-magazine-numbers/{id}', [MagazineNumberController::class, 'confDeleteMagazineNumber'])->name('adm.magazine-numbers.conf-delete-magazine-numbers');
    Route::get('/adm/magazine-numbers/show-magazine-numbers/{id}', [MagazineNumberController::class, 'showMagazineNumber'])->name('adm.magazine-numbers.show-magazine-numbers');
    Route::post('/adm/magazine-numbers/created-magazine-numbers', [MagazineNumberController::class, 'createdMagazineNumber'])->name('adm.dealers.client-products.created-magazine-numbers');
    Route::post('/adm/magazine-numbers/updated-magazine-numbers', [MagazineNumberController::class, 'updatedMagazineNumber'])->name('adm.magazine-numbers.updated-magazine-numbers');
    Route::post('/adm/magazine-numbers/deleted-magazine-numbers', [MagazineNumberController::class, 'deletedMagazineNumber'])->name('adm.magazine-numbers.deleted-magazine-numbers');



   
   // ROUTE ADM SITE INICIO
   require __DIR__.'/adm.php';
   
   // ROUTE RESELLE SITE INICIO
   require __DIR__.'/reselle.php';
   
    // ROUTE LEADER SITE INICIO
    require __DIR__.'/laeder.php';
    
    // ROUTE CUSTOMER SITE INICIO 
    require __DIR__.'/customer.php';


});