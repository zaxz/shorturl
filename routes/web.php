<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ShortURLController;
use Illuminate\Support\Facades\Route;

Route::get('/error', fn()=> view('error-page'));


Route::get('/',[ShortURLController::class, 'index']);
Route::get('/edit',[ShortURLController::class, 'edit'])->name('shorturl.edit');
Route::post('/generate',[ShortURLController::class, 'store'])->name('generate');
Route::delete('/{id}',[ShortURLController::class, 'delete'])->name('shorturl.delete');

Route::get('/register', fn()=> view('auth.register'))->middleware('guest');
Route::post('/register',[AuthController::class, 'register'])->name('register');

Route::get('/login', fn()=> view('auth.login'))->middleware('guest');
Route::post('/login',[AuthController::class, 'login'])->name('loginUser');

Route::post('/logout',LogoutController::class)->name('logout')->middleware('auth');

Route::get('/{code}',[ShortURLController::class, 'shortenedUrl'])->name('shortened.url');