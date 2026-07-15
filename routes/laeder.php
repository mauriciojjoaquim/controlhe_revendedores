<?php

use App\Http\Controllers\Adm\Leaders\LeaderSeller\LeaderSellerController;
use App\Http\Controllers\Adm\Leaders\LeaderSellerCategory\LeaderSellerCategoryController;
use App\Http\Controllers\Adm\Leaders\LeaderSellerProduct\LeaderSellerProductController;
use App\Http\Controllers\Adm\Leaders\LeaderSellerSetting\LeaderSellerSettingController;
use App\Http\Controllers\Adm\Leaders\LeaderSellerSuppliers\LeaderSellerSuppliersController;
use Illuminate\Support\Facades\Route;


    // ADM leaders PAGES
    Route::get('/adm/leaders/leader-seller/table-leader-seller', [LeaderSellerController::class, 'tableLeaderSeller'])->name('adm.leaders.leader-seller.table-leader-seller');
    Route::get('/adm/leaders/leader-seller/add-leader-sellers', [LeaderSellerController::class, 'addLeaderSeller'])->name('adm.leaders.leader-seller.add-leader-seller');
    Route::get('/adm/leaders/leader-seller/edit-leader-sellers/{id}', [LeaderSellerController::class, 'editLeaderSeller'])->name('adm.leaders.leader-seller.edit-leader-seller');
    Route::get('/adm/leaders/leader-seller/conf-delete-vendedors/{id}', [LeaderSellerController::class, 'confDeleteSeller'])->name('adm.leaders.leader-seller.conf-delete-leader-seller');
    Route::get('/adm/leaders/leader-seller/show-leader-sellers/{id}', [LeaderSellerController::class, 'showLeaderSeller'])->name('adm.leaders.leader-seller.show-leader-seller');
    Route::post('/adm/leaders/leader-seller/created-leader-sellers', [LeaderSellerController::class, 'createdLeaderSeller'])->name('adm.leaders.leader-seller.created-leader-seller');
    Route::post('/adm/leaders/leader-seller/updated-leader-sellers', [LeaderSellerController::class, 'updatedLeaderSeller'])->name('adm.leaders.leader-seller.updated-leader-seller');
    Route::post('/adm/leaders/leader-seller/deleted-leader-sellers', [LeaderSellerController::class, 'deletedLeaderSeller'])->name('adm.leaders.leader-seller.deleted-leader-seller');
    Route::get('/adm/leaders/leader-seller/retore-leader-sellers/{id}', [LeaderSellerController::class, 'restoreLeaderSeller'])->name('adm.leaders.leader-seller.retore-leader-seller');
    
    // ADM RESELLER SUPPLIER PAGES
    Route::get('/adm/Leaders/leader-seller-supplier/table-leader-seller-supplier', [LeaderSellerSuppliersController::class, 'tableLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.table-leader-seller-supplier');
    Route::get('/adm/Leaders/leader-seller-supplier/add-leader-seller-supplier', [LeaderSellerSuppliersController::class, 'addLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.add-leader-seller-supplier');
    Route::get('/adm/Leaders/leader-seller-supplier/edit-leader-seller-supplier/{id}', [LeaderSellerSuppliersController::class, 'editLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.edit-leader-seller-supplier');
    Route::get('/adm/Leaders/leader-seller-supplier/conf-delete-leader-seller-supplier/{id}', [LeaderSellerSuppliersController::class, 'confDeleteLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.conf-delete-leader-seller-supplier');
    Route::get('/adm/Leaders/leader-seller-supplier/show-leader-seller-supplier/{id}', [LeaderSellerSuppliersController::class, 'showLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.show-leader-seller-supplier');
    Route::post('/adm/Leaders/leader-seller-supplier/created-leader-seller-supplier', [LeaderSellerSuppliersController::class, 'createdLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.created-leader-seller-supplier');
    Route::post('/adm/Leaders/leader-seller-supplier/updated-leader-seller-supplier', [LeaderSellerSuppliersController::class, 'updatedLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.updated-leader-seller-supplier');
    Route::post('/adm/Leaders/leader-seller-supplier/deleted-leader-seller-supplier', [LeaderSellerSuppliersController::class, 'deletedLeaderSupplier'])->name('adm.Leaders.leader-seller-supplier.deleted-leader-seller-supplier');

   // ADM RESELLER CATEGORY PAGES
   Route::get('/adm/Leaders/leader-seller-category/table-leader-seller-category', [LeaderSellerCategoryController::class, 'tableLeaderCategory'])->name('adm.Leaders.leader-seller-category.table-leader-seller-category');
   Route::get('/adm/Leaders/leader-seller-category/add-leader-seller-category', [LeaderSellerCategoryController::class, 'addLeaderCategory'])->name('adm.Leaders.leader-seller-category.add-leader-seller-category');
   Route::get('/adm/Leaders/leader-seller-category/edit-leader-seller-category/{id}', [LeaderSellerCategoryController::class, 'editLeaderCategory'])->name('adm.Leaders.leader-seller-category.edit-leader-seller-category');
   Route::get('/adm/Leaders/leader-seller-category/conf-delete-leader-seller-category/{id}', [LeaderSellerCategoryController::class, 'confDeleteLeaderCategory'])->name('adm.Leaders.leader-seller-category.conf-delete-leader-seller-category');
   Route::get('/adm/Leaders/leader-seller-category/show-leader-seller-category/{id}', [LeaderSellerCategoryController::class, 'showLeaderCategory'])->name('adm.Leaders.leader-seller-category.show-leader-seller-category');
   Route::post('/adm/Leaders/leader-seller-category/created-leader-seller-category', [LeaderSellerCategoryController::class, 'createdLeaderCategory'])->name('adm.Leaders.leader-seller-category.created-leader-seller-category');
   Route::post('/adm/Leaders/leader-seller-category/updated-leader-seller-category', [LeaderSellerCategoryController::class, 'updatedLeaderCategory'])->name('adm.Leaders.leader-seller-category.updated-leader-seller-category');
   Route::post('/adm/Leaders/leader-seller-category/deleted-leader-seller-category', [LeaderSellerCategoryController::class, 'deletedLeaderCategory'])->name('adm.Leaders.leader-seller-category.deleted-leader-seller-category');


    // ADM SETTINGS DETAIL RESELLERS PAGES
    Route::get('/adm/Leaders/leader-seller-setting/table-leader-seller-setting', [LeaderSellerSettingController::class, 'tableLeaderSettings'])->name('adm.Leaders.leader-seller-setting.table-leader-seller-setting');
    Route::get('/adm/Leaders/leader-seller-setting-resellers/add-leader-seller-setting', [LeaderSellerSettingController::class, 'addLeaderSettings'])->name('adm.Leaders.leader-seller-setting.add-leader-seller-setting');
    Route::get('/adm/Leaders/leader-seller-setting/edit-leader-seller-setting/{id}', [LeaderSellerSettingController::class, 'editLeaderSettings'])->name('adm.Leaders.leader-seller-setting.edit-leader-seller-setting');
    Route::get('/adm/Leaders/leader-seller-setting/conf-delete-leader-seller-setting/{id}', [LeaderSellerSettingController::class, 'confDeleteLeaderSettings'])->name('adm.Leaders.leader-seller-setting.conf-delete-leader-seller-setting');
    Route::get('/adm/Leaders/leader-seller-setting/show-leader-seller-setting/{id}', [LeaderSellerSettingController::class, 'showLeaderSettings'])->name('adm.Leaders.leader-seller-setting.show-leader-seller-setting');
    Route::post('/adm/Leaders/leader-seller-setting/created-leader-seller-setting', [LeaderSellerSettingController::class, 'createdLeaderSettings'])->name('adm.Leaders.leader-seller-setting.created-leader-seller-setting');
    Route::post('/adm/Leaders/leader-seller-setting/updated-leader-seller-setting', [LeaderSellerSettingController::class, 'updatedLeaderSettings'])->name('adm.Leaders.leader-seller-setting.updated-leader-seller-setting');
    Route::post('/adm/Leaders/leader-seller-setting/deleted-leader-seller-setting', [LeaderSellerSettingController::class, 'deletedLeaderSettings'])->name('adm.Leaders.leader-seller-setting.deleted-leader-seller-setting');

    // LEADERS PAGES
    // PRODUCT LEADERS PAGES
    Route::get('/adm/Leaders/leader-seller-product/table-leader-seller-product', [LeaderSellerProductController::class, 'tableLeaderProduct'])->name('adm.Leaders.leader-seller-product.table-leader-seller-product');
    Route::get('/adm/Leaders/leader-seller-product/add-leader-seller-product', [LeaderSellerProductController::class, 'addLeaderProduct'])->name('adm.Leaders.leader-seller-product.add-leader-seller-product');
    Route::get('/adm/Leaders/leader-seller-product/edit-product/{id}', [LeaderSellerProductController::class, 'editLeaderProduct'])->name('adm.Leaders.leader-seller-product.edit-leader-seller-product');
    Route::get('/adm/Leaders/leader-seller-product/conf-delete-product/{id}', [LeaderSellerProductController::class, 'confDeleteLeaderProduct'])->name('adm.Leaders.leader-seller-product.conf-delete-leader-seller-product');
    Route::get('/adm/Leaders/leader-seller-product/show-product/{id}', [LeaderSellerProductController::class, 'showLeaderProduct'])->name('adm.Leaders.leader-seller-product.show-leader-seller-product');
    Route::post('/adm/Leaders/leader-seller-product/created-leader-seller-product', [LeaderSellerProductController::class, 'createdLeaderProduct'])->name('adm.Leaders.leader-seller-product.created-leader-seller-product');
    Route::post('/adm/Leaders/leader-seller-product/updated-leader-seller-product', [LeaderSellerProductController::class, 'updatedLeaderProduct'])->name('adm.Leaders.leader-seller-product.updated-leader-seller-product');
    Route::post('/adm/Leaders/leader-seller-product/deleted-leader-seller-product', [LeaderSellerProductController::class, 'deletedLeaderProduct'])->name('adm.Leaders.leader-seller-product.deleted-leader-seller-product');










    
    