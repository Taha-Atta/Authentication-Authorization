<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;



use App\Http\Controllers\Back\BackController;

use App\Http\Controllers\Back\HomeController;
use App\Http\Controllers\Back\RoleController;

use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\PermissionController;
use App\Http\Controllers\Back\AdminController as BackAdminController;



Route::get('/', function () {
    return view('welcome');
});



Route::prefix('front')->name('front.')->group(function(){

    Route::get('/',[FrontController::class,'index'])->middleware('auth')->name('index');

});
require __DIR__.'/auth.php';


/**================================Back========================================= */

Route::prefix('back')->name('back.')->group(function(){

    Route::get('/',[BackController::class,'index'])->name('index');
    // Route::resource('admins', AdminController::class);
    Route::resource('admins', AdminController::class);
    Route::get('admins/{adminId}/delete',[AdminController::class,'destroy']);
    Route::resource('users', UserController::class);
    Route::get('users/{userId}/delete',[UserController::class,'destroy']);

    require __DIR__.'/AdminAuth.php';
});



    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('permissions/{permissionId}/delete',[ PermissionController::class,'destroy']);
    Route::get('roles/{roleId}/delete',[ RoleController::class,'destroy']);
    // ->middleware('permission:delete roles');
    Route::get('roles/{roleId}/givePermissionToRole',[ RoleController::class,'PermissionToRole']);
    Route::put('roles/{roleId}/givePermissionToRole',[ RoleController::class,'givePermissionToRole']);






