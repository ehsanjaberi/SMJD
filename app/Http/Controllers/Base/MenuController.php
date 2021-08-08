<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Base_Menu;
use App\Models\Base_Menus;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $Menu=Base_Menu::where('IsDeleted',0)->paginate(10);
        Paginator::useBootstrap();
        return view('Base.Menu')->with(['Menu'=>$Menu,'Sub'=>$Systems]);
    }

    public function EditMenu(Request $request)
    {
        try {

            $Menu=Base_Menu::find($request->Arr[0]);
            $Menu->ModifyUser=Auth::user()->id;
            $Menu->Name=$request->Arr[1];
            $Menu->Title=$request->Arr[2];
            $Menu->icon=$request->Arr[3];
            $Menu->SubSystemId=$request->Arr[4];
            $Menu->Order=$request->Arr[5];
            $Menu->save();
            return true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
    public function IndexSubSystem()
    {
        $SubSystems=Uni_SubSystems::all();
        return view('Base.SubSystems')->with(['Sub'=>$SubSystems]);
    }

    public function EditSubSystem(Request $request)
    {
        try {

            $Menu=Uni_SubSystems::find($request->Id);
            $Menu->ModifyUser=Auth::user()->id;
            $Menu->Name=$request->Name;
            $Menu->Title=$request->Title;
            $Menu->Icon=$request->Icon;
            $Menu->Order=$request->Order;
            $Menu->save();
            return true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
}
