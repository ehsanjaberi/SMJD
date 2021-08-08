<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_SemesterLessons;
use App\Models\Base_Universities;
use App\Models\Main_Uni_Stu_Grade;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentGradeController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Management.StudentGrade')->with(['University'=>$University,'Sub'=>$Systems]);
    }

    public function Add(Request $request)
    {
        try {
            foreach ($request->StudentGrade as $studentGrade) {
                $GradeTypeId=explode('|',$studentGrade)[0];
                $Grade=explode('|',$studentGrade)[1];
                Main_Uni_Stu_Grade::where('UniversityStudentId',$request->StudentId)->where('SemesterLessonGradeId',$GradeTypeId)->delete();
                if ($Grade){
                    Main_Uni_Stu_Grade::create([
                        'ModifyUser'=>Auth::user()->id,
                        'UniversityStudentId'=>$request->StudentId,
                        'SemesterLessonGradeId'=>$GradeTypeId,
                        'Grade'=>$Grade
                    ]);
                }
            }
            return true;
        }catch (\Exception $e)
        {
            return false;
        }
    }

    public function GetSemesterLessonStudent(Request $request)
    {
        $SemesterLesson=Base_SemesterLessons::where('id',$request->LessonId)->first();
        foreach ($SemesterLesson->SemesterLessonStudent as $item) {
            $item->Student->Person;
            $item->Student->Grades;
        }
        foreach ($SemesterLesson->GradeTypes as $gradeType) {
            $gradeType->GradeType;
        };

        return $SemesterLesson;

    }
}
