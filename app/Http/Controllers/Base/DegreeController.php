<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Degree;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class DegreeController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Degree=Base_Degree::where('IsDeleted',0)->paginate(10);
        Paginator::useBootstrap();
        return view('Base.Degree')->with(['Degree'=>$Degree,'Sub'=>$Systems]);
    }

    public function AddDegree(Request $request)
    {
        try {
            Base_Degree::create([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function EditDegree(Request $request)
    {
        try {
            Base_Degree::where('id',$request->OldCode)->update([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Code,
                'Name'=>$request->Name,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteDegree(Request $request)
    {
        try {
            Base_Degree::where('id',$request->Code)->update([
                'IsDeleted'=>1,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
}
