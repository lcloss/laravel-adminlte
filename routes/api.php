<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'admin', 'as' => 'api.admin.', 'middleware' => ['auth:sanctum']], function() {
    Route::delete('/tenants/{id}', '\App\Http\Controllers\Api\Admin\TenantController@destroy')->name('tenants.destroy');
    Route::delete('/users/{id}', '\App\Http\Controllers\Api\Admin\UserController@destroy')->name('users.destroy');
    Route::delete('/roles/{id}', '\App\Http\Controllers\Api\Admin\RoleController@destroy')->name('roles.destroy');
    Route::delete('/permissions/{id}', '\App\Http\Controllers\Api\Admin\PermissionController@destroy')->name('permissions.destroy');
});
