<?php

use App\Http\Controllers\Adm\Admin\AvataUser\AvataUserController;
use App\Http\Controllers\Adm\Admin\Boxs\Access\AccessController;
use App\Http\Controllers\Adm\Admin\Boxs\Categories\CategoryController;
use App\Http\Controllers\Adm\Admin\Boxs\Cors\CorBootstrapController;
use App\Http\Controllers\Adm\Admin\Boxs\Cors\CorController;
use App\Http\Controllers\Adm\Admin\Boxs\Department\DepartmentController;
use App\Http\Controllers\Adm\Admin\Boxs\SettingsDetails\SettingsDetailController;
use App\Http\Controllers\Adm\Admin\Boxs\Suppliers\SupplierController;
use App\Http\Controllers\Adm\Admin\Colaborators\ColaboratorAllController;
use App\Http\Controllers\Adm\Admin\Colaborators\ColaboratorsController;
use App\Http\Controllers\Adm\Admin\Colaborators\RhUserController;
use App\Http\Controllers\Adm\Admin\Customers\AdmCustomersController;
use App\Http\Controllers\Adm\Admin\Customers\CustomerOrderDetailController;
use App\Http\Controllers\Adm\Admin\MagazineUpdate\MagazineUpdateController;
use App\Http\Controllers\Adm\Admin\Plans\PlanController;
use App\Http\Controllers\Adm\Admin\Resellers\ResellerStockDetail\AdmResellerStockDetailController;
use App\Http\Controllers\Adm\Admin\Shops\Installments\UsersInstallmentDetailController;
use App\Http\Controllers\Adm\Admin\Shops\Products\ProductController;
use Illuminate\Support\Facades\Route;


    // ADM CUSTOMERS ORDER DETAIL
    // ADM COLABORATOR PAGES
    Route::get('/adm/colaborators', [ColaboratorsController::class, 'colaborators'])->name('colaborators.colaborator.colaborators');

    // ADM COLABORATOR PAGES
    Route::get('/adm/colaborators', [ColaboratorsController::class, 'table'])->name('colaborators.colaborator.colaborators');
    Route::get('/adm/colaborator/detail-colaborator/{id}', [ColaboratorsController::class, 'show'])->name('colaborators.colaborator.detail-colaborator');
    Route::get('/adm/colaborator/edit-colaborator/{id}', [ColaboratorsController::class, 'edit'])->name('colaborators.colaborator.edit-colaborator');
    Route::get('/adm/colaborator/confirm-delete-colaborator/{id}', [ColaboratorsController::class, 'confDelete'])->name('colaborators.colaborator.del-colaborator');
    Route::get('/adm/colaborator/retore-colaborator/{id}', [ColaboratorsController::class, 'restore'])->name('colaborators.colaborator.retore-colaborator');
    Route::post('/adm/colaborator/update-colaborator/', [ColaboratorsController::class, 'updated'])->name('colaborators.colaborator.update-colaborator');
    Route::post('/adm/colaborator/delete-colaborator/', [ColaboratorsController::class, 'deleted'])->name('colaborators.colaborator.delete-colaborator');

    // ADM RH-USER COLABORATOR PAGES
    Route::get('/adm/rh/colaborator', [RhUserController::class, 'table'])->name('colaborators.rh.colaborators');
    Route::get('/adm/colaborator/rh/new-rh-user', [RhUserController::class, 'add'])->name('colaborators.rh.new-rh-user');
    Route::get('/adm/colaborator/rh/edit-rh-user/{id}', [RhUserController::class, 'edit'])->name('colaborators.rh.edit-rh-user');
    Route::get('/adm/colaborator/rh/confirm-delete-rh-user/{id}', [RhUserController::class, 'confDelete'])->name('colaborators.rh.del-rh-user');
    Route::get('/adm/colaborator/rh/retore-rh-user/{id}', [RhUserController::class, 'restore'])->name('colaborators.rh.retore-rh-user');
    Route::post('/adm/colaborator/rh/create-rh-user', [RhUserController::class, 'created'])->name('colaborators.rh.create-rh-user');
    Route::post('/adm/colaborator/rh/update-rh-user/', [RhUserController::class, 'updated'])->name('colaborators.rh.update-rh-user');
    Route::post('/adm/colaborator/rh/delete-rh-user/', [RhUserController::class, 'deleted'])->name('colaborators.rh.delete-rh-user');

    // ADM DEPARTMENTS PAGES
    Route::get('/adm/departments', [DepartmentController::class, 'table'])->name('departments');
    Route::get('/adm/department/new-department', [DepartmentController::class, 'add'])->name('departments.new-department');
    Route::get('/adm/department/edit-department/{id}', [DepartmentController::class, 'edit'])->name('departments.edit-department');
    Route::get('/adm/department/confirm-delete-department/{id}', [DepartmentController::class, 'confDelete'])->name('departments.del-department');
    Route::post('/adm/department/create-department', [DepartmentController::class, 'created'])->name('departments.create-department');
    Route::post('/adm/department/update-department/', [DepartmentController::class, 'updated'])->name('departments.update-department');
    Route::post('/adm/department/delete-department/', [DepartmentController::class, 'deleted'])->name('departments.delete-department');


    // ADM ALL COLABORATOR PAGES
    Route::get('/adm/colaborator-all/table-colaborator', [ColaboratorAllController::class, 'table'])->name('adm.all-colaborators.table-all-colaborators');
    Route::get('/adm/colaborator-all/add-colaborator', [ColaboratorAllController::class, 'add'])->name('adm.all-colaborators.add-all-colaborators');
    Route::get('/adm/colaborator-all/edit-colaborator/{id}', [ColaboratorAllController::class, 'edit'])->name('adm.all-colaborators.edit-all-colaborators');
    Route::get('/adm/colaborator-all/conf-delete-colaborator/{id}', [ColaboratorAllController::class, 'confDelete'])->name('adm.all-colaborators.conf-delete-all-colaborators');
    Route::get('/adm/colaborator-all/detail-colaborator/{id}', [ColaboratorAllController::class, 'show'])->name('adm.all-colaborators.detail-all-colaborators');
    Route::post('/adm/colaborator-all/created-colaborator', [ColaboratorAllController::class, 'createdColaborator'])->name('adm.all-colaborators.created-all-colaborators');
    Route::post('/adm/colaborator-all/updated-colaborator', [ColaboratorAllController::class, 'updated'])->name('adm.all-colaborators.updated-all-colaborators');
    Route::post('/adm/colaborator-all/deleted-colaborator', [ColaboratorAllController::class, 'deleted'])->name('adm.all-colaborators.deleted-all-colaborators');
    Route::get('/adm/colaborator-all/retore-colaborator/{id}', [ColaboratorAllController::class, 'restore'])->name('adm.all-colaborators.retore-all-colaborators');


    // ADM USERS INSTALLMENT DETAILS  PAGES
    Route::get('/adm/installments/table-user-installment-details', [UsersInstallmentDetailController::class, 'table'])->name('admin.user-installment-details.table-user-installment-details');
    Route::get('/adm/installments/add-user-installment-details', [UsersInstallmentDetailController::class, 'add'])->name('admin.user-installment-details.add-user-installment-details');
    Route::get('/adm/installments/edit-user-installment-details/{id}', [UsersInstallmentDetailController::class, 'edit'])->name('admin.user-installment-details.edit-user-installment-details');
    Route::get('/adm/installments/conf-delete-user-installment-details/{id}', [UsersInstallmentDetailController::class, 'confDelete'])->name('admin.user-installment-details.conf-delete-user-installment-details');
    Route::get('/adm/installments/show-user-installment-details/{id}', [UsersInstallmentDetailController::class, 'show'])->name('admin.user-installment-details.show-user-installment-details');
    Route::get('/adm/installments/payment-user-installment-details/{id}', [UsersInstallmentDetailController::class, 'payment'])->name('admin.user-installment-details.payment-user-installment-details');
    Route::post('/adm/installments/created-user-installment-details', [UsersInstallmentDetailController::class, 'created'])->name('admin.user-installment-details.created-user-installment-details');
    Route::post('/adm/installments/updated-user-installment-details', [UsersInstallmentDetailController::class, 'updated'])->name('admin.user-installment-details.updated-user-installment-details');
    Route::post('/adm/installments/deleted-user-installment-details', [UsersInstallmentDetailController::class, 'deleted'])->name('admin.user-installment-details.deleted-user-installment-details');

    // ADM CUSTOMERS DETAIL PAG
    Route::get('/adm/customers/customer/table-customers', [AdmCustomersController::class, 'tableCustomer'])->name('adm.customers.customer.table-customers');
    Route::get('/adm/customers/customer/add-customers', [AdmCustomersController::class, 'addCustomer'])->name('adm.customers.customer.add-customers');
    Route::get('/adm/customers/customer/edit-customers/{id}', [AdmCustomersController::class, 'editCustomer'])->name('adm.customers.customer.edit-customers');
    Route::get('/adm/customers/customer/conf-delete-customers/{id}', [AdmCustomersController::class, 'confDeleteCustomer'])->name('adm.customers.customer.conf-delete-customers');
    Route::get('/adm/customers/customer/show-customers/{id}', [AdmCustomersController::class, 'showCustomer'])->name('adm.customers.customer.show-customers');
    Route::post('/adm/customers/customer/created-customers', [AdmCustomersController::class, 'createdCustomer'])->name('adm.customers.customer.created-customers');
    Route::post('/adm/customers/customer/updated-customers', [AdmCustomersController::class, 'updatedCustomert'])->name('adm.customers.customer.updated-customers');
    Route::post('/adm/customers/customer/deleted-customers', [AdmCustomersController::class, 'deletedCustomert'])->name('adm.customers.customer.deleted-customers');

    // ADM CUSTOMERS ORDER DETAIL
    Route::get('/adm/customers/customer-order-detail/table-customer-order-detail', [CustomerOrderDetailController::class, 'table'])->name('adm.customers.customer-order-detail.table-customer-order-detail');
    Route::get('/adm/customers/customer-order-detail/add-customer-order-detail', [CustomerOrderDetailController::class, 'add'])->name('adm.customers.customer-order-detail.add-customer-order-detail');
    Route::get('/adm/customers/customer-order-detail/edit-customer-order-detail/{id}', [CustomerOrderDetailController::class, 'edit'])->name('adm.customers.customer-order-detail.edit-customer-order-detail');
    Route::get('/adm/customers/customer-order-detail/conf-delete-customer-order-detail/{id}', [CustomerOrderDetailController::class, 'confDeleteCustomerOrderDetail'])->name('adm.customers.customer-order-detail.conf-delete-customer-order-detail');
    Route::get('/adm/customers/customer-order-detail/show-customer-order-detail/{id}', [CustomerOrderDetailController::class, 'show'])->name('adm.customers.customer-order-detail.show-customer-order-detail');
    Route::post('/adm/customers/customer-order-detail/created-customer-order-detail', [CustomerOrderDetailController::class, 'created'])->name('adm.customers.customer-order-detail.created-customer-order-detail');
    Route::post('/adm/customers/customer-order-detail/updated-customer-order-detail', [CustomerOrderDetailController::class, 'updated'])->name('adm.customers.customer-order-detail.updated-customer-order-detail');
    Route::post('/adm/customers/customer-order-detail/deleted-customer-order-detail', [CustomerOrderDetailController::class, 'deleted'])->name('adm.customers.customer-order-detail.deleted-customer-order-detail');


    // ADM RESELLER STOCK DETAIL PAGES
    Route::get('/adm/resellers/reseller-stock-detail/table-adm-reseller-stock-detail', [AdmResellerStockDetailController::class, 'table'])->name('adm.resellers.reseller-stock-detail.table-adm-reseller-stock-detail');
    Route::get('/adm/resellers/reseller-stock-detail/add-adm-reseller-stock-detail', [AdmResellerStockDetailController::class, 'add'])->name('adm.resellers.reseller-stock-detail.add-adm-reseller-stock-detail');
    Route::get('/adm/resellers/reseller-stock-detail/edit-adm-reseller-stock-detail/{id}', [AdmResellerStockDetailController::class, 'editResellerStockDetail'])->name('adm.resellers.reseller-stock-detail.edit-adm-reseller-stock-detail');
    Route::get('/adm/resellers/reseller-stock-detail-detail/conf-delete-adm-reseller-stock-detail/{id}', [AdmResellerStockDetailController::class, 'confDelete'])->name('adm.resellers.reseller-stock-detail.conf-delete-adm-reseller-stock-detail');
    Route::get('/adm/resellers/reseller-stock-detail/show-adm-reseller-stock-detail/{id}', [AdmResellerStockDetailController::class, 'show'])->name('adm.resellers.reseller-stock-detail.show-adm-reseller-stock-detail');
    Route::post('/adm/resellers/reseller-stock-detail/created-adm-reseller-stock-detail', [AdmResellerStockDetailController::class, 'created'])->name('adm.resellers.reseller-stock-detail.created-adm-reseller-stock-detail');
    Route::post('/adm/resellers/reseller-stock-detail/created-table-adm-reseller-stock-detail', [AdmResellerStockDetailController::class, 'createdTable'])->name('adm.resellers.reseller-stock-detail.created-table-adm-reseller-stock-detail');
    Route::post('/adm/resellers/reseller-stock-detail/updated-adm-reseller-stock-detail', [AdmResellerStockDetailController::class, 'updated'])->name('adm.resellers.reseller-stock-detail.updated-adm-reseller-stock-detail');
    Route::post('/adm/resellers/reseller-stock-detail/deleted-adm-reseller-stock-detail', [AdmResellerStockDetailController::class, 'deleted'])->name('adm.resellers.reseller-stock-detail.deleted-adm-reseller-stock-detail');

    // ADM plansS PAGES
    Route::get('/adm/plans/table-plans', [PlanController::class, 'table'])->name('adm.plans.table-plans');
    Route::get('/adm/plans/subscription-success-plans', [PlanController::class, 'subscriptionSucces'])->name('adm.plans.subscription-success-plans');
    Route::get('/adm/plans/add-plans', [PlanController::class, 'add'])->name('adm.plans.add-plans');
    Route::get('/adm/plans/edit-plans/{id}', [PlanController::class, 'edit'])->name('adm.plans.edit-plans');
    Route::get('/adm/plans/conf-delete-plans/{id}', [PlanController::class, 'confDelete'])->name('adm.plans.conf-delete-plans');
    Route::get('/adm/plans/show-plans/{id}', [PlanController::class, 'show'])->name('adm.plans.show-plans');
    Route::get('/adm/plans/vis-plan', [PlanController::class, 'vis'])->name('adm.plans.vis-plans');
    Route::get('/adm/plans/selected-plan/{id}', [PlanController::class, 'selected'])->name('adm.plans.selected-plans');
    Route::post('/adm/plans/created-plans', [PlanController::class, 'created'])->name('adm.plans.created-plans');
    Route::post('/adm/plans/updated-plans', [PlanController::class, 'updated'])->name('adm.plans.updated-plans');
    Route::post('/adm/plans/deleted-plans', [PlanController::class, 'deleted'])->name('adm.plans.deleted-plans');

    // ADM SETTINGS PAGES
    Route::get('/adm/settings/table-setting', [SettingsDetailController::class, 'table'])->name('adm.settings.table-settings');
    Route::get('/adm/settings/add-setting', [SettingsDetailController::class, 'add'])->name('adm.settings.add-settings');
    Route::get('/adm/settings/edit-setting/{id}', [SettingsDetailController::class, 'edit'])->name('adm.settings.edit-settings');
    Route::get('/adm/settings/conf-delete-setting/{id}', [SettingsDetailController::class, 'confDelete'])->name('adm.settings.conf-delete-settings');
    Route::get('/adm/settings/show-setting/{id}', [SettingsDetailController::class, 'show'])->name('adm.settings.show-settings');
    Route::post('/adm/settings/created-setting', [SettingsDetailController::class, 'created'])->name('adm.settings.created-settings');
    Route::post('/adm/settings/updated-setting', [SettingsDetailController::class, 'updated'])->name('adm.settings.updated-settings');
    Route::post('/adm/settings/deleted-setting', [SettingsDetailController::class, 'deleted'])->name('adm.settings.deleted-settings');

    // ADM CORS PAGES
    Route::get('/adm/cors/table-cors', [CorController::class, 'table'])->name('adm.cors.table-cors');
    Route::get('/adm/add-cors', [CorController::class, 'add'])->name('adm.cors.add-cors');
    Route::get('/adm/cors/edit-cors/{id}', [CorController::class, 'edit'])->name('adm.cors.edit-cors');
    Route::get('/adm/cors/conf-delete-cors/{id}', [CorController::class, 'confDelete'])->name('adm.cors.conf-delete-cors');
    Route::get('/adm/cors/show-cors/{id}', [CorController::class, 'show'])->name('adm.cors.show-cors');
    Route::post('/adm/cors/created-cors', [CorController::class, 'createdCors'])->name('adm.cors.created-cors');
    Route::post('/adm/cors/updated-cors', [CorController::class, 'updated'])->name('adm.cors.updated-cors');
    Route::post('/adm/deleted-cors', [CorController::class, 'deleted'])->name('adm.cors.deleted-cors');

    // ADM COR BOOTSTRAPS PAGES
    Route::get('/adm/cor-bootstraps/cors/table-cor-bootstraps', [CorBootstrapController::class, 'table'])->name('adm.cor-bootstraps.table-cor-bootstraps');
    Route::get('/adm/cor-bootstraps/add-cor', [CorBootstrapController::class, 'add'])->name('adm.cor-bootstraps.add-cor-bootstraps');
    Route::get('/adm/ors/cor-bootstraps/edit-cor/{id}', [CorBootstrapController::class, 'edit'])->name('adm.cor-bootstraps.edit-cor-bootstraps');
    Route::get('/adm/cors/or-bootstraps/conf-delete-cor/{id}', [CorBootstrapController::class, 'confDelete'])->name('adm.cor-bootstraps.conf-delete-cor-bootstraps');
    Route::get('/adm/cors/or-bootstraps/show-cor/{id}', [CorBootstrapController::class, 'show'])->name('adm.cor-bootstraps.show-cor-bootstraps');
    Route::post('/adm/cors/or-bootstraps/created-cor', [CorBootstrapController::class, 'created'])->name('adm.cor-bootstraps.created-cor-bootstraps');
    Route::post('/adm/cors/or-bootstraps/updated-cor', [CorBootstrapController::class, 'updated'])->name('adm.cor-bootstraps.updated-cor-bootstraps');
    Route::post('/adm/cors/or-bootstraps/deleted-cor', [CorBootstrapController::class, 'deleted'])->name('adm.cor-bootstraps.deleted-cor-bootstraps');

    // ADM ACCESS PAGES
    Route::get('/adm/settings/access/table-access', [AccessController::class, 'table'])->name('admin.settings.access.table-access');
    Route::get('/adm/settings/access/add-access', [AccessController::class, 'add'])->name('admin.settings.access.add-access');
    Route::get('/adm/settings/access/edit-access/{id}', [AccessController::class, 'edit'])->name('admin.settings.access.edit-access');
    Route::get('/adm/settings/access/conf-delete-access/{id}', [AccessController::class, 'confDelete'])->name('admin.settings.access.conf-delete-access');
    Route::get('/adm/settings/access/show-access/{id}', [AccessController::class, 'show'])->name('admin.settings.access.show-access');
    Route::post('/adm/settings/access/created-access', [AccessController::class, 'created'])->name('admin.settings.access.created-access');
    Route::post('/adm/settings/access/updated-access', [AccessController::class, 'updated'])->name('admin.settings.access.updated-access');
    Route::post('/adm/settings/access/deleted-access', [AccessController::class, 'deleted'])->name('admin.settings.access.deleted-access');

    // ADM SUPPLIERS PAGES
    Route::get('/adm/suppliers/table-suppliers', [SupplierController::class, 'table'])->name('adm.suppliers.table-suppliers');
    Route::get('/adm/suppliers/add-suppliers', [SupplierController::class, 'add'])->name('adm.suppliers.add-suppliers');
    Route::get('/adm/suppliers/edit-suppliers/{id}', [SupplierController::class, 'edit'])->name('adm.suppliers.edit-suppliers');
    Route::get('/adm/suppliers/conf-delete-suppliers/{id}', [SupplierController::class, 'confDelete'])->name('adm.suppliers.conf-delete-suppliers');
    Route::get('/adm/suppliers/show-suppliers/{id}', [SupplierController::class, 'show'])->name('adm.suppliers.show-suppliers');
    Route::post('/adm/suppliers/created-suppliers', [SupplierController::class, 'created'])->name('adm.suppliers.created-suppliers');
    Route::post('/adm/suppliers/updated-suppliers', [SupplierController::class, 'updated'])->name('adm.suppliers.updated-suppliers');
    Route::post('/adm/suppliers/deleted-suppliers', [SupplierController::class, 'deleted'])->name('adm.suppliers.deleted-suppliers');

    // ADM CATEGORIES PAGES
    Route::get('/adm/categories/table-category', [CategoryController::class, 'table'])->name('adm.categories.table-category');
    Route::get('/adm/categories/add-category', [CategoryController::class, 'add'])->name('adm.categories.add-category');
    Route::get('/adm/categories/edit-category/{id}', [CategoryController::class, 'edit'])->name('adm.categories.edit-category');
    Route::get('/adm/categories/conf-delete-category/{id}', [CategoryController::class, 'confDelete'])->name('adm.categories.conf-delete-category');
    Route::get('/adm/categories/show-category/{id}', [CategoryController::class, 'show'])->name('adm.categories.show-category');
    Route::post('/adm/categories/created-category', [CategoryController::class, 'created'])->name('adm.categories.created-category');
    Route::post('/adm/categories/updated-category', [CategoryController::class, 'updated'])->name('adm.categories.updated-category');
    Route::post('/adm/categories/deleted-category', [CategoryController::class, 'deleted'])->name('adm.categories.deleted-category');

    // ADM PRODUCTS PAGES
    Route::get('/adm/products/table-product', [ProductController::class, 'table'])->name('adm.products.table-product');
    Route::get('/adm/products/add-product', [ProductController::class, 'add'])->name('adm.products.add-product');
    Route::get('/adm/products/edit-product/{id}', [ProductController::class, 'edit'])->name('adm.products.edit-product');
    Route::get('/adm/products/status-confirmed-product/{id}', [ProductController::class, 'statusConfirmed'])->name('adm.products.status-confirmed-product');
    Route::get('/adm/products/status-non-production-product/{id}', [ProductController::class, 'statusNonProduction'])->name('adm.products.status-non-production-product');
    Route::get('/adm/products/conf-delete-product/{id}', [ProductController::class, 'confDelete'])->name('adm.products.conf-delete-product');
    Route::get('/adm/products/show-product/{id}', [ProductController::class, 'show'])->name('adm.products.show-product');
    Route::post('/adm/products/created-product', [ProductController::class, 'created'])->name('adm.products.created-product');
    Route::post('/adm/products/updated-product', [ProductController::class, 'updated'])->name('adm.products.updated-product');
    Route::post('/adm/products/deleted-product', [ProductController::class, 'deleted'])->name('adm.products.deleted-product');



    Route::get('/adm/admin/avata-user/add-avata-users', [AvataUserController::class, 'add'])->name('adm.admin.avata-user.add-avata-users');
    Route::get('/adm/admin/avata-user/edit-avata-users/{id}', [AvataUserController::class, 'edit'])->name('adm.admin.avata-user.edit-avata-users');
    Route::post('/adm/admin/reseller-avata-user/created-avata-users', [AvataUserController::class, 'created'])->name('adm.admin.avata-users.created-avata-users');
    Route::post('/adm/admin/avata-user/updated-avata-users', [AvataUserController::class, 'updated'])->name('adm.admin.avata-users.updated-avata-users');
    

    // magazine_update  
    Route::get('/adm/products/table-magazine-update-product', [MagazineUpdateController::class, 'tableMagazineUpdateProduct'])->name('adm.products.table-magazine-update-product');
    Route::get('/adm/products/confimed-magazine-update-product/{id}', [MagazineUpdateController::class, 'confirmedMagazineUpdateProduct'])->name('adm.products.confirmed-magazine-update-product');
    Route::get('/adm/products/non-production-magazine-update-product/{id}', [MagazineUpdateController::class, 'nonProductionMagazineUpdateProduct'])->name('adm.products.non-production-magazine-update-product');
    Route::post('/adm/products/updated-magazine-update-product', [MagazineUpdateController::class, 'updatedMagazineUpdateProduct'])->name('adm.products.updated-magazine-update-product');
 





























    