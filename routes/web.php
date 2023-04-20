<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    dd(Auth::user()->can('delete post'));
    // dd(Auth::user()->hasPermissions('delete post')); 
    // return view('welcome');
})->name('home');

Route::namespace('Auth')->prefix('auth')->group(function(){
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('auth.register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('auth.register');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
    Route::get('/logout', [LoginController::class, 'logout'])->name('auth.logout');
});


