<?php

use Illuminate\Support\Facades\Route;

Route::get('warning', function () {
    return view('joynala.maker::warning');
})->name('warning');
