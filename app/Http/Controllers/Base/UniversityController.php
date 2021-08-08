<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Universities;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class UniversityController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $University=Base_Universities::where('IsDeleted',0)->paginate(10);
        Paginator::useBootstrap();
        return view('Base.University')->with(['University'=>$University,'Sub'=>$Systems]);
    }

    public function AddUniversity(Request $request)
    {
        Base_Universities::create([
            'ModifyUser'=>Auth::user()->id,
            'Code'=>$request->Uni_Code,
            'Name'=>$request->Uni_Name,
            'Address'=>$request->Uni_Address
        ]);
        return redirect()->back();
    }
    public function EditUniversity(Request $request)
    {
        Base_Universities::where('id',$request->Uni_Old_Code)
            ->update([
                'ModifyUser'=>Auth::user()->id,
                'Code'=>$request->Uni_Code,
                'Name'=>$request->Uni_Name,
                'Address'=>$request->Uni_Address
            ]);
        return redirect()->back();
    }
    public function DeleteUniversity(Request $request)
    {
        Base_Universities::where('id',$request->Uni_Code)
            ->update([
                'ModifyUser'=>Auth::user()->id,
                'IsDeleted'=> 1,
            ]);
        return redirect()->back();
    }
    public function GetInformation($id)
    {
        return response()->json(Base_Universities::where('id',$id)->first());
    }
}
