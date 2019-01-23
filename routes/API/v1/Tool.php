<?php

Route::post('loadout-builder', 'LoadoutBuilderController@store')->name('loadout-builder.store');
Route::post('tierlist', 'TierlistController@store')->name('tierlist.store');