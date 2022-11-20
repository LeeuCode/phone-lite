<?php

/*================================
||----- [Categories Routes] -----||
=================================*/

Route::get('categories', 'CategoriesController@index')->name('categories');
Route::get('unities', 'CategoriesController@unities')->name('unities');
Route::get('models', 'CategoriesController@models')->name('models');

Route::post('category/store', 'CategoriesController@store')->name('category.store');
Route::post('category/update/{id}', 'CategoriesController@update')->name('category.update');
Route::post('category/status/{id}', 'CategoriesController@status')->name('category.status');
