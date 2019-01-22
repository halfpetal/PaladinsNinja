<?php

use Illuminate\Http\Request;

Route::group([
    "middleware" => [\Barryvdh\Cors\HandleCors::class],
], function () {
    Route::post("login", "ProxyController@login")->name("proxy.login");
    Route::post("refresh", "ProxyController@refresh")->name("proxy.refresh");
});