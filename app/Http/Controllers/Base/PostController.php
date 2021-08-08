<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Universities;
use App\Models\Base_UniversityPosts;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Post=Base_UniversityPosts::where('IsDeleted',0)->paginate(15);
        Paginator::useBootstrap();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Base.Post')->with(['Post'=>$Post,'University'=>$University,'Sub'=>$Systems]);
    }

    public function AddPost(Request $request)
    {
        try {
            Base_UniversityPosts::create([
                'ModifyUser'=>Auth::user()->id,
                'UniversityId'=>$request->UniversityId,
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
    public function EditPost(Request $request)
    {
        try {
            Base_UniversityPosts::where('id',$request->Id)->update([
                'ModifyUser'=>Auth::user()->id,
                'UniversityId'=>$request->UniversityId,
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
    public function DeletePost(Request $request)
    {
        try {
            Base_UniversityPosts::where('id',$request->Code)->update([
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
