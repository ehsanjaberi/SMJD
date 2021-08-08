<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Degree;
use App\Models\Base_EmployeePost;
use App\Models\Base_Persons;
use App\Models\Base_Universities;
use App\Models\Base_UniversityEmployees;
use App\Models\Base_UniversityPosts;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Employee=Base_UniversityEmployees::where('IsDeleted',0)->paginate(20);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        $Degree=Base_Degree::where('IsDeleted',0)->get();
        $UniversityPost=Base_UniversityPosts::where('IsDeleted',0)->get();
         return view('Base.Employee')->with(['Employee'=>$Employee,'University'=>$University,'Degree'=>$Degree,'UniversityPost'=>$UniversityPost,'Sub'=>$Systems]);
    }
    public function AddEmployee(Request $request)
    {
        try {
            $Person=Base_Persons::create([
                'ModifyUser'=>Auth::user()->id,
                'Name'=>$request->Name,
                'Family'=>$request->Family,
                'NationalCode'=>$request->NationalCode,
                'Gender'=>$request->Gender,
                'Image'=>'defualt'
            ]);
            $Employee=Base_UniversityEmployees::create([
                'ModifyUser'=>Auth::user()->id,
                'PersonId'=>$Person->id,
                'PersonalCode'=>$request->PersonalCode,
                'UniversityId'=>$request->UniversityId,
                'DegreeId'=>$request->DegreeId,
                'Field'=>$request->Field
            ]);
//            $Post=Base_UniversityPosts::where('id',$request->UniversityPost)->first('id');
            Base_EmployeePost::create([
                'ModifyUser'=>Auth::user()->id,
                'UniversityPostId'=>$request->UniversityPost,
                'UniversityEmployeeId'=>$Employee->id,

            ]);
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function EditEmployee(Request $request)
    {
        try {
            $Person=Base_UniversityEmployees::find($request->EmployeeId)->Person;
            $Person->Name=$request->Name;
            $Person->Family=$request->Family;
            $Person->NationalCode=$request->NationalCode;
            $Person->Gender=$request->Gender;
            $Person->save();
            $Employee=Base_UniversityEmployees::find($request->EmployeeId);
            $Employee->PersonalCode=$request->PersonalCode;
            $Employee->UniversityId=$request->UniversityId;
            $Employee->DegreeId=$request->DegreeId;
            $Employee->Field=$request->Field;
            $Employee->save();
            $Post=Base_UniversityEmployees::find($request->EmployeeId)->Post;
            $Post->UniversityPostId=$request->UniversityPost;
            $Post->save();
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function DeleteEmployee(Request $request)
    {
        try {
            $Employee=Base_UniversityEmployees::find($request->Code);
            $Employee->IsDeleted=1;
            $Employee->save();
            $Post=Base_UniversityEmployees::find($request->Code)->Post;
            $Post->IsDeleted=1;
            $Post->save();
            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function GetInformation($id)
    {
        $Employee=Base_UniversityEmployees::find($id);
        $Employee->Person;
        $Employee->Post;
        return response()->json($Employee);
    }
    public function GetPostInformation($id)
    {
        $Posts = Base_Universities::where('id',$id)->first();
        return $Posts->UniversityPost->where('IsDeleted',0);
    }
}
