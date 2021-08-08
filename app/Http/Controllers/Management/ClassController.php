<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Classes;
use App\Models\Base_Colleges;
use App\Models\Base_Universities;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Class=Base_Classes::where('IsDeleted',0)->paginate(20);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Management.Class')->with(['Class'=>$Class,'University'=>$University,'Sub'=>$Systems]);
    }
    public function AddClass(Request $request)
    {
        try {
            Base_Classes::create([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
                'CollegeId'=>$request->CollegeId,
                'ClassType'=>$request->ClassType,
                'ClassStatus'=>$request->ClassStatus,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditClass(Request $request)
    {
        try {
            Base_Classes::where('id',$request->id)->update([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->name,
                'CollegeId'=>$request->CollegeId,
                'ClassType'=>$request->ClassType,
                'ClassStatus'=>$request->ClassStatus,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function DeleteClass(Request $request)
    {
        try {
            Base_Classes::where('id',$request->id)->update([
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
        $Class=Base_Classes::find($id);
        $Class->College->University;
        return response()->json($Class);
    }
    public function GetCollegeInformation($id)
    {
        return response()->json(Base_Colleges::find($id));
    }
}
