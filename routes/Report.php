<?php

use App\Http\Controllers\Report\ReportGroupsController;
use App\Http\Controllers\Report\ReportManagement;
use App\Http\Controllers\Report\ShowReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Report Routes
|--------------------------------------------------------------------------
*/
//ReportGroup
Route::middleware('auth')->group(function (){
    Route::get('/Report/ReportGroup',[ReportGroupsController::class,'Index'])->name('ReportGroup');
    Route::post('/Report/ReportGroup/Add',[ReportGroupsController::class,'Add'])->name('AddReportGroup');
    Route::post('/Report/ReportGroup/Edit',[ReportGroupsController::class,'Edit'])->name('EditReportGroup');
    Route::post('/Report/ReportGroup/Delete',[ReportGroupsController::class,'Delete'])->name('DeleteReportGroup');
    Route::get('/Report/ReportGroup/GetInformation/{id}',[ReportGroupsController::class,'GetInformation'])->name('GetReportGroup');
    //ReportManagement
    Route::get('/Report/ReportManagement',[ReportManagement::class,'Index'])->name('ReportManagement');
    Route::get('/Report/ReportManagement/Add',[ReportManagement::class,'AddReport'])->name('AddReportManagement');
    Route::get('/Report/ReportManagement/Edit/{id}',[ReportManagement::class,'EditReport'])->name('EditReportManagement');
    Route::post('/Report/ReportManagement/StoreReport',[ReportManagement::class,'StoreReport'])->name('StoreReport');
    Route::post('/Report/ReportManagement/Delete',[ReportManagement::class,'DeleteReport'])->name('DeleteReport');
    Route::get('/Report/ReportManagement/GetColumn/{name}',[ReportManagement::class,'GetColumn'])->name('GetColumn');
    Route::post('/Report/ReportManagement/query',[ReportManagement::class,'RunQuery'])->name('RunQuery');
    //ShowReport
    Route::get('/Report/ShowReport/{id}',[ShowReportController::class,'Index'])->name('ShowReport');
    Route::post('/Report/ShowReport',[ShowReportController::class,'ReportResult'])->name('ReportResult');
});

//Route::post('/Base/University/Add',[UniversityController::class,'AddUniversity'])->name('AddUniversity');
//Route::post('/Base/University/Edit',[UniversityController::class,'EditUniversity'])->name('EditUniversity');
//Route::post('/Base/University/Delete',[UniversityController::class,'DeleteUniversity'])->name('DeleteUniversity');
