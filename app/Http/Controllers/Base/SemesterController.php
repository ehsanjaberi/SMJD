<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Semester;
use App\Models\Base_Universities;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class SemesterController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Semester=Base_Semester::where('IsDeleted',0)->paginate(20);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Base.Semester')->with(['Semester'=>$Semester,'University'=>$University,'Sub'=>$Systems]);
    }

    public function AddSemester(Request $request)
    {

        (!$request->IsDefault) ? $IsDefault=0 : $IsDefault=1;
        try {
            Base_Semester::create([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
                'UniversityId'=>$request->UniversityId,
                'SessionDuration'=>$request->SessionDur,
                'StartDate'=>$request->StartDate,
                'EndDate'=>$request->EndDate,
                'IsDefault'=>$IsDefault
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditSemester(Request $request)
    {
        (!$request->IsDefault) ? $IsDefault=0 : $IsDefault=1;
        try {
            Base_Semester::where('id',$request->id)->update([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
                'UniversityId'=>$request->UniversityId,
                'SessionDuration'=>$request->SessionDur,
                'StartDate'=>$request->StartDate,
                'EndDate'=>$request->EndDate,
                'IsDefault'=>$IsDefault
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteSemester(Request $request)
    {
        try {
            Base_Semester::where('id',$request->Code)->update([
                'IsDeleted'=>1,
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
        return response()->json(Base_Semester::find($id));
    }
}
