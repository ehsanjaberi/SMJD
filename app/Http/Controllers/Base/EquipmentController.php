<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Equipments;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Equipment=Base_Equipments::where('IsDeleted',0)->paginate(15);
        Paginator::useBootstrap();
        return view('Base.Equipment')->with(['Equipment'=>$Equipment,'Sub'=>$Systems]);
    }

    public function Add(Request $request)
    {
        try {
            $Equipment=new Base_Equipments();
            $Equipment->ModifyUser=Auth::user()->id;
            $Equipment->Code=$request->Code;
            $Equipment->Name=$request->Name;
            $Equipment->Description=$request->Desc;
            $Equipment->save();
            return redirect()->back();
        }catch (\Exception $e){
            return false;
        }
    }
    public function Edit(Request $request)
    {
        try {
            $Equipment=Base_Equipments::find($request->id);
            $Equipment->ModifyUser=Auth::user()->id;
            $Equipment->Code=$request->Code;
            $Equipment->Name=$request->Name;
            $Equipment->Description=$request->Desc;
            $Equipment->save();
            return redirect()->back();
        }catch (\Exception $e){
            return false;
        }
    }
    public function Delete(Request $request)
    {
        try {
            $Equipment=Base_Equipments::find($request->id);
            $Equipment->ModifyUser=Auth::user()->id;
            $Equipment->IsDeleted=1;
            $Equipment->save();
            return redirect()->back();
        }catch (\Exception $e){
            return false;
        }
    }
    public function GetInf($id)
    {
        return response()->json(Base_Equipments::find($id));
    }

}
