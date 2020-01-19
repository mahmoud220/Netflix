<?php

Route::prefix('dashboard')->name('dashboard.')->group( function(){
    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::resource('categories', 'CategoryController');
});
