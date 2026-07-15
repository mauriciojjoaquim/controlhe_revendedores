<?php

use App\Http\Controllers\Adm\Admin\Boxs\SettingsDetails\SettingsDetailResellersController;
use App\Http\Controllers\Adm\Resellers\Box\ResellerCategoryController;
use App\Http\Controllers\Adm\Resellers\Box\ResellerSupplierController;
use App\Http\Controllers\Adm\Resellers\Product\RellerMyProductsController;
use App\Http\Controllers\Adm\Resellers\Product\RellerProductsController;
use App\Http\Controllers\Adm\Resellers\Reseller\RellerInstallmentCustomerDetailController;
use App\Http\Controllers\Adm\Resellers\Reseller\RellerSearchCustomerController;
use App\Http\Controllers\Adm\Resellers\Reseller\ResellersCustomersController;
use App\Http\Controllers\Adm\Resellers\ResellerAvataUser\ResellerAvataUserController;
use App\Http\Controllers\Adm\Resellers\ResellerInvoiceRegistrationForPayment\ResellerInvoiceRegistrationForPaymentController;
use App\Http\Controllers\Adm\Resellers\ResellerMySales\RellerCustomerMySalesController;
use App\Http\Controllers\Adm\Resellers\ResellerMySalesProducts\RellerCustomerMySalesProductsController;
use App\Http\Controllers\Adm\Resellers\ResellerStockDetail\ResellerStockDetailController;
use Illuminate\Support\Facades\Route;



    // ADM RESELLER CUSTOMERS PAGES
    Route::get('/adm/resellers/table-resellers', [ResellersCustomersController::class, 'tableClient'])->name('adm.resellers.table-resellers');
    Route::get('/adm/resellers/add-resellers', [ResellersCustomersController::class, 'addClient'])->name('adm.resellers.add-resellers');
    Route::get('/adm/resellers/edit-resellers/{id}', [ResellersCustomersController::class, 'editClient'])->name('adm.resellers.edit-resellers');
    Route::get('/adm/resellers/conf-delete-resellers/{id}', [ResellersCustomersController::class, 'confDeleteClient'])->name('adm.resellers.conf-delete-resellers');
    Route::get('/adm/resellers/show-resellers/{id}', [ResellersCustomersController::class, 'showClient'])->name('adm.resellers.show-resellers');
    Route::post('/adm/resellers/created-resellers', [ResellersCustomersController::class, 'createdClient'])->name('adm.resellers.created-resellers');
    Route::post('/adm/resellers/updated-resellers', [ResellersCustomersController::class, 'updatedClient'])->name('adm.resellers.updated-resellers');
    Route::post('/adm/resellers/deleted-resellers', [ResellersCustomersController::class, 'deletedClient'])->name('adm.resellers.deleted-resellers');
    Route::get('/adm/resellers/online-resellers/{id}', [ResellersCustomersController::class, 'onlineClient'])->name('adm.resellers.online-resellers');

    // ADM RESELLER PRODUCT PAGES SALES
    Route::get('/adm/dealers/reseller-my-products/table-reseller-my-products', [RellerMyProductsController::class, 'tableProductSale'])->name('adm.resellers.reseller-my-products.table-reseller-my-products');
    Route::get('/adm/dealers/reseller-my-products/add-reseller-my-products', [RellerMyProductsController::class, 'addProductSale'])->name('adm.resellers.reseller-my-products.add-reseller-my-products');
    Route::get('/adm/dealers/reseller-my-products/edit-reseller-my-products/{id}', [RellerMyProductsController::class, 'editProductSale'])->name('adm.resellers.reseller-my-products.edit-reseller-my-products');
    Route::get('/adm/dealers/reseller-my-products/-my-products/conf-delete-reseller-my-products/{id}', [RellerMyProductsController::class, 'confDeleteProductSale'])->name('adm.resellers.reseller-my-products.reseller-products.conf-delete-reseller-my-products');
    Route::get('/adm/resellers/reseller-my-products/show-reseller-my-products/{id}', [RellerMyProductsController::class, 'showProductSale'])->name('adm.resellers.reseller-my-products.show-reseller-my-products');
    Route::post('/adm/resellers/reseller-my-products/created-reseller-my-products', [RellerMyProductsController::class, 'createdProductSale'])->name('adm.resellers.reseller-my-products.created-reseller-my-products');
    Route::post('/adm/resellers/reseller-my-products/updated-reseller-my-products', [RellerMyProductsController::class, 'updatedProductSale'])->name('adm.resellers.reseller-my-products.updated-reseller-my-products');
    Route::post('/adm/resellers/reseller-my-products/deleted-reseller-my-products', [RellerMyProductsController::class, 'deletedProductSale'])->name('adm.resellers.reseller-my-products.deleted-reseller-my-products');

    // ADM RESELLER STOCK DETAIL PAGES
    Route::get('/adm/resellers/reseller-stock-detail/table-reseller-stock-details', [ResellerStockDetailController::class, 'tableResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.table-reseller-stock-details');
    Route::get('/adm/resellers/reseller-stock-detail/add-reseller-stock-details', [ResellerStockDetailController::class, 'addResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.add-reseller-stock-details');
    Route::get('/adm/resellers/reseller-stock-detail/edit-reseller-stock-details/{id}', [ResellerStockDetailController::class, 'editResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.edit-reseller-stock-details');
    Route::get('/adm/resellers/reseller-stock-detail-detail/conf-delete-reseller-stock-details/{id}', [ResellerStockDetailController::class, 'confDeleteResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.conf-delete-reseller-stock-details');
    Route::get('/adm/resellers/reseller-stock_detail/show-reseller-stock-details/{id}', [ResellerStockDetailController::class, 'showResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.show-reseller-stock-details');
    Route::post('/adm/resellers/reseller-stock-detail/created-reseller-stock-details', [ResellerStockDetailController::class, 'createdResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.created-reseller-stock-details');
    Route::post('/adm/resellers/reseller-stock-detail/created-table-reseller-stock-details', [ResellerStockDetailController::class, 'createdTableResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.created-table-reseller-stock-details');
    Route::post('/adm/resellers/reseller-stock-detail/updated-reseller-stock-details', [ResellerStockDetailController::class, 'updatedResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.updated-reseller-stock-detailss');
    Route::post('/adm/resellers/reseller-stock-detail/deleted-reseller-stock-details', [ResellerStockDetailController::class, 'deletedResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.deleted-reseller-stock-details');

    // ADM RESELLER PRODUCT PAGES
    Route::get('/adm/dealers/reseller-products/table-reseller-products', [RellerProductsController::class, 'tableProduct'])->name('adm.resellers.reseller-products.table-reseller-products');
    Route::get('/adm/dealers/reseller-products/add-reseller-products', [RellerProductsController::class, 'addProduct'])->name('adm.resellers.reseller-products.add-reseller-products');
    Route::get('/adm/dealers/reseller-products/edit-reseller-products/{id}', [RellerProductsController::class, 'editProduct'])->name('adm.resellers.reseller-products.edit-reseller-products');
    Route::get('/adm/dealers/reseller-products/-products/conf-delete-reseller-products/{id}', [RellerProductsController::class, 'confDeleteProduct'])->name('adm.resellers.reseller-products.reseller-products.conf-delete-reseller-products');
    Route::get('/adm/resellers/reseller-products/show-reseller-products/{id}', [RellerProductsController::class, 'showProduct'])->name('adm.resellers.reseller-products.show-reseller-products');
    Route::post('/adm/resellers/reseller-products/created-reseller-products', [RellerProductsController::class, 'createdProduct'])->name('adm.resellers.reseller-products.created-reseller-products');
    Route::post('/adm/resellers/reseller-products/updated-reseller-my-products', [RellerProductsController::class, 'updatedProduct'])->name('adm.resellers.reseller-products.updated-reseller-products');
    Route::post('/adm/resellers/reseller-products/deleted-reseller-products', [RellerProductsController::class, 'deletedProduct'])->name('adm.resellers.reseller-products.deleted-reseller-products');

    // ADM RESELLER SUPPLIER PAGES
    Route::get('/adm/resellers/reseller-suppliers/table-reseller-suppliers', [ResellerSupplierController::class, 'tableSupplier'])->name('adm.resellers.reseller-suppliers.table-reseller-suppliers');
    Route::get('/adm/resellers/reseller-suppliers/add-reseller-suppliers', [ResellerSupplierController::class, 'addSupplier'])->name('adm.resellers.reseller-suppliers.add-reseller-suppliers');
    Route::get('/adm/resellers/reseller-suppliers/edit-reseller-suppliers/{id}', [ResellerSupplierController::class, 'editSupplier'])->name('adm.resellers.reseller-suppliers.edit-reseller-suppliers');
    Route::get('/adm/resellers/reseller-suppliers/conf-delete-reseller-suppliers/{id}', [ResellerSupplierController::class, 'confDeleteSupplier'])->name('adm.resellers.reseller-suppliers.conf-delete-reseller-suppliers');
    Route::get('/adm/resellers/reseller-suppliers/show-reseller-suppliers/{id}', [ResellerSupplierController::class, 'showSupplier'])->name('adm.resellers.reseller-suppliers.show-reseller-suppliers');
    Route::post('/adm/resellers/reseller-suppliers/created-reseller-suppliers', [ResellerSupplierController::class, 'createdSupplier'])->name('adm.resellers.reseller-suppliers.created-reseller-suppliers');
    Route::post('/adm/resellers/reseller-suppliers/updated-reseller-suppliers', [ResellerSupplierController::class, 'updatedSupplier'])->name('adm.resellers.reseller-suppliers.updated-reseller-suppliers');
    Route::post('/adm/resellers/reseller-suppliers/deleted-reseller-suppliers', [ResellerSupplierController::class, 'deletedSupplier'])->name('adm.resellers.reseller-suppliers.deleted-reseller-suppliers');

   // ADM RESELLER CATEGORY PAGES
   Route::get('/adm/resellers/reseller-categories/table-reseller-category', [ResellerCategoryController::class, 'tableCategory'])->name('adm.resellers.reseller-categories.table-reseller-categories');
   Route::get('/adm/resellers/reseller-categories/add-reseller-category', [ResellerCategoryController::class, 'addCategory'])->name('adm.resellers.reseller-categories.add-reseller-categories');
   Route::get('/adm/resellers/reseller-categories/edit-reseller-category/{id}', [ResellerCategoryController::class, 'editCategory'])->name('adm.resellers.reseller-categories.edit-reseller-categories');
   Route::get('/adm/resellers/reseller-categories/conf-delete-reseller-category/{id}', [ResellerCategoryController::class, 'confDeleteCategory'])->name('adm.resellers.reseller-categories.conf-delete-reseller-categories');
   Route::get('/adm/resellers/reseller-categories/show-reseller-category/{id}', [ResellerCategoryController::class, 'showCategory'])->name('adm.resellers.reseller-categories.show-reseller-categories');
   Route::post('/adm/resellers/reseller-categories/created-reseller-category', [ResellerCategoryController::class, 'createdCategory'])->name('adm.resellers.reseller-categories.created-reseller-categories');
   Route::post('/adm/resellers/reseller-categories/updated-reseller-category', [ResellerCategoryController::class, 'updatedCategory'])->name('adm.resellers.reseller-categories.updated-reseller-categories');
   Route::post('/adm/resellers/reseller-categories/deleted-reseller-category', [ResellerCategoryController::class, 'deletedCategory'])->name('adm.resellers.reseller-categories.deleted-reseller-categories');

    // ADM RESELLER SAERCH PAGES
    Route::get('/adm/resellers/reseller-search/show-order-resellers/{id}', [RellerSearchCustomerController::class, 'showOrderClient'])->name('adm.resellers.reseller-search.detail.show-order-resellers');
    Route::get('/adm/resellers/reseller-search/show-info-resellers/{id}', [RellerSearchCustomerController::class, 'showInfoClient'])->name('adm.resellers.reseller-search.show-info-resellers');
    Route::get('/adm/resellers/reseller-search/info-resellers', [RellerSearchCustomerController::class, 'infoClient'])->name('adm.resellers.reseller-search.info-resellers');
    Route::get('/adm/resellers/reseller-search/search-resellers', [RellerSearchCustomerController::class, 'searchClient'])->name('adm.resellers.reseller-search.search-resellers');
    Route::post('/adm/resellers/reseller-search/search-resellers', [RellerSearchCustomerController::class, 'searchFormClient'])->name('adm.resellers.reseller-search.search-resellers');
    Route::post('/adm/resellers/reseller-search/info-resellers', [RellerSearchCustomerController::class, 'infoFormClient'])->name('adm.resellers.reseller-search.info-resellers');

    // ADM RESELLER MY SALES 
    Route::get('/adm/resellers/reseller-my-sales/table-reseller-my-sales', [RellerCustomerMySalesController::class, 'tableResellerMySales'])->name('adm.resellers.reseller-my-sales.table-reseller-my-sales');
    Route::get('/adm/resellers/reseller-my-sales/relatorio-reseller-my-sales', [RellerCustomerMySalesController::class, 'relatorioResellerMySales'])->name('adm.resellers.reseller-my-sales.relatorio-reseller-my-sales');
    Route::get('/adm/resellers/reseller-my-sales/add-reseller-my-sales', [RellerCustomerMySalesController::class, 'addResellerMySales'])->name('adm.resellers.reseller-my-sales.add-reseller-my-sales');
    Route::get('/adm/resellers/reseller-my-sales/edit-reseller-my-sales/{id}', [RellerCustomerMySalesController::class, 'editResellerMySales'])->name('adm.resellers.reseller-my-sales.edit-reseller-my-sales');
    Route::get('/adm/resellers/reseller-my-sales/conf-delete-reseller-my-sales/{id}', [RellerCustomerMySalesController::class, 'confDeleteResellerMySales'])->name('adm.resellers.reseller-my-sales.conf-delete-reseller-my-sales');
    Route::get('/adm/resellers/reseller-my-sales/show-reseller-my-sales/{id}', [RellerCustomerMySalesController::class, 'showResellerMySales'])->name('adm.resellers.reseller-my-sales.show-reseller-my-sales');
    Route::post('/adm/resellers/reseller-my-sales/created-customer-my-sales', [RellerCustomerMySalesController::class, 'createdResellerMySales'])->name('adm.resellers.reseller-my-sales.created-reseller-my-sales');
    Route::post('/adm/resellers/reseller-my-sales/updated-customer-my-sales', [RellerCustomerMySalesController::class, 'updatedResellerMySales'])->name('adm.resellers.reseller-my-sales.updated-reseller-my-sales');
    Route::post('/adm/resellers/reseller-my-sales/deleted-customer-my-sales', [RellerCustomerMySalesController::class, 'deletedResellerMySales'])->name('adm.resellers.reseller-my-sales.deleted-reseller-my-sales');

    // ADM RESELLER MY SALES PROCUCTS  
    Route::get('/adm/resellers/reseller-my-sales-products/table-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'tableResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.table-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/order-completed-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'orderCompletedResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.order-completed-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/reload-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'reloadResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.reload-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/relatorio-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'reportResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.relatorio-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/relatorio-oder-completed-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'reportOrderCompletedResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.relatorio-oder-completed-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/completeo-rder-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'completeOrderMySalesProducts'])->name('adm.resellers.completeo-rder-my-sales-products.relatorio-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/add-reseller-my-sales-products', [RellerCustomerMySalesProductsController::class, 'addResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.add-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/edit-reseller-my-sales-products/{id}', [RellerCustomerMySalesProductsController::class, 'editResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.edit-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/conf-delete-reseller-my-sales-products/{id}', [RellerCustomerMySalesProductsController::class, 'confDeleteResellerMySalesProducts'])->name('adm.resellers-products.reseller-my-sales.conf-delete-reseller-my-sales-products');
    Route::get('/adm/resellers/reseller-my-sales-products/show-reseller-my-sales-products/{id}', [RellerCustomerMySalesProductsController::class, 'showResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.show-reseller-my-sales-products');
    Route::post('/adm/resellers/reseller-my-sales-products/created-customer-my-sales-products', [RellerCustomerMySalesProductsController::class, 'createdResellerMySales'])->name('adm.resellers.reseller-my-sales-products.created-reseller-my-sales-products');
    Route::post('/adm/resellers/reseller-my-sales-products/updated-customer-my-sales-products', [RellerCustomerMySalesProductsController::class, 'updatedResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales.updated-reseller-my-sales-products');
    Route::post('/adm/resellers/reseller-my-sales-products/deleted-customer-my-sales-products', [RellerCustomerMySalesProductsController::class, 'deletedResellerMySalesProducts'])->name('adm.resellers.reseller-my-sales-products.deleted-reseller-my-sales-products');
    
    // ADM SETTINGS DETAIL RESELLERS PAGES
    Route::get('/adm/settings-resellers/table-vende-setting', [SettingsDetailResellersController::class, 'table'])->name('adm.settings-resellers.table-vende-settings');
    Route::get('/adm/settings-resellers/add-vende-setting', [SettingsDetailResellersController::class, 'add'])->name('adm.settings-resellers.add-vende-settings');
    Route::get('/adm/settings-resellers/edit-vende-setting/{id}', [SettingsDetailResellersController::class, 'edit'])->name('adm.settings-resellers.edit-vende-settings');
    Route::get('/adm/settings-resellers/conf-delete-vende-setting/{id}', [SettingsDetailResellersController::class, 'confDeleteVendeSettings'])->name('adm.settings-resellers.conf-delete-vende-settings');
    Route::get('/adm/settings-resellers/show-vende-setting/{id}', [SettingsDetailResellersController::class, 'show'])->name('adm.settings-resellers.show-vende-settings');
    Route::post('/adm/settings-resellers/created-vende-setting', [SettingsDetailResellersController::class, 'created'])->name('adm.settings-resellers.created-vende-settings');
    Route::post('/adm/settings-resellers/updated-vende-setting', [SettingsDetailResellersController::class, 'updated'])->name('adm.settings-resellers.updated-vende-settings');
    Route::post('/adm/settings-resellers/deleted-vende-setting', [SettingsDetailResellersController::class, 'deleted'])->name('adm.settings-resellers.deleted-vende-settings');

    
    // Installment RESELLER Detail
    Route::get('/admin/resellers/reseller-installment-detail/table-reseller-installment-detail', [RellerInstallmentCustomerDetailController::class, 'tableInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.client.table-reseller-installment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/add-reseller-installment-detail', [RellerInstallmentCustomerDetailController::class, 'addInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.add-reseller-installment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/cart-reseller-installment-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'cartInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.cart-reseller-installment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/confirma-cart-delete-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'confirmaDeleteCart'])->name('adm.resellers.reseller-installment-detail.confirma-cart-delete-detail');
    Route::get('/adm/resellers/reseller-installment-detail/confirma-cart-payment-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'confirmaCartPayment'])->name('adm.resellers.reseller-installment-detail.confirma-cart-payment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/client-confirma-cart-payment-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'clientConfirmaCartPayment'])->name('adm.resellers.reseller-installment-detail.reseller-confirma-cart-payment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/edit-reseller-installment-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'editInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.edit-reseller-installment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/conf-delete-installment-client-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'confDeleteInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.conf-delete-reseller-installment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/show-reseller-installment-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'showInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.show-reseller-installment-detail');
    Route::get('/adm/resellers/reseller-installment-detail/show-installment-pix-reseller-installment-detail/{id}', [RellerInstallmentCustomerDetailController::class, 'qrInstallmentPixClientDetail'])->name('adm.resellers.reseller-installment-detail.qr-reseller-installment-detail');
    Route::post('/adm/resellers/reseller-installment-detail/created-reseller-installment-detail', [RellerInstallmentCustomerDetailController::class, 'createdInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.created-reseller-installment-detail');
    Route::post('/adm/resellers/reseller-installment-detail/updated-reseller-installment-detail', [RellerInstallmentCustomerDetailController::class, 'updatedInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.updated-reseller-installment-detail');
    Route::post('/adm/resellers/reseller-installment-detail/deleted-reseller-installment-detail', [RellerInstallmentCustomerDetailController::class, 'deletedInstallmentClientDetail'])->name('adm.resellers.reseller-installment-detail.deleted-reseller-installment-detail');

    // RESELLER PAGES
    Route::post('/adm/resellers/product-reseller/cart-shopping-clients', [RellerInstallmentCustomerDetailController::class, 'cartShopping'])->name('adm.resellers.reseller-installment-detail.cart-shopping-clients');
    Route::post('/adm/resellers/product-reseller/addToCart', [RellerInstallmentCustomerDetailController::class, 'addToCart'])->name('adm.resellers.reseller-installment-detail.add-to-cart');
    Route::post('/adm/resellers/product-reseller/closingToCart', [RellerInstallmentCustomerDetailController::class, 'closingToCart'])->name('adm.resellers.reseller-installment-detail.closing-to-cart');
    Route::get('/adm/resellers/reseller-my-sales-products/report-order-cart-shopping/{id}', [RellerInstallmentCustomerDetailController::class, 'reportOrderCartShopping'])->name('adm.resellers.reseller-my-sales-products.report-order-cart-shopping');
    Route::get('/adm/resellers/reseller-my-sales-products/report-view-order-cart-shopping/{id}', [RellerInstallmentCustomerDetailController::class, 'reportViewOrderCartShopping'])->name('adm.resellers.reseller-my-sales-products.report-view-order-cart-shopping');

    
   // ADM RESELLER SUPPLIER PAGES Invoice Registration For Payment
   Route::get('/adm/resellers/reseller-invoice-registration-for-payments/table-reseller-invoice', [ResellerInvoiceRegistrationForPaymentController::class, 'tableInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.table-reseller-invoice');
   Route::get('/adm/resellers/reseller-invoice-registration-for-payments/add-reseller-invoice', [ResellerInvoiceRegistrationForPaymentController::class, 'addInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.add-reseller-invoice');
   Route::get('/adm/resellers/reseller-invoice-registration-for-payments/edit-reseller-invoice/{id}', [ResellerInvoiceRegistrationForPaymentController::class, 'editInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.edit-reseller-invoice');
   Route::get('/adm/resellers/reseller-invoice-registration-for-payments/conf-delete-reseller-invoice/{id}', [ResellerInvoiceRegistrationForPaymentController::class, 'confDeleteInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.conf-delete-reseller-invoice');
   Route::get('/adm/resellers/reseller-invoice-registration-for-payments/show-reseller-invoice/{id}', [ResellerInvoiceRegistrationForPaymentController::class, 'showInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.show-reseller-invoice');
   Route::get('/adm/resellers/reseller-invoice-registration-for-payments/confirm_payment-reseller-invoice/{id}', [ResellerInvoiceRegistrationForPaymentController::class, 'confirmPaymentInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.confirm_payment-reseller-invoice');
   Route::post('/adm/resellers/reseller-invoice-registration-for-payments/created-reseller-invoice', [ResellerInvoiceRegistrationForPaymentController::class, 'createdInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.created-reseller-invoice');
   Route::post('/adm/resellers/reseller-invoice-registration-for-payments/updated-reseller-invoice', [ResellerInvoiceRegistrationForPaymentController::class, 'updatedInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.updated-reseller-invoice');
   Route::post('/adm/resellers/reseller-invoice-registration-for-payments/deleted-reseller-invoice', [ResellerInvoiceRegistrationForPaymentController::class, 'deletedInvoice'])->name('adm.resellers.reseller-invoice-registration-for-payments.deleted-reseller-invoice');





   Route::get('/adm/resellers/reseller-avata-user/add-avata-users', [ResellerAvataUserController::class, 'addAvataUser'])->name('adm.resellers.reseller-avata-user.add-avata-users');
   Route::get('/adm/resellers/reseller-avata-user/edit-avata-users/{id}', [ResellerAvataUserController::class, 'editAvataUser'])->name('adm.resellers.reseller-avata-user.edit-avata-users');
   Route::post('/adm/resellers/reseller-avata-user/created-avata-users', [ResellerAvataUserController::class, 'createdAvataUser'])->name('adm.resellers.reseller-avata-users.created-avata-users');
   Route::post('/adm/resellers/reseller-avata-user/updated-avata-users', [ResellerAvataUserController::class, 'updatedAvataUser'])->name('adm.resellers.reseller-avata-users.updated-avata-users');
   