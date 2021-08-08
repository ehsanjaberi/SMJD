<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Imports\StudentImportArray;
use App\Models\Base_Colleges;
use App\Models\Base_Degree;
use App\Models\Base_Fields;
use App\Models\Base_Persons;
use App\Models\Base_Universities;
use App\Models\Base_UniversityStudents;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\ExcelServiceProvider;
use Maatwebsite\Excel\Facades\Excel;
use function PHPUnit\Framework\returnArgument;

class StudentController extends Controller
{
    protected $auth=1;
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Student=Base_UniversityStudents::where('IsDeleted',0)->paginate(15);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        $Degree=Base_Degree::where('IsDeleted',0)->get();
        return view('Management.Student')->with(['Student'=>$Student,'University'=>$University,'Degree'=>$Degree,'Sub'=>$Systems]);
    }
    public function AddStudent(Request $request)
    {
        try {
            $Person=Base_Persons::create([
                'ModifyUser'=>Auth::user()->id,
                'Name'=>$request->Name,
                'Family'=>$request->Family,
                'NationalCode'=>$request->NationalCode,
                'Gender'=>$request->Sex,
            ]);
            Base_UniversityStudents::create([
               'ModifyUser'=>Auth::user()->id,
               'PersonId'=>$Person->id,
               'PersonalCode'=>$request->PersonalId,
               'CollegeId'=>$request->CollegeId,
               'FieldId'=>$request->FieldId,
               'DegreeId'=>$request->DegreeId,
               'StartDate'=>$request->StartDate,
               'EndDate'=>$request->EndDate,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditStudent(Request $request)
    {
        try {
            $Person=Base_UniversityStudents::find($request->id)->Person;
            $Person->ModifyUser=Auth::user()->id;
            $Person->Name=$request->Name;
            $Person->Family=$request->Family;
            $Person->NationalCode=$request->NationalCode;
            $Person->Gender=$request->Sex;
            $Person->Save();
            $Student=Base_UniversityStudents::find($request->id);
             $Student->ModifyUser=Auth::user()->id;
             $Student->PersonalCode=$request->PersonalId;
             $Student->CollegeId=$request->CollegeId;
             $Student->FieldId=$request->FieldId;
             $Student->DegreeId=$request->DegreeId;
             $Student->StartDate=$request->StartDate;
             $Student->EndDate=$request->EndDate;
             $Student->save();
             return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteStudent(Request $request)
    {

        try {
            $Student=Base_UniversityStudents::find($request->DeleteId);
            $Student->ModifyUser=Auth::user()->id;
            $Student->IsDeleted=1;
            $Student->save();
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
        return response()->json($Colleges);
    }
    public function GetFieldInformation($id)
    {
        $Fields=Base_Fields::where('CollegeId',$id)->where('IsDeleted',0)->get();
        return response()->json($Fields);
    }
    public function GetInformation($id)
    {
        $Student=Base_UniversityStudents::find($id);
        $Student->Person;
        $Student->College;
        return response()->json($Student);
    }

    public function ImportExcel(Request $request)
    {
        $data=Excel::toArray(new StudentImportArray(),$request->file('ExcelFile'));
        $arr=[];
        foreach ($data[0] as $row) {
            if ($row['universitycode']!=null){
                $Person=Base_Persons::create([
                    'ModifyUser'=>Auth::user()->id,
                    'Name'=>$row['firstname'],
                    'Family'=>$row['family'],
                    'NationalCode'=>$row['nationalcode'],
                    'Gender'=>$row['gender'],
                ]);
                Base_UniversityStudents::create([
                    'ModifyUser'=>Auth::user()->id,
                    'PersonId'=>$Person->id,
                    'PersonalCode'=>$row['personalcode'],
                    'CollegeId'=>Base_Colleges::where('Code',$row['collegecode'])->first()->id,
                    'FieldId'=>Base_Fields::where('Code',$row['fieldcode'])->first()->id,
                    'DegreeId'=>Base_Degree::where('Code',$row['degreecode'])->first()->id,
                    'StartDate'=>$row['startdate'],
                    'EndDate'=>$row['enddae'],
                ]);
            }
        }
        return redirect()->back();
    }
}
