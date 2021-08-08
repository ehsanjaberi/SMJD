<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_GradeTypes;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class GradeTypeController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $GradeType=Base_GradeTypes::where('IsDeleted',0)->paginate(10);
        Paginator::useBootstrap();
        return view('Base.GradeType')->with(['GradeType'=>$GradeType,'Sub'=>$Systems]);
    }

    public function AddGradeType(Request $request)
    {
        try {
            Base_GradeTypes::create([
                'ModifyUser'=>Auth::user()->id,
                'Name'=>$request->Name,
                'ETitle'=>$request->Name,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function EditGradeType(Request $request)
    {
        try {
            Base_GradeTypes::where('id',$request->Code)->update([
                'ModifyUser'=>Auth::user()->id,
                'Name'=>$request->Name,
                'ETitle'=>$request->Name,
            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteGradeType(Request $request)
    {
        try {
            Base_GradeTypes::where('id',$request->Code)->update([
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
