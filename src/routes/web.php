<?php

use Illuminate\Support\Facades\Route;
use Techcouchits\Genie\Http\Controllers\GenieController;


Route::get('genie/pay/{payment}/{reference}', [GenieController::class, 'geniepayment'])->name('genie.payment');
