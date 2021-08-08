<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Colleges;
use App\Models\Base_Fields;
use App\Models\Base_Lessons;
use App\Models\Base_Semester;
use App\Models\Base_SemesterLessons;
use App\Models\Base_SemesterLessonTeachers;
use App\Models\Base_Universities;
use App\Models\Base_UniversityTeacher;
use App\Models\Uni_SubSystems;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class SemesterLessonController extends Controller
{
    protected $auth=1;
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $SemesterLesson=Base_SemesterLessons::where('IsDeleted',0)->paginate(15);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Management.SemesterLesson')->with(['SemesterLesson'=>$SemesterLesson,'University'=>$University,'Sub'=>$Systems]);
    }

    public function AddSemesterLesson(Request $request)
    {
        try {
            $SemesterLesson=Base_SemesterLessons::create([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'LessonId'=>$request->LessonId,
                'SemesterId'=>$request->SemesterId,
            ]);
            foreach ($request->Per as $teacher)
            {
                Base_SemesterLessonTeachers::create([
                    'ModifyUser'=>Auth::user()->id,
                    'SemesterLessonId'=>$SemesterLesson->id,
                    'TeacherId'=>$teacher,
                ]);
            }
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditSemesterLesson(Request $request){
        try {
            Base_SemesterLessons::where('id',$request->id)->update([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'LessonId'=>$request->LessonId,
                'SemesterId'=>$request->SemesterId,
            ]);
            Base_SemesterLessonTeachers::where('SemesterLessonId',$request->id)->delete();
            foreach ($request->Per as $teacher)
            {
                Base_SemesterLessonTeachers::create([
                    'ModifyUser'=>Auth::user()->id,
                    'SemesterLessonId'=>$request->id,
                    'TeacherId'=>$teacher,
                ]);
            }
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function DeleteSemesterLesson(Request $request)
    {
        try {
            Base_SemesterLessons::where('id',$request->id)->update([
                'IsDeleted' => 1
            ]);
            Base_SemesterLessonTeachers::where('SemesterLessonId',$request->id)->update([
                'IsDeleted' => 1
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function GetCollegeInformation($id)
    {
        $Colleges=Base_Colleges::where('UniversityId',$id)->where('IsDeleted',0)->get();
        $Teacher=Base_UniversityTeacher::where('IsDeleted',0)->where('UniversityId',$id)->get();
        $Semester=Base_Semester::where('IsDeleted',0)->where('UniversityId',$id)->get();
        $Array=array();
        foreach ($Teacher as $teacher)
        {
            $Temp=array(
                "id"=>$teacher->id,
                "title"=>$teacher->Person->Name.' '.$teacher->Person->Family.'('.$teacher->Person->NationalCode.')',
            );
            array_push($Array,$Temp);
        }
        return response()->json(['College'=>$Colleges,'Teacher'=>$Array,'Semester'=>$Semester]);
    }
    public function GetTeacher($id)
    {
        $Teacher=Base_UniversityTeacher::where('IsDeleted',0)->where('UniversityId',$id)->get();
        return response()->json($Teacher);
    }
    public function GetFieldSemesterLesson($id)
    {
        $Lesson=Base_Lessons::where('IsDeleted',0)->where('FieldId',$id)->get();
        return response()->json($Lesson);
    }

    public function GetInformation($id)
    {
        $SemesterLesson=Base_SemesterLessons::find($id);
        $SemesterLesson->Lesson->Field->College->University;
        $SemesterLesson->Teachers;
        $Array=array();
        foreach ($SemesterLesson->Teachers as $teacher)
        {
            array_push($Array,$teacher->TeacherId);
        }
        return response()->json(['SemesterLesson'=>$SemesterLesson,'Selected'=>$Array]);
    }
}
