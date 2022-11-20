<?php

  /*================================
  ||-------- [Items Routes] -------||
  =================================*/
  Route::get('items', 'ItemsController@index')->name('items');
  Route::get('items/out-of-stock', 'ItemsController@outOfStock')->name('items.out-of-stock');
  Route::get('item/create', 'ItemsController@create')->name('item.create');
  Route::get('item/edit/{id}', 'ItemsController@edit')->name('item.edit');
  Route::get('item/search', 'ItemsController@search')->name('item.search');
  Route::get('item/balance', 'ItemsController@balance')->name('item.balance');

  Route::post('item/store', 'ItemsController@store')->name('item.store');
  Route::post('item/update/{id}', 'ItemsController@update')->name('item.update');
  Route::post('item/status/{id}', 'ItemsController@status')->name('item.status');
  Route::post('item/balance/store', 'ItemsController@balanceStore')->name('item.balance.store');