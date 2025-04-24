<?php

use Illuminate\Support\Facades\Route;

Route::get('/stealth-login', function () {
    return redirect('/dashboard');
})->middleware('stealth.auth');