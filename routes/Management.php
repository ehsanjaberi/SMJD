<?php
use App\Http\Controllers\Management\ClassController;
use App\Http\Controllers\Management\SemesterLessonController;
use App\Http\Controllers\Management\SemesterLessonGradeController;
use App\Http\Controllers\Management\SemesterLessonStudentController;
use App\Http\Controllers\Management\SemesterLessonToClassController;
use App\Http\Controllers\Management\StudentAttendance;
use App\Http\Controllers\Management\StudentController;
use App\Http\Controllers\Management\StudentGradeController;
use App\Http\Controllers\Management\TeacherAttendanceController;
use App\Http\Controllers\Management\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Base Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
//Class
    Route::get('/Management/Class', [ClassController::class, 'Index'])->name('Class');
    Route::get('/Management/Class/GetCollegeInformation/{id}', [ClassController::class, 'GetCollegeInformation']);
    Route::post('/Management/Class/Add', [ClassController::class, 'AddClass'])->name('AddClass');
    Route::post('/Management/Class/Edit', [ClassController::class, 'EditClass'])->name('EditClass');
    Route::post('/Management/Class/Delete', [ClassController::class, 'DeleteClass'])->name('DeleteClass');
    Route::get('/Management/Class/GetInformation/{id}', [ClassController::class, 'GetInformation'])->name('GetClassInformation');
//Student
    Route::get('/Management/Student', [StudentController::class, 'Index'])->name('Student');
    Route::post('/Management/Student/Add', [StudentController::class, 'AddStudent'])->name('AddStudent');
    Route::post('/Management/Student/Edit', [StudentController::class, 'EditStudent'])->name('EditStudent');
    Route::post('/Management/Student/Delete', [StudentController::class, 'DeleteStudent'])->name('DeleteStudent');
    Route::get('/Management/Student/GetCollegeInformation/{id}', [StudentController::class, 'GetCollegeInformation'])->name('GetCollegeInformationStudent');
    Route::get('/Management/Student/GetFiledInformation/{id}', [StudentController::class, 'GetFieldInformation'])->name('GetFiledInformationStudent');
    Route::get('/Management/Student/GetInformation/{id}', [StudentController::class, 'GetInformation'])->name('GetStudentInformation');
    Route::post('/Management/Student/ImportExcelFile', [StudentController::class, 'ImportExcel'])->name('ImportStudentExcelFile');
//Teacher
    Route::get('/Management/Teacher', [TeacherController::class, 'Index'])->name('Teacher');
    Route::post('/Management/Teacher/Add', [TeacherController::class, 'AddTeacher'])->name('AddTeacher');
    Route::post('/Management/Teacher/Edit', [TeacherController::class, 'EditTeacher'])->name('EditTeacher');
    Route::post('/Management/Teacher/Delete', [TeacherController::class, 'DeleteTeacher'])->name('DeleteTeacher');
    Route::get('/Management/Teacher/GetInformation/{id}', [TeacherController::class, 'GetInformation'])->name('GetTeacherInformation');
//SemesterLessonToClass
    Route::get('/Management/SemesterLessonToClass', [SemesterLessonToClassController::class, 'Index'])->name('SemesterLessonToClass');
    Route::post('/Management/SemesterLessonToClass/Add', [SemesterLessonToClassController::class, 'Add'])->name('AddSemesterLessonToClass');
//Route::post('/Management/SemesterLessonToClass/Edit',[TeacherController::class,'EditTeacher'])->name('EditTeacher');
//Route::post('/Management/SemesterLessonToClass/Delete',[TeacherController::class,'DeleteTeacher'])->name('DeleteTeacher');
    Route::post('/Management/SemesterLessonToClass/GetInformation', [SemesterLessonToClassController::class, 'GetInformation'])->name('GetSemesterLessonToClassInformation');
//SemesterLesson
    Route::get('/Management/SemesterLesson', [SemesterLessonController::class, 'Index'])->name('SemesterLesson');
    Route::post('/Management/SemesterLesson/Add', [SemesterLessonController::class, 'AddSemesterLesson'])->name('AddSemesterLesson');
    Route::post('/Management/SemesterLesson/Edit', [SemesterLessonController::class, 'EditSemesterLesson'])->name('EditSemesterLesson');
    Route::post('/Management/SemesterLesson/Delete', [SemesterLessonController::class, 'DeleteSemesterLesson'])->name('DeleteSemesterLesson');
    Route::get('/Management/SemesterLesson/GetTeacher/{id}', [SemesterLessonController::class, 'GetTeacher'])->name('SemesterLessonGetTeacher');
    Route::get('/Management/SemesterLesson/GetCollegeInformation/{id}', [SemesterLessonController::class, 'GetCollegeInformation'])->name('GetCollegeInformationSemesterLesson');
    Route::get('/Management/SemesterLesson/GetFieldLesson/{id}', [SemesterLessonController::class, 'GetFieldSemesterLesson'])->name('GetFieldSemesterLesson');
    Route::get('/Management/SemesterLesson/GetInformation/{id}', [SemesterLessonController::class, 'GetInformation'])->name('GetInformationSemesterLesson');
//SemesterLessonStudent
    Route::get('/Management/SemesterLessonStudent', [SemesterLessonStudentController::class, 'Index'])->name('SemesterLessonStudent');
    Route::post('/Management/GetSemesterLessonStudent', [SemesterLessonStudentController::class, 'GetSemesterLessonStudent'])->name('GetSemesterLessonStudent');
    Route::post('/Management/SemesterLessonStudent/Add', [SemesterLessonStudentController::class, 'AddSemesterLessonStudent'])->name('AddSemesterLessonStudent');
    //Search
    Route::get('/Management/SemesterLessonStudent/Search/{id?}',[SemesterLessonStudentController::class,'SearchStudent'])->name('SearchStudent');

//TeacherAttendance
    Route::get('/Management/TeacherAttendance', [TeacherAttendanceController::class, 'Index'])->name('TeacherAttendance');
    Route::post('/Management/TeacherAttendance/GetSemesterLesson', [TeacherAttendanceController::class, 'GetSemesterLesson'])->name('TeacherAttendanceGetLesson');
    Route::post('/Management/TeacherAttendance/GetSemesterLessonHoldingDate', [TeacherAttendanceController::class, 'GetSemesterLessonHoldingDate'])->name('TeacherAttendanceGetHoldingDate');
    Route::post('/Management/TeacherAttendance/Store', [TeacherAttendanceController::class, 'Store'])->name('TeacherAttendanceStore');
// StudentAttendance
    Route::get('/Management/StudentAttendance', [StudentAttendance::class, 'Index'])->name('StudentAttendance');
    Route::post('/Management/StudentAttendance/GetSemesterLesson', [StudentAttendance::class, 'GetSemesterLesson'])->name('StudentAttendanceGetLesson');
    Route::post('/Management/StudentAttendance/GetSemesterLessonHoldingDate', [StudentAttendance::class, 'GetSemesterLessonHoldingDate'])->name('StudentAttendanceGetHoldingDate');

    Route::post('/Management/StudentAttendance/GetSemesterLessonStudent', [StudentAttendance::class, 'GetSemesterLessonStudent'])->name('GetSemesterLessonStudentAttendance');

    Route::post('/Management/StudentAttendance/AB', [StudentAttendance::class, 'AB'])->name('StudentAttendanceAB');
    Route::post('/Management/StudentAttendance/PR', [StudentAttendance::class, 'PR'])->name('StudentAttendancePR');
//SemesterLessonGrade
    Route::get('/Management/SemesterLessonGrade', [SemesterLessonGradeController::class, 'Index'])->name('SemesterLessonGrade');
    Route::post('/Management/SemesterLessonGrade/Add', [SemesterLessonGradeController::class, 'Add'])->name('AddSemesterLessonGrade');
    Route::post('/Management/SemesterLessonGrade/GetSemester', [SemesterLessonGradeController::class, 'GetSemester'])->name('SemesterLessonGetSemester');
    Route::post('/Management/SemesterLessonGrade/GetSemesterLesson', [SemesterLessonGradeController::class, 'GetSemesterLesson'])->name('SemesterLessonGetSemesterLesson');
    Route::post('/Management/SemesterLessonGrade/GetSemesterLessonGrade', [SemesterLessonGradeController::class, 'GetSemesterLessonGradeType'])->name('SemesterLessonGradeType');
    Route::post('/Management/SemesterLessonGrade/Delete', [SemesterLessonGradeController::class, 'Delete'])->name('DeleteSemesterLessonGrade');
//StudentGrade
    Route::get('/Management/StudentGrade', [StudentGradeController::class, 'Index'])->name('StudentGrade');
    Route::post('/Management/StudentGrade/GetSemesterLessonStudent', [StudentGradeController::class, 'GetSemesterLessonStudent'])->name('StudentGradeSemesterLessonStudent');
    Route::post('/Management/StudentGrade/Add', [StudentGradeController::class, 'Add'])->name('StudentGradeAdd');
});
