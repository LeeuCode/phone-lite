<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']], function(){

  Route::get('/', function () {
    return view('index'); //view('welcome');
  })->name('home');

  /*================================
  ||-------- [Items Routes] -------||
  =================================*/

  Route::get('items', 'ItemsController@index')->name('items');
  Route::get('item/create', 'ItemsController@create')->name('item.create');
  Route::get('item/edit/{id}', 'ItemsController@edit')->name('item.edit');
  Route::get('item/search', 'ItemsController@search')->name('item.search');

  Route::post('item/store', 'ItemsController@store')->name('item.store');
  Route::post('item/update/{id}', 'ItemsController@update')->name('item.update');
  Route::post('item/status/{id}', 'ItemsController@status')->name('item.status');

  /*================================
  ||----- [Categories Routes] -----||
  =================================*/

  Route::get('categories', 'CategoriesController@index')->name('categories');
  Route::get('unities', 'CategoriesController@unities')->name('unities');
  Route::get('models', 'CategoriesController@models')->name('models');
  Route::post('category/store', 'CategoriesController@store')->name('category.store');
  Route::post('category/update/{id}', 'CategoriesController@update')->name('category.update');
  Route::post('category/status/{id}', 'CategoriesController@status')->name('category.status');

  /*================================
  ||---- [Maintenances Routes] ----||
  =================================*/

  Route::get('maintenances', 'MaintenanceController@index')->name('maintenances');
  Route::get('maintenance/receipt', 'MaintenanceController@receipt')->name('maintenance.receipt');
  Route::get('maintenance/edit/{id}', 'MaintenanceController@edit')->name('maintenance.edit');
  Route::get('maintenance/delivery/{id}', 'MaintenanceController@delivery')->name('maintenance.delivery');
  Route::get('maintenance/search', 'MaintenanceController@search')->name('maintenance.search');

  Route::post('maintenance/store', 'MaintenanceController@store')->name('maintenance.store');
  Route::post('maintenance/update/{id}', 'MaintenanceController@update')->name('maintenance.update');

  /*================================
  ||---- [Maintenances Routes] ----||
  =================================*/
  Route::get('devices/used', 'usedDevicesController@index')->name('devices.used');
  Route::get('devices/used/sale', 'usedDevicesController@devicesSale')->name('devices.used.sale');
  Route::get('devices/used/search', 'usedDevicesController@search')->name('devices.search');
  Route::get('device/used/purchase', 'usedDevicesController@create')->name('devices.used.purchase');

  Route::post('device/used/store', 'usedDevicesController@store')->name('devices.used.store');
  Route::post('device/used/sale/{id}', 'usedDevicesController@sale')->name('devices.used.update');

  /*================================
  ||-------- [Ajax Routes] --------||
  =================================*/

  Route::get('ajax/items', 'AjaxController@getItems')->name('ajax.getItems');
  Route::get('ajax/item', 'AjaxController@getItem')->name('ajax.getItem');
  Route::get('ajax/categories', 'AjaxController@getCategories')->name('ajax.getCategories');
  Route::get('ajax/models', 'AjaxController@getModels')->name('ajax.getModels');
  Route::get('ajax/unities', 'AjaxController@getunities')->name('ajax.getunities');
  Route::get('ajax/damages', 'AjaxController@getDamges')->name('ajax.getDamges');
  Route::get('ajax/devices', 'AjaxController@getDvices')->name('ajax.getDvices');
  Route::get('ajax/customers', 'AjaxController@getCustomers')->name('ajax.getCustomers');
  Route::get('ajax/suppliers', 'AjaxController@getSuppliers')->name('ajax.getSuppliers');


  Route::post('ajax/createCategory', 'AjaxController@createCategory')->name('ajax.createCategory');
  Route::post('ajax/createUser', 'AjaxController@createUser')->name('ajax.createUser');

  /*================================
  ||------ [Invoices Routes] ------||
  =================================*/
  Route::get('invoices/{type}', 'InvoicesController@invoices')->name('invoices');
  Route::get('invoice/view/{id}', 'InvoicesController@view')->name('invoices.view');
  Route::get('invoice/sale', 'InvoicesController@sale')->name('invoices.sale');
  Route::get('invoice/purchase', 'InvoicesController@purchase')->name('invoices.purchase');
  Route::get('invoice/bounce', 'InvoicesController@sale')->name('invoices.bounce');

  Route::post('invoice/save', 'InvoicesController@save')->name('invoice.save');

  /*================================
  ||----- [Customers Routes] ------||
  =================================*/
  Route::get('users/customers', 'CustomersController@index')->name('users.customers');
  Route::get('user/create', 'CustomersController@create')->name('user.create');
  Route::get('user/edit/{id}', 'CustomersController@edit')->name('user.edit');
  Route::get('users/suppliers', 'CustomersController@suppliers')->name('users.suppliers');
  Route::get('user/supplier/create', 'CustomersController@supplierCreate')->name('user.suppliers.create');
  Route::get('user/supplier/edit/{id}', 'CustomersController@supplierEdit')->name('user.supplier.edit');

  Route::post('user/store', 'CustomersController@store')->name('user.store');
  Route::post('user/update/{id}', 'CustomersController@update')->name('user.update');
  Route::post('user/destroy/{id}', 'CustomersController@destroy')->name('user.destroy');

  /*================================
  ||---- [Installments Routes] ----||
  =================================*/
  Route::get('installments', 'InstallmentsController@index')->name('installments');
  Route::get('installments/paids', 'InstallmentsController@installmentPaids')->name('installment.paids');
  Route::get('installments/search', 'InstallmentsController@search')->name('installments.search');
  Route::get('installments/create', 'InstallmentsController@create')->name('installments.create');
  Route::get('installments/view/{id}', 'InstallmentsController@view')->name('installments.view');

  Route::post('installments/srore', 'InstallmentsController@store')->name('installments.store');
  Route::post('installments/debt/payment/{id}', 'InstallmentsController@debtPayment')->name('installments.debt.payment');

  /*================================
  ||------- [Users Routes] --------||
  =================================*/
  Route::get('users/employees', 'UsersController@index')->name('users.employees');
  Route::get('users/employee/create', 'UsersController@create')->name('users.employee.create');
  Route::get('users/employee/edit/{id}', 'UsersController@edit')->name('users.employee.edit');

  /*================================
  ||----- [Permission Routes] -----||
  =================================*/
  Route::get('permission/create', 'PermissionController@create')->name('permission.create');

  Route::post('permission/store', 'PermissionController@store')->name('permission.store');

  /*================================
  ||------ [Reports Routes] -------||
  =================================*/
  Route::get('reports/items/inventory', 'ReportsController@itemsInventory')->name('reports.items.inventory');
  Route::get('reports/invoice/sale', 'ReportsController@saleInvoice')->name('reports.invoice.sale');
  Route::get('reports/daily', 'ReportsController@daily')->name('reports.daily');

});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
