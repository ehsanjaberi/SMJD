<?php

use App\Http\Controllers\Base\CollegeController;
use App\Http\Controllers\Base\DegreeController;
use App\Http\Controllers\Base\EmployeeController;
use App\Http\Controllers\Base\EquipmentController;
use App\Http\Controllers\Base\FieldController;
use App\Http\Controllers\Base\GradeTypeController;
use App\Http\Controllers\Base\LessonController;
use App\Http\Controllers\Base\MenuController;
use App\Http\Controllers\Base\PostController;
use App\Http\Controllers\Base\SemesterController;
use App\Http\Controllers\Base\UniversityController;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Base Routes
|--------------------------------------------------------------------------
*/
//University
Route::middleware('auth')->group(function (){
    Route::get('/Base/University',[UniversityController::class,'Index'])->name('University');
    Route::get('/Base/University/GetInformation/{id}',[UniversityController::class,'GetInformation'])->name('GetUniversity');
    Route::post('/Base/University/Add',[UniversityController::class,'AddUniversity'])->name('AddUniversity');
    Route::post('/Base/University/Edit',[UniversityController::class,'EditUniversity'])->name('EditUniversity');
    Route::post('/Base/University/Delete',[UniversityController::class,'DeleteUniversity'])->name('DeleteUniversity');
    //College
    Route::get('/Base/College',[CollegeController::class,'Index'])->name('College');
    Route::get('/Base/College/GetInformation/{id}',[CollegeController::class,'GetInformation'])->name('GetCollege');
    Route::post('/Base/College/Add',[CollegeController::class,'AddCollege'])->name('AddCollege');
    Route::post('/Base/College/Edit',[CollegeController::class,'EditCollege'])->name('EditCollege');
    Route::post('/Base/College/Delete',[CollegeController::class,'DeleteCollege'])->name('DeleteCollege');
    //Field
    Route::get('/Base/Filed',[FieldController::class,'Index'])->name('Field');
    Route::get('/Base/Filed/GetCollegeInformation/{id}',[FieldController::class,'GetCollegeInformation'])->name('GetCollegeInformation');
    Route::get('/Base/Filed/GetInformation/{id}',[FieldController::class,'GetInformation'])->name('GetField');
    Route::post('/Base/Filed/Add',[FieldController::class,'AddFiled'])->name('AddField');
    Route::post('/Base/Filed/Edit',[FieldController::class,'EditField'])->name('EditFiled');
    Route::post('/Base/Filed/Delete',[FieldController::class,'DeleteFiled'])->name('DeleteFiled');
    //GradeType
    Route::get('/Base/GradeType',[GradeTypeController::class,'Index'])->name('GradeType');
    Route::post('/Base/GradeType/Add',[GradeTypeController::class,'AddGradeType'])->name('AddGradeType');
    Route::post('/Base/GradeType/Edit',[GradeTypeController::class,'EditGradeType'])->name('EditGradeType');
    Route::post('/Base/GradeType/Delete',[GradeTypeController::class,'DeleteGradeType'])->name('DeleteGradeType');
    //Degree
    Route::get('/Base/Degree',[DegreeController::class,'Index'])->name('Degree');
    Route::post('/Base/Degree/Add',[DegreeController::class,'AddDegree'])->name('AddDegree');
    Route::post('/Base/Degree/Edit',[DegreeController::class,'EditDegree'])->name('EditDegree');
    Route::post('/Base/Degree/Delete',[DegreeController::class,'DeleteDegree'])->name('DeleteDegree');
    //Lesson
    Route::get('/Base/Lesson',[LessonController::class,'Index'])->name('Lesson');
    Route::post('/Base/Lesson/Add',[LessonController::class,'AddLesson'])->name('AddLesson');
    Route::post('/Base/Lesson/Edit',[LessonController::class,'EditLesson'])->name('EditLesson');
    Route::post('/Base/Lesson/Delete',[LessonController::class,'DeleteLesson'])->name('DeleteLesson');
    Route::get('/Base/Lesson/GetInformation/{id}',[LessonController::class,'GetInformation'])->name('GetLesson');
    Route::get('/Base/Lesson/GetCollegeInformation/{id}',[LessonController::class,'GetCollegeInformation'])->name('GetCollegeInformationLesson');
    Route::get('/Base/Lesson/GetFiledInformation/{id}',[LessonController::class,'GetFieldInformation'])->name('GetFiledInformationLesson');
    //Semester
    Route::get('/Base/Semester',[SemesterController::class,'Index'])->name('Semester');
    Route::post('/Base/Semester/Add',[SemesterController::class,'AddSemester'])->name('AddSemester');
    Route::post('/Base/Semester/Edit',[SemesterController::class,'EditSemester'])->name('EditSemester');
    Route::post('/Base/Semester/Delete',[SemesterController::class,'DeleteSemester'])->name('DeleteSemester');
    Route::get('/Base/Semester/GetInformation/{id}',[SemesterController::class,'GetInformation'])->name('GetSemester');
    //Employee
    Route::get('/Base/Employee',[EmployeeController::class,'Index'])->name('Employee');
    Route::post('/Base/Employee/Add',[EmployeeController::class,'AddEmployee'])->name('AddEmployee');
    Route::post('/Base/Employee/Edit',[EmployeeController::class,'EditEmployee'])->name('EditEmployee');
    Route::post('/Base/Employee/Delete',[EmployeeController::class,'DeleteEmployee'])->name('DeleteEmployee');
    Route::post('/Base/Employee/AddUniversityPost',[EmployeeController::class,'AddUniversityPost'])->name('AddUniversityPost');
    Route::get('/Base/Employee/GetPostInformation/{id}',[EmployeeController::class,'GetPostInformation'])->name('GetPostInformation');
    Route::get('/Base/Employee/GetInformation/{id}',[EmployeeController::class,'GetInformation'])->name('GetEmployeeInformation');
    //Post
    Route::get('/Base/Post',[PostController::class,'Index'])->name('Post');
    Route::post('/Base/Post/Add',[PostController::class,'AddPost'])->name('AddPost');
    Route::post('/Base/Post/Edit',[PostController::class,'EditPost'])->name('EditPost');
    Route::post('/Base/Post/Delete',[PostController::class,'DeletePost'])->name('DeletePost');
    //Menu
    Route::get('/Base/Menu',[MenuController::class,'Index'])->name('Menu');
    Route::post('/Base/Menu/Edit',[MenuController::class,'EditMenu'])->name('EditMenu');
    Route::get('/Base/SubSystems',[MenuController::class,'IndexSubSystem'])->name('SubSystems');
    Route::post('/Base/SubSystems/Edit',[MenuController::class,'EditSubSystem'])->name('EditSubSystem');

    //Equipment
    Route::get('/Base/Equipment',[EquipmentController::class,'Index'])->name('Equipment');
    Route::post('/Base/Equipment/Add',[EquipmentController::class,'Add'])->name('AddEquipment');
    Route::post('/Base/Equipment/Edit',[EquipmentController::class,'Edit'])->name('EditEquipment');
    Route::post('/Base/Equipment/Delete',[EquipmentController::class,'Delete'])->name('DeleteEquipment');
    Route::get('/Base/Equipment/GetInf/{id}',[EquipmentController::class,'GetInf'])->name('GetEquipment');
    //Route::post('/Base/Menu/Edit',[MenuController::class,'EditMenu'])->name('EditMenu');
    //Route::get('/Base/SubSystems',[MenuController::class,'IndexSubSystem'])->name('SubSystems');
    //Route::post('/Base/SubSystems/Edit',[MenuController::class,'EditSubSystem'])->name('EditSubSystem');
});

