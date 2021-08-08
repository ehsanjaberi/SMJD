<?php

use App\Http\Controllers\MessengerController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;
require 'Users.php';
require 'Base.php';
require 'Report.php';
require 'Management.php';
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
Route::get('/',function (){
    $Systems=\App\Models\Uni_SubSystems::all();
   return view('dashboard')->with('Sub',$Systems);
})->middleware('auth')->name('dashboard');

Route::get('/Messenger',[MessengerController::class,'Index'])->middleware('auth')->name('Messenger');

Route::post('/Messenger/send',[MessengerController::class,'SendMessage'])->name('sendMessage');
Route::get('/Messenger/GetContacts',[MessengerController::class,'GetContacts'])->name('GetContacts');
Route::get('/Messenger/GetAllContacts',[MessengerController::class,'GetAllContacts'])->name('GetAllContacts');
Route::post('/Messenger/GetContactMessage',[MessengerController::class,'GetContactMessage'])->name('GetContactMessage');
Route::get('/Messenger/GetAllMessageToUser',[MessengerController::class,'GetAllMessageToUser'])->name('GetAllMessageToUser');
Route::post('/Messenger/DeleteMessage',[MessengerController::class,'DeleteMessage'])->name('DeleteMessage');
Route::post('/Messenger/DeleteAllMessage',[MessengerController::class,'DeleteAllMessage'])->name('DeleteAllMessage');






//Route::get('/Users',[UsersController::class,'Index'])->name('Users');
