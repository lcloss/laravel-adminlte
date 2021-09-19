<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function() {
    return view('front.home');
})->name('home');

Route::redirect('/', '/login');

Route::get('userVerification/{token}', '\App\Http\Controllers\Auth\UserVerificationController@approve')->name('userVerification');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function() {
    Route::get('/', function () {
        return view('admin.blank');
    })->name('home');
    Route::get('/dashboard', function () {
        return view('admin.dashboards.index');
    })->name('dashboard');

    Route::resource('tenants', '\App\Http\Controllers\Admin\TenantController');
    Route::resource('users', '\App\Http\Controllers\Admin\UserController');
    Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');
    Route::resource('permissions', '\App\Http\Controllers\Admin\PermissionController');
});

