<?php

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'role:super_admin|admin'])->group( function(){
    Route::get('/', 'WelcomeController@index')->name('welcome');

    Route::resource('categories', 'CategoryController')->except(['show']);
    Route::resource('roles', 'RoleController')->except(['show']);
    Route::resource('users', 'UserController')->except(['show']);
});
