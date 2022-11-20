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

Route::group(['middleware' => ['auth']], function () {

  Route::get('/', function () {
    return view('index'); //view('welcome');
  })->name('home');


  require_once __DIR__. '/custom/items.php';

  require_once __DIR__. '/custom/categories.php';

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

  require_once __DIR__. '/custom/ajax.php';

  /*================================
  ||------ [Invoices Routes] ------||
  =================================*/
  Route::get('invoices/sales', 'InvoicesController@invoice_sales')->name('invoices.sales');
  Route::get('invoices/purchases', 'InvoicesController@invoice_purchases')->name('invoices.purchases');
  Route::get('invoices/bounces', 'InvoicesController@invoice_bounce')->name('invoices.bounces');

  Route::get('invoice/view/{id}', 'InvoicesController@view')->name('invoices.view');
  Route::get('invoice/edit/{id}', 'InvoicesController@edit')->name('invoices.edit');
  Route::get('invoice/sale', 'InvoicesController@sale')->name('invoices.sale');
  Route::get('invoice/purchase', 'InvoicesController@purchase')->name('invoices.purchase');
  Route::get('invoice/bounce', 'InvoicesController@sale')->name('invoices.bounce');

  Route::post('invoice/save', 'InvoicesController@save')->name('invoice.save');
  Route::post('invoice/update/{id}', 'InvoicesController@update')->name('invoice.update');
  Route::post('invoice/dues/pay', 'InvoicesController@invoiceDuesPay')->name('invoice.dues.pay');

  /*================================
  ||----- [Customers Routes] ------||
  =================================*/
  Route::get('users/customers', 'CustomersController@index')->name('users.customers');
  Route::get('user/create', 'CustomersController@create')->name('user.create');
  Route::get('user/edit/{id}', 'CustomersController@edit')->name('user.edit');
  Route::get('users/suppliers', 'CustomersController@suppliers')->name('users.suppliers');
  Route::get('users/supplier/{id}', 'CustomersController@supplier')->name('users.supplier');
  Route::get('user/supplier/create', 'CustomersController@supplierCreate')->name('user.suppliers.create');
  Route::get('user/supplier/edit/{id}', 'CustomersController@supplierEdit')->name('user.supplier.edit');

  Route::post('user/store', 'CustomersController@store')->name('user.store');
  Route::post('user/update/{id}', 'CustomersController@update')->name('user.update');
  Route::post('user/destroy/{id}', 'CustomersController@destroy')->name('user.destroy');

  Route::get('customer/invoice/{id}', 'CustomersController@invoice')->name('customer.invoice');

  /*================================
  ||---- [Installments Routes] ----||
  =================================*/
  Route::get('installments', 'InstallmentsController@index')->name('installments');
  Route::get('installment/user/{id}', 'InstallmentsController@byUser')->name('installment.user');
  Route::get('installments/paids', 'InstallmentsController@installmentPaids')->name('installment.paids');
  Route::get('installments/search', 'InstallmentsController@search')->name('installments.search');
  Route::get('installments/create', 'InstallmentsController@create')->name('installments.create');
  Route::get('installments/view/{id}', 'InstallmentsController@view')->name('installments.view');
  Route::get('installment/month/print/{id}', 'InstallmentsController@print')->name('installments.print');

  Route::post('installments/srore', 'InstallmentsController@store')->name('installments.store');
  Route::post('installment/month/debt/payment/modal', 'InstallmentsController@monthModal')->name('month.payment.modal');
  Route::post('installments/debt/payment/{id}', 'InstallmentsController@debtPayment')->name('installments.debt.payment');

  /*================================
  ||------- [Users Routes] --------||
  =================================*/
  Route::get('user/purchases/{id}', 'CustomersController@purchases')->name('user.purchases');
  Route::get('user/sales/{id}', 'CustomersController@sales')->name('user.sales');
  Route::get('user/bounces/{id}', 'CustomersController@bounces')->name('user.bounces');
  Route::get('user/damages/{id}', 'CustomersController@damages')->name('user.damages');

  Route::get('users/employees', 'UsersController@index')->name('users.employees');
  Route::get('users/employee/create', 'UsersController@create')->name('users.employee.create');
  Route::get('users/employee/edit/{id}', 'UsersController@edit')->name('users.employee.edit');

  Route::post('users/employee/store', 'UsersController@store')->name('users.employee.store');
  Route::post('users/employee/update/{id}', 'UsersController@update')->name('users.employee.update');

  /*================================
  ||----- [Permission Routes] -----||
  =================================*/
  Route::get('permissions', 'PermissionController@index')->name('permissions');
  Route::get('permission/create', 'PermissionController@create')->name('permission.create');
  Route::get('permission/edit/{id}', 'PermissionController@edit')->name('permission.edit');

  Route::post('permission/store', 'PermissionController@store')->name('permission.store');
  Route::post('permission/update/{id}', 'PermissionController@update')->name('permission.update');

  /*================================
  ||------ [Reports Routes] -------||
  =================================*/
  Route::get('reports/items/inventory', 'ReportsController@itemsInventory')->name('reports.items.inventory');
  Route::get('reports/invoice/sale', 'ReportsController@saleInvoice')->name('reports.invoice.sale');
  Route::get('reports/daily', 'ReportsController@daily')->name('reports.daily');

  /*================================
  ||------ [Options Routes] -------||
  =================================*/
  Route::get('settings', 'OptionsController@index')->name('settings.index');
  Route::post('setting/update', 'OptionsController@update')->name('settings.update');

  /*================================
  ||----- [Settlement Routes] -----||
  =================================*/

  Route::post('settlement/save', 'SettlementController@save')->name('settlement.save');
});

Auth::routes();
