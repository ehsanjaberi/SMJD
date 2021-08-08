<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Colleges;
use App\Models\Base_Degree;
use App\Models\Base_Fields;
use App\Models\Base_Lessons;
use App\Models\Base_Universities;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Lesson=Base_Lessons::where('IsDeleted',0)->paginate(20);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        $Degree=Base_Degree::where('IsDeleted',0)->get();

        return view('Base.Lesson')->with(['Lesson'=>$Lesson,'University'=>$University,'Degree'=>$Degree,'Sub'=>$Systems]);
    }

    public function AddLesson(Request $request)
    {
        try {
            Base_Lessons::create([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
                'PracticalUnits'=>$request->PUnit,
                'TheoricalUnits'=>$request->TUnit,
                'FieldId'=>$request->FieldId,
                'DegreeId'=>$request->DegreeId,

            ]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            return $e;
        }
    }
    public function EditLesson(Request $request)
    {
        try {
            Base_Lessons::where('id',$request->OldCode)->update([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
                'PracticalUnits'=>$request->PUnit,
                'TheoricalUnits'=>$request->TUnit,
                'FieldId'=>$request->FieldId,
                'DegreeId'=>$request->DegreeId,

            ]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            return $e;
        }
    }
    public function DeleteLesson(Request $request)
    {
        try {
            Base_Lessons::where('id',$request->Code)->update([
                'IsDeleted'=>1,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e) {
            return $e;
        }
    }
//
    public function GetCollegeInformation($id)
    {
        $Colleges=Base_Colleges::where('UniversityId',$id)->where('IsDeleted',0)->get();
        return response()->json($Colleges);
    }
    public function GetFieldInformation($id)
    {
        $Fields=Base_Fields::where('CollegeId',$id)->where('IsDeleted',0)->get();
        return response()->json($Fields);
    }
    public function GetInformation($id)
    {
        $Lesson=Base_Lessons::where('id',$id)->first();
        $Lesson->Field->College->University;
        return response()->json($Lesson);
    }
}
