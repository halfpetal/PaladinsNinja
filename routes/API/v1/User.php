<?php

Route::post('hirez-link', 'UserController@storeHiRezLink')->name('hirez-link.store');
Route::post('settings/new-password', 'SettingsController@changePassword')->name('new-password.store');