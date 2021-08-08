<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Colleges;
use App\Models\Base_GradeTypes;
use App\Models\Base_Semester;
use App\Models\Base_SemesterLessons;
use App\Models\Base_Universities;
use App\Models\Main_SemesterLessonGrades;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterLessonGradeController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $University=Base_Universities::where('IsDeleted',0)->get();
        $GradeType=Base_GradeTypes::where('IsDeleted',0)->get();
        return view('Management.SemesterLessonGrade')->with(['University'=>$University,'GradeType'=>$GradeType,'Sub'=>$Systems]);
    }

    public function Add(Request $request)
    {
        try {
            Main_SemesterLessonGrades::updateOrCreate(
                ['SemesterLessonId' => $request->LessonList, 'GradeTypeId' => $request->GradeType],
                ['MaxGrade' => $request->MaxGrade, 'ModifyUser'=>Auth::user()->id]
            );
            $Grade=Main_SemesterLessonGrades::where('IsDeleted',0)->where('SemesterLessonId',$request->LessonList)->get();
            foreach ($Grade as $gradetype) {$gradetype->GradeType;}
            return response()->json($Grade);
        }catch (\Exception $e)
        {
            return $e;
        }
    }

    public function Delete(Request $request)
    {
        Main_SemesterLessonGrades::findOrFail($request->id)->delete();
        $Grade=Main_SemesterLessonGrades::where('IsDeleted',0)->where('SemesterLessonId',$request->SemesterLessonId)->get();
            foreach ($Grade as $gradetype) {$gradetype->GradeType;}
            return response()->json($Grade);
    }

    public function GetSemester(Request $request)
    {
        return response()->json(Base_Semester::where('UniversityId',$request->UniversityId)->where('IsDeleted',0)->get());
    }
    public function GetSemesterLesson(Request $request)
    {
        $SemesterLesson=Base_SemesterLessons::where('IsDeleted',0)->where('SemesterId',$request->SemesterId)->get();
        foreach ($SemesterLesson as $item) {
            $item->Lesson;
        }
        return response()->json($SemesterLesson);
    }
    public function GetSemesterLessonGradeType(Request $request)
    {
        $Grade=Main_SemesterLessonGrades::where('IsDeleted',0)->where('SemesterLessonId',$request->LessonId)->get();
        foreach ($Grade as $gradetype)
        {
            $gradetype->GradeType;
        }
        return response()->json($Grade);
    }
}
