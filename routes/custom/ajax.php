<?php

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
Route::get('ajax/installment/user', 'AjaxController@getInstallmentByCustomer')->name('ajax.installment.user');
Route::get('ajax/installment/months', 'AjaxController@getMonthsByInstallment')->name('ajax.months.installment');
Route::get('ajax/invoice/remaining/amount', 'AjaxController@getInvoiceRemainingAmount')
    ->name('ajax.invoice.remaining.amount');
Route::get('ajax/invoice/dues', 'AjaxController@getInvoicesDues')->name('ajax.invoice.dues');

Route::get('ajax/dues/customers', 'AjaxController@getDuesCustomers')->name('ajax.dues.getCustomers');
Route::get('ajax/dues/suppliers', 'AjaxController@getDuesSuppliers')->name('ajax.dues.getSuppliers');
Route::get('ajax/customer/balance/{id}', 'AjaxController@getCustomerBalance')->name('ajax.customer.balance');

Route::post('ajax/createCategory', 'AjaxController@createCategory')->name('ajax.createCategory');
Route::post('ajax/createUser', 'AjaxController@createUser')->name('ajax.createUser');
Route::post('ajax/invoice/dues', 'AjaxController@invoiceDues')->name('ajax.invoice.dues');
