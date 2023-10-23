<?php

use Illuminate\Support\Facades\Route;
use Techcouchits\Genie\Http\Controllers\GenieController;

Route::get('contact', function () {
    return 'Contact';
});

Route::post('genie/pay/', [GenieController::class, 'geniepayment'])->name('genie.payment');
