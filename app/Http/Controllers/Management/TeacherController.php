<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Degree;
use App\Models\Base_Persons;
use App\Models\Base_Universities;
use App\Models\Base_UniversityTeacher;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Teacher=Base_UniversityTeacher::where('IsDeleted',0)->paginate(15);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        $Degree=Base_Degree::where('IsDeleted',0)->get();
        return view('Management.Teacher')->with(['Teacher'=>$Teacher,'University'=>$University,'Degree'=>$Degree,'Sub'=>$Systems]);
    }

    public function AddTeacher(Request $request)
    {
        try {
            $Person=Base_Persons::create([
                'ModifyUser'=>Auth::user()->id,
                'Name'=>$request->Name,
                'Family'=>$request->Family,
                'NationalCode'=>$request->NationalCode,
                'Gender'=>$request->Sex,
            ]);
            Base_UniversityTeacher::create([
                'ModifyUser'=>Auth::user()->id,
                'PersonId'=>$Person->id,
                'PersonalCode'=>$request->PersonalCode,
                'UniversityId'=>$request->UniversityId,
                'DegreeId'=>$request->DegreeId,
                'Field'=>$request->Field,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function EditTeacher(Request $request)
    {
        try {
            $Person=Base_UniversityTeacher::find($request->id)->Person;
            $Person->ModifyUser=Auth::user()->id;
            $Person->Name=$request->Name;
            $Person->Family=$request->Family;
            $Person->NationalCode=$request->NationalCode;
            $Person->Gender=$request->Sex;
            $Person->Save();
            $Teacher=Base_UniversityTeacher::find($request->id);
            $Teacher->ModifyUser=Auth::user()->id;
            $Teacher->PersonalCode=$request->PersonalCode;
            $Teacher->UniversityId=$request->UniversityId;
            $Teacher->DegreeId=$request->DegreeId;
            $Teacher->Field=$request->Field;
            $Teacher->save();
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteTeacher(Request $request)
    {
        try {
            Base_UniversityTeacher::where('id',$request->id)->update([
                'IsDeleted'=> 1,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function GetInformation($id)
    {
        $Teacher=Base_UniversityTeacher::where('id',$id)->where('IsDeleted',0)->first();
        $Teacher->Person;
        return response()->json($Teacher);
    }
}
