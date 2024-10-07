<?php

use App\Http\Controllers\ShortlinkController;
use Illuminate\Support\Facades\Route;

Route::get('error-page', function () {
    return view('error-page');
});

Route::get('/',[ShortlinkController::class, 'index']);
Route::post('/',[ShortlinkController::class, 'store'])->name('generate.shorturl');
Route::get('/{code}',[ShortlinkController::class, 'shortenlink'])->name('shorten.link');