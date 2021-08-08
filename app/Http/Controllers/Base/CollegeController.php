<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Colleges;
use App\Models\Base_Universities;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CollegeController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Colleges=Base_Colleges::where('IsDeleted',0)->paginate(20);
        Paginator::useBootstrap();
        $University=Base_Universities::all();
        return view('Base.College')->with(['Colleges'=>$Colleges,'University'=>$University,'Sub'=>$Systems]);
    }

    public function AddCollege(Request $request)
    {

        try {
            $College = new Base_Colleges();
            $College->ModifyUser=Auth::user()->id;
            $College->Code=$request->Code;
            $College->Name=$request->Name;
            $College->UniversityId=$request->UniversityId;
            $College->Email=$request->Email;
            $College->Website=$request->Website;
            $College->Address=$request->Address;
            $College->PostalCode=$request->PostalCode;
//            if ($request->hasFile('logo'))
//            {
//                $exception=$request->file('logo')->getClientOriginalExtension();
//                $filename=time().'.'.$exception;
//                $path=$request->file('logo')->storeAs('public/Colleges',$filename);
//                $College->logo=str_replace('public','',$path);
//            }
//            return $request;
            $College->save();
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditCollege(Request $request)
    {

        try {
            $College=Base_Colleges::where('id',$request->Old_Code)->first();
//            return $College;
            $College->ModifyUser=Auth::user()->id;
            $College->Code=$request->Code;
            $College->Name=$request->Name;
            $College->UniversityId=$request->UniversityId;
            $College->Email=$request->Email;
            $College->Website=$request->Website;
            $College->Address=$request->Address;
            $College->PostalCode=$request->PostalCode;
//            if ($request->hasFile('logo'))
//            {
//                if ($College->Logo)
//                {
//                    Storage::delete('public'.$College->Logo);
//                }
//                $exception=$request->file('logo')->getClientOriginalExtension();
//                $filename=time().'.'.$exception;
//                $path=$request->file('logo')->storeAs('public/Colleges',$filename);
//                $College->logo=str_replace('public','',$path);
//            }
            $College->save();
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteCollege(Request $request)
    {
        try {
            Base_Colleges::where('id',$request->Code)
                ->update([
                   'IsDeleted'=>1
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
        return response()->json(Base_Colleges::where('id',$id)->get());
    }
}
