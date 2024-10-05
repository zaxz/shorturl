<?php

use App\Http\Controllers\ShortlinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('shortenlink');
});
Route::get('error-page', function () {
    return view('error-page');
});

Route::get('generate-shorten-link',[ShortlinkController::class, 'index']);
Route::post('generate-shorten-link',[ShortlinkController::class, 'store'])->name('generate.shorturl');
Route::get('/{code}',[ShortlinkController::class, 'shortenlink'])->name('shorten.link');