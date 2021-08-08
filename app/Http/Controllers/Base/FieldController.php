<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Colleges;
use App\Models\Base_Fields;
use App\Models\Base_Universities;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Fields=Base_Fields::where('IsDeleted',0)->paginate(20);
        Paginator::useBootstrap();
        // Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Base.Field')->with(['Fields'=>$Fields,'University'=>$University,'Sub'=>$Systems]);
    }
    public function AddFiled(Request $request)
    {
        try {
            Base_Fields::create([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
                'CollegeId'=>$request->CollegeId,
                'IsDaily'=>$request->IsDaily,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditField(Request $request)
    {
        try {
            Base_Fields::where('id',$request->OldId)
                ->update([
                    'ModifyUser'=>Auth::user()->id,
                    'Code'=>$request->Code,
                    'Name'=>$request->Name,
                    'CollegeId'=>$request->CollegeId,
                    'IsDaily'=>$request->IsDaily,
                ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function DeleteFiled(Request $request)
    {
        try {
            Base_Fields::where('id',$request->Code)
                ->update([
                    'IsDeleted'=>1,
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
        return response()->json($Colleges);
    }

    public function GetInformation($id)
    {
        $Field=Base_Fields::where('id',$id)->first();
        $Field->College->University;
        return response()->json($Field);
    }
}
