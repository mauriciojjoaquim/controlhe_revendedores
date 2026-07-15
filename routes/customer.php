<?php

use App\Http\Controllers\Adm\Admin\Colaborators\ProfileCustomerController;
use App\Http\Controllers\Adm\Customers\CustomerAvataUser\CustomerAvataUserController;
use App\Http\Controllers\Adm\Customers\CustomerFinancial\CustomerFinancialController;
use App\Http\Controllers\Adm\Customers\CustomerProofPayment\CustomerProofPaymentController;
use App\Http\Controllers\Adm\Customers\CustomersController;
use Illuminate\Support\Facades\Route;


    // ADM Proof Payment PAGES
    Route::get('/adm/customers/customer-proof-payment/table-customer-proof-payment', [CustomerProofPaymentController::class, 'tableProofPayment'])->name('adm.customers.customer-proof-payment.table-customer-proof-payment');
    Route::get('/adm/customers/customer-proof-payment/add-customer-proof-payment', [CustomerProofPaymentController::class, 'addProofPayment'])->name('adm.customers.customer-proof-payment.add-customer-proof-payment');
    Route::get('/adm/customers/customer-proof-payment/edit-customer-proof-payment/{id}', [CustomerProofPaymentController::class, 'editProofPayment'])->name('adm.customers.customer-proof-payment.edit-customer-proof-payment');
    Route::get('/adm/customers/customer-proof-payment/conf-delete-customer-proof-payment/{id}', [CustomerProofPaymentController::class, 'confDeleteProofPayment'])->name('adm.customers.customer-proof-payment.conf-delete-customer-proof-payment');
    Route::get('/adm/customers/customer-proof-payment/show-customer-proof-payment/{id}', [CustomerProofPaymentController::class, 'showProofPayment'])->name('adm.customers.customer-proof-payment.show-customer-proof-payment');
    Route::post('/adm/customers/customer-proof-payment/created-customer-proof-payment', [CustomerProofPaymentController::class, 'createdProofPayment'])->name('adm.customers.customer-proof-payment.created-customer-proof-payment');
    Route::post('/adm/customers/customer-proof-payment/updated-customer-proof-payment', [CustomerProofPaymentController::class, 'updatedProofPayment'])->name('adm.customers.customer-proof-payment.updated-customer-proof-payment');
    Route::post('/adm/customers/customer-proof-payment/deleted-customer-proof-payment', [CustomerProofPaymentController::class, 'deletedProofPayment'])->name('adm.customers.customer-proof-payment.deleted-customer-proof-payment');


    // ROUTE CUSTOMER SITE    // ADM customers PROFILE
    Route::get('/adm/customers/customer-profile', [ProfileCustomerController::class, 'index'])->name('customers.customer-profile');
    Route::post('/adm/customers/profile/update-customer-password', [ProfileCustomerController::class, 'updateCustomerPassword'])->name('customers.profile.update-customer-password');
    Route::post('/adm/customers/profile/update-customer-data', [ProfileCustomerController::class, 'updateCustomerData'])->name('customers.profile.update-customer-data');
    Route::post('/adm/customers/profile/update-customer-detail', [ProfileCustomerController::class, 'updateCustomerDetail'])->name('customers.profile.update-customer-detail');

    // CUSTOMERS PAGES
    // ADM CUSTOMERS PAGES
    Route::get('/adm/customers/table-installment-customer-detail', [CustomersController::class, 'tableInstallmentCustomerDetail'])->name('customers.customer-dealer.table-installment-customer-detail');
    Route::get('/adm/customers/add-installment-customer-detail', [CustomersController::class, 'addInstallmentCustomerDetail'])->name('customers.customer-dealer.add-installment-customer-detail');
    Route::get('/adm/customers/online-installment-customer-detail/{id}', [CustomersController::class, 'onlineInstallmentCustomerDetail'])->name('customers.customer-dealer.online-installment-customer-detail');
    Route::get('/adm/customers/cart-installment-customer-detail/{id}', [CustomersController::class, 'cartInstallmentCustomerDetail'])->name('customers.customer-dealer.cart-installment-customer-detail');
    Route::get('/adm/customers/confirma-cart-payment-detail/{id}', [CustomersController::class, 'confirmaCartPayment'])->name('customers.customer-dealer.confirma-cart-payment-detail');
    Route::get('/adm/customers/customers.customer-confirma-cart-payment-detail/{id}', [CustomersController::class, 'customerConfirmaCartPayment'])->name('customers.customer-dealer.customers.customer-confirma-cart-payment-detail');
    Route::get('/adm/customers/edit-installment-customer-detail/{id}', [CustomersController::class, 'editInstallmentCustomerDetail'])->name('customers.customer-dealer.edit-installment-customer-detail');
    Route::get('/adm/customers/conf-delete-installment-customer-detail/{id}', [CustomersController::class, 'confDeleteInstallmentCustomerDetail'])->name('customers.customer-dealer.conf-delete-installment-customer-detail');
    Route::get('/adm/customers/show-installment-customer-detail/{id}', [CustomersController::class, 'showInstallmentCustomerDetail'])->name('customers.customer-dealer.show-installment-customer-detail');
    Route::get('/adm/customers/qr-installment-pix-customer-detail/{id}', [CustomersController::class, 'qrInstallmentPixCustomerDetail'])->name('customers.customer-dealer.qr-installment-pix-customer-detail');
    Route::post('/adm/customers/created-installment-customer-detail', [CustomersController::class, 'createdInstallmentCustomerDetail'])->name('customers.customer-dealer.created-installment-customer-detail');
    Route::post('/adm/customers/updated-installment-customer-detail', [CustomersController::class, 'updatedInstallmentCustomerDetail'])->name('customers.customer-dealer.updated-installment-customer-detail');
    Route::post('/adm/customers//deleted-installment-customer-detail', [CustomersController::class, 'deletedInstallmentCustomerDetail'])->name('customers.customer-dealer.deleted-installment-customer-detail');
    Route::post('/adm/customers/cart-shopping-Customers', [CustomersController::class, 'cartShopping'])->name('customers.customer-dealer.cart-shopping-Customers');
    Route::post('/adm/customers/addToCart', [CustomersController::class, 'addToCart'])->name('customers.customer-dealer.add-to-cart');
    Route::post('/adm/customers/closingToCart', [CustomersController::class, 'closingToCart'])->name('customers.customer-dealer.closing-to-cart');
    Route::post('/adm/customers/customers/customer-confirma-form-payment-detail/', [CustomersController::class, 'CustomerConfirmaFormPayment'])->name('customers.customer-dealer.customers.customer-confirma-form-payment-detail');


    // down & up & delete
    Route::post('/adm/customers/cart-down', [CustomersController::class, 'cartDown'])->name('customers.customer-dealer.cart-down');
    Route::post('/adm/customers/cart-up', [CustomersController::class, 'cartUp'])->name('customers.customer-dealer.cart-up');
    Route::post('/adm/customers/cart-delete', [CustomersController::class, 'cartDelete'])->name('customers.customer-dealer.cart-delete');
    Route::get('/adm/customers/customers/report-order-cart-shopping/{id}', [CustomersController::class, 'reportOrderCartShopping'])->name('customers.customer-dealer.customers.report-order-cart-shopping');
    Route::get('/adm/customers/customers/report-view-order-cart-shopping/{id}', [CustomersController::class, 'reportViewOrderCartShopping'])->name('customers.customer-dealer.customers.report-view-order-cart-shopping');


    // My Purchases
    Route::get('/adm/customers/customer-financial/customer-my-closed-purchase', [CustomerFinancialController::class, 'myClosedPurchase'])->name('customers.customer-financial.customer-my-closed-purchases');
    Route::get('/adm/customers/customer-financial/customer-my-open-purchases', [CustomerFinancialController::class, 'myOpenPurchase'])->name('customers.customer-financial.customer-my-open-purchases');

    // My Payments -send-proof
    Route::get('/adm/customers/customer-financial/customer-my-payments', [CustomerFinancialController::class, 'myPayments'])->name('customers.customer-financial.customer-my-payments');
    Route::get('/adm/customers/customer-financial/customer-qr-pix-my-payments/{id}', [CustomerFinancialController::class, 'qrPixMyPayments'])->name('customers.customer-financial.customer-qr-pix-my-payments');
    Route::get('/adm/customers/customer-financial/customer-show-my-payments/{id}', [CustomerFinancialController::class, 'showMyPayments'])->name('customers.customer-financial.customer-show-my-payments');
    Route::get('/adm/customers/customer-financial/customer-report-view-qr-pix-my-payments/{id}', [CustomerFinancialController::class, 'reportViewQrPixMyPayments'])->name('customers.customer-financial.customer-report-view-qr-pix-my-payments');
    Route::get('/adm/customers/customer-financial/customer-send-proof-my-payments/{id}', [CustomerFinancialController::class, 'sendProofMyPayments'])->name('customers.customer-financial.customer-send-proof-my-payments');
    Route::post('/adm/customers/customer-financial/form-customer-send-proof-my-payments', [CustomerFinancialController::class, 'formSendProofMyPayments'])->name('customers.customer-financial.fom-rcustomer-send-proof-my-payments');

    // My Receipts
    Route::get('/adm/customers/customer-financial/customer-my-receipts', [CustomerFinancialController::class, 'myReceipts'])->name('customers.customer-financial.customer-my-receipts');

    // Order Status customer-confirmation
    Route::get('/adm/customers/customer-financial/customer-order-status', [CustomerFinancialController::class, 'orderStatus'])->name('customers.customer-financial.customer-order-status');
    Route::get('/adm/customers/customer-financial/customer-confirmation-order-status/{id}', [CustomerFinancialController::class, 'confirmationOrderStatus'])->name('customers.customer-financial.customer-confirmation-order-status');



    Route::get('/adm/customers/customer-avata-user/add-avata-users', [CustomerAvataUserController::class, 'addAvataUser'])->name('adm.customers.customer-avata-user.add-avata-users');
    Route::get('/adm/customers/customer-avata-user/edit-avata-users/{id}', [CustomerAvataUserController::class, 'editAvataUser'])->name('adm.customers.customer-avata-user.edit-avata-users');
    Route::post('/adm/customers/customer-avata-user/created-avata-users', [CustomerAvataUserController::class, 'createdAvataUser'])->name('adm.customers.customer-avata-users.created-avata-users');
    Route::post('/adm/customers/customer-avata-user/updated-avata-users', [CustomerAvataUserController::class, 'updatedAvataUser'])->name('adm.customers.customer-avata-users.updated-avata-users');
    