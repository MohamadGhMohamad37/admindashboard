<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\admin\AdminDashController;
use App\Http\Controllers\Auth\admin\user\UserController;
use App\Http\Controllers\StatckController;
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

Route::get('/', [StatckController::class,'index'])->name('home.page');
//test verify page
Route::get('/verify', function () {
    return view('emails.verify');
});
Route::get('/register',[RegisterController::class,'index'])->name('register.page');
Route::post('/register',[RegisterController::class,'create'])->name('register.create');
Route::get('/verify/{token}', [RegisterController::class, 'verify']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::group(['middleware' => 'admin'], function () {
Route::get('/admin/dashboard',[AdminDashController::class,'index'])->name('admin.index');
Route::get('/admin/profile',[UserController::class,'profile'])->name('admin.prolile');
Route::post('/admin/confirm',[RegisterController::class,'confirm_email'])->name('confirm.email');
Route::get('/verify/emai/{token}', [RegisterController::class, 'verify_emails']);
Route::get('admin/user/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('admin/user/update', [UserController::class, 'update'])->name('user.update');
});