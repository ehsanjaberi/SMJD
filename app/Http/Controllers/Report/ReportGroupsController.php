<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Report_ReportGroups;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportGroupsController extends Controller
{
    public function Index()
    {
        //فراخوانی منو های قابل نمایش در برنامه
        $Systems=Uni_SubSystems::all();
        //فراخوانی گروه های تعریف شده برای گزارشات
        $ReportGroups=Report_ReportGroups::where('IsDeleted',0)->get();
        return view('Report.ReportGroups')->with(['ReportGroups'=>$ReportGroups,'Sub'=>$Systems]);
    }

    public function Add(Request $request)
    {
        //افزودن گروه گزارشات در پایگاه داده
        Report_ReportGroups::create([
            'ModifyUser'=>Auth::user()->id,
            'Title'=>$request->Title,
            'Name'=>$request->Name,
            'Icon'=>$request->Icon,
        ]);
        return redirect()->back();
    }

    public function Edit(Request $request)
    {
        //ویرایش گزارش پایگاه داده
        Report_ReportGroups::where('id',$request->id)->update([
            'ModifyUser'=>Auth::user()->id,
            'Title'=>$request->Title,
            'Name'=>$request->Name,
            'Icon'=>$request->Icon,
        ]);
        return redirect()->back();
    }
    public function Delete(Request $request)
    {
        //حذف گزارش
        Report_ReportGroups::where('id',$request->id)->delete();
        return redirect()->back();
    }
    public function GetInformation($id)
    {
        //گرفتن اطلاعات یک گزارش خاص برای ویرایش کردن
        return response()->json(Report_ReportGroups::find($id));
    }
}
