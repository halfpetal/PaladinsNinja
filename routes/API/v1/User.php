<?php

use PaladinsNinja\Http\Resources\UserResource;

Route::post('hirez-link', 'UserController@storeHiRezLink')->name('hirez-link.store');
Route::post('settings/new-password', 'SettingsController@changePassword')->name('new-password.store');
Route::get('me', function(Request $request) {
    return new UserResource(\Auth::user());
})->name('show')->middleware(['auth:api', 'hirez_link', 'scopes:user-info']);