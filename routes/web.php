<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\admin\AdminDashController;
use App\Http\Controllers\Auth\admin\user\UserController;
use App\Http\Controllers\Auth\admin\CategoryController;
use App\Http\Controllers\Auth\admin\SubcategoryController;
use App\Http\Controllers\Auth\admin\ProductController;

use App\Http\Controllers\StatckController;
use App\Http\Controllers\StripeBalanceController;
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
Route::get('admin/profile/edit', [UserController::class, 'edit'])->name('user.edit');
Route::post('admin/profile/update', [UserController::class, 'update'])->name('user.update');
Route::resource('admin/categories', CategoryController::class);
Route::get('admin/categories/{category}/pdf', [CategoryController::class, 'downloadPdf'])->name('categories.pdf');
Route::resource('admin/subcategories', SubcategoryController::class);
Route::get('admin/subcategories/{subcategory}/download-pdf', [SubcategoryController::class, 'downloadPdf'])->name('subcategories.downloadPdf');
Route::resource('admin/products', ProductController::class);
Route::get('products/{id}/pdf', [ProductController::class, 'downloadPdf'])->name('products.downloadPdf');
Route::get('admin/admin',[AdminDashController::class,'adminsget'])->name('admin.admins');
Route::get('admin/admin/create',[AdminDashController::class,'admincreate'])->name('admin.createadmin');
Route::post('admin/admin/create',[AdminDashController::class,'storeadmin'])->name('admin.storeadmin');
Route::get('admin/users',[AdminDashController::class,'usersget'])->name('admin.users');
Route::get('admin/users/create',[AdminDashController::class,'userscreate'])->name('admin.createuser');
Route::post('admin/admin/create',[AdminDashController::class,'storeuser'])->name('admin.storeuser');
Route::get('admin/users/{id}', [AdminDashController::class, 'usershow'])->name('admin.showuser');
Route::delete('admin/users/{id}', [AdminDashController::class, 'userdestroy'])->name('admin.deleteuser');

});
