<?php

use App\Http\Controllers\ShortURLController;
use Illuminate\Support\Facades\Route;

Route::get('error', function () {
    return view('error-page');
});
Route::get('/',[ShortURLController::class, 'index']);
Route::post('/',[ShortURLController::class, 'store'])->name('generate');
Route::get('/{code}',[ShortURLController::class, 'shortenedUrl'])->name('shortened.url');