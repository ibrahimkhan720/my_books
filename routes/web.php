<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('xxx', function () {
//         return view('Admin.dashboard.index');
//     })->name('Admin.dashboard');
// });


Route::group(['prefix' => 'admin'], function() {
    Route::get('login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');
     Route::get('password/reset', [\App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [\App\Http\Controllers\Auth\AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [\App\Http\Controllers\Auth\AdminResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [\App\Http\Controllers\Auth\AdminResetPasswordController::class, 'reset'])->name('password.update');

});

Route::middleware(['auth:web', 'roleCheck'])->get('/dashboard', function () {
    return redirect('/admin/dashboard');
});


Route::group(['prefix' => 'admin' , 'middleware' => ['auth:web' , 'roleCheck']] , function() {
    Route::get('dashboard' ,[ \App\Http\controllers\Admin\DashboardController::class , 'index'])->name('dashboard');

     //user routes
     Route::resource('user' , \App\Http\controllers\Admin\UserController::class);
    Route::get('user/toggle/{id}' , [\App\Http\Controllers\Admin\UserStatusController::class , 'status'])->name('user.status');

    //category routes
    Route::resource('category' , \App\Http\controllers\Admin\CategoryController::class)->except(['show']);
    Route::get('category/toggle/{id}' , [\App\Http\Controllers\Admin\CategoryStatusController::class , 'status'])->name('category.status');
    Route::post('category/active_status' , [\App\Http\Controllers\Admin\CategoryStatusController::class , 'active_all_status'])->name('category.Active.status');
    // Route::get('category/deactive_status' , [\App\Http\Controllers\Admin\CategoryStatusController::class , 'deactive_all_status'])->name('Deactive.status');

    //author routes
    Route::resource('author' , \App\Http\controllers\Admin\AuthorController::class);
    Route::get('author/toggle/{id}' ,[\App\Http\Controllers\Admin\AuthorStatusController::class , 'status'])->name('author.status');

    //book routes
    Route::resource('book' , \App\Http\controllers\Admin\BookController::class);
    Route::get('book/toggle/{id}' , [\App\Http\Controllers\Admin\BookStatusController::class , 'status'])->name('book.status');

    //team routes
    Route::resource('team' , \App\Http\controllers\Admin\TeamController::class);
    Route::get('team/toggle/{id}' , [\App\Http\Controllers\Admin\TeamStatusController::class , 'status'])->name('team.status');

    //media routes
    Route::resource('media' , \App\Http\controllers\Admin\MediaController::class);
    Route::get('media/toggle/{id}' , [\App\Http\Controllers\Admin\MediaStatusController::class , 'status'])->name('media.status');
    
    //role routes
    Route::resource('role' , \App\Http\Controllers\Admin\RoleController::class);

    //role profile
    Route::get('profile/{id}/edit' , [\App\Http\Controllers\Admin\ProfileController::class , 'edit'])->name('profile.edit');
       Route::put('profile/{id}', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
     Route::post('change-password' , [\App\Http\Controllers\Admin\ProfileController::class , 'changepassword'])->name('profile.store');

    

});
    

    //frontend
Route::get('/', [App\Http\Controllers\Frontend\MainController::class ,'index'])->name('home.index');
Route::get('/about', [App\Http\Controllers\Frontend\MainController::class ,'about'])->name('home.about');
Route::get('/gallery', [App\Http\Controllers\Frontend\MainController::class ,'gallery'])->name('home.gallery');
Route::get('/author', [App\Http\Controllers\Frontend\MainController::class ,'author'])->name('home.author');
Route::get('/author_detail/{slug}' ,[App\Http\Controllers\Frontend\MainController::class, 'author_detail'])->name('author_detail');
Route::get('/category_detail/{slug}' ,[App\Http\Controllers\Frontend\MainController::class, 'category_detail'])->name('category_detail');
Route::get('/book_detail/{slug}', [App\Http\Controllers\Frontend\MainController::class, 'book_detail'])->name('book.detail');
Route::get('/registor' , [\App\Http\Controllers\Frontend\RegistorController::class , 'create']);
Route::post('/registor' , [\App\Http\Controllers\Frontend\RegistorController::class , 'register'])->name('register.store');

//auth registor
Route::get('user/login', [\App\Http\Controllers\Auth\RegisterLoginController::class, 'showLoginForm'])->name('user.login');
Route::post('user/login', [\App\Http\Controllers\Auth\RegisterLoginController::class, 'login'])->name('user.login.submit');
Route::get('user/password/reset', [\App\Http\Controllers\Auth\UserForgotPasswordController::class, 'showLinkRequestForm'])->name('register.password.request');
Route::post('user/password/email', [\App\Http\Controllers\Auth\UserForgotPasswordController::class, 'sendResetLinkEmail'])->name('register.password.email');
Route::get('user/password/reset/{token}', [\App\Http\Controllers\Auth\UserResetPasswordController::class, 'showResetForm'])->name('register.password.reset');
Route::post('user/password/reset', [\App\Http\Controllers\Auth\UserResetPasswordController::class, 'reset'])->name('register.password.update');


Route::middleware(['auth:register'])->group(function () {
   Route::get('/cart' , [\App\Http\Controllers\Frontend\CartController::class , 'show'])->name('cart.index');
   Route::post('/add-cart' , [\App\Http\Controllers\Frontend\CartController::class , 'store'])->name('cart.store');
  Route::get('/delete-cart/{id}', [\App\Http\Controllers\Frontend\CartController::class, 'destroy'])->name('cart.destroy');
  Route::post('/cart' , [\App\Http\Controllers\Frontend\CartController::class , 'placeorder'])->name('cart.checkout');
});