<?php

use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Users Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/Users/Show', [UsersController::class, 'Index'])->name('Users');
    Route::get('/Users/Permission', [UsersController::class, 'Permission'])->name('Permission');
    Route::get('/Users/GetPermission', [UsersController::class, 'GetPermission'])->name('GetPermission');
    Route::get('/Users/GetRolePermission/{Id}', [UsersController::class, 'GetRolePermission'])->name('GetRolePermission');
    Route::post('/Users/AddRole', [UsersController::class, 'AddRole'])->name('AddRole');
    Route::post('/Users/EditRole', [UsersController::class, 'EditRole'])->name('EditRole');
    Route::post('/Users/DeleteRole', [UsersController::class, 'DeleteRole'])->name('DeleteRole');

//User
    Route::post('/Users/Delete', [UsersController::class, 'DeleteUser'])->name('DeleteUser');
    Route::post('/Users/Edit', [UsersController::class, 'EditUser'])->name('EditUser');
    Route::post('/Users/SetRole', [UsersController::class, 'UserRole'])->name('UserRole');
    Route::get('/Users/GetUserRole/{id}', [UsersController::class, 'GetUserRole'])->name('GetUserRole');
    Route::post('/Users/SearchPerson', [UsersController::class, 'SearchPerson'])->name('SearchPerson');
    Route::post('/Users/UniqueUsername', [UsersController::class, 'UniqueUsername'])->name('UniqueUsername');
});
