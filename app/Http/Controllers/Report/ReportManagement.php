<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Base_Classes;
use App\Models\Report_Report;
use App\Models\Report_ReportColumns;
use App\Models\Report_ReportGroups;
use App\Models\Report_ReportParameter;
use App\Models\Report_StaticItems;
use App\Models\Uni_SubSystems;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReportManagement extends Controller
{
    public function Index()
    {
        //فراخوانی منو های قابل نمایش در برنامه
        $Systems=Uni_SubSystems::all();
        //فراخوانی گروه های تعریف شده برای گزارشات
        $Reports=Report_Report::where('IsDeleted',0)->get();
//        return $tables->getTable();
        return view('Report.ReportManagement')->with(['Reports'=>$Reports,'Sub'=>$Systems]);
    }
    //نمایش صفحه افزودن گزارش
    public function AddReport()
    {
        $Systems=Uni_SubSystems::all();
        //فراخوانی نام جداول از پایگاه داده
        $tables = DB::select('SHOW TABLES');
        $ReportGroups=Report_ReportGroups::where('IsDeleted',0)->get();
        $Report=null;
        return view('Report.AddEditReport')->with(['ReportGroups'=>$ReportGroups,'tables'=>$tables,'Report'=>$Report,'Sub'=>$Systems]);
    }
    //نمایش صفحه ویرایش گزارش
    public function EditReport($id)
    {
        $Systems=Uni_SubSystems::all();
        $tables = DB::select('SHOW TABLES');
        $ReportGroups=Report_ReportGroups::where('IsDeleted',0)->get();
        $Report=Report_Report::find($id);
        return view('Report.AddEditReport')->with(['ReportGroups'=>$ReportGroups,'tables'=>$tables,'Report'=>$Report,'Sub'=>$Systems]);
    }
    public function StoreReport(Request $request)
    {
         return DB::table($request->Tbl1)->get();
    }

    public function GetColumn($name)
    {
        //فراخوانی و نمایش نام ستون های جدول انتخاب شده
        $columns = DB::select('show columns from ' . $name);
        return $columns;
    }
    public function RunQuery(Request $request)
    {
        try{
            if ($request->AddOrEdit=='Add'){
                //افزودن گزارش جدید
                $Report=Report_Report::create([
                    'ModifyUser'=>Auth::user()->id,
                    'ReportGroupId'=>$request->GroupId,
                    'Title'=>$request->Title,
                    'Query'=>$request->Query,
                    'HasPager'=>$request->HasPager,
                ]);
                foreach ($request->Columns as $column)
                {
                    //افزودن ستون های گزارش که توسط کاربر تعریف شده اند
                    Report_ReportColumns::create([
                        'ModifyUser'=>Auth::user()->id,
                        'ReportId'=>$Report->id,
                        'Title'=>$column['ColumnName'],
                        'IsSeparator'=>$column['Separator'],
                        'IsSum'=>$column['Sum'],
                        'IsAverage'=>$column['Avg'],
                    ]);
                }
                foreach ($request->Params as $param)
                {
                    //افزودن پارامتر های گزارش که توسط کاربر تعریف شده اند
                    //اگر پارامتر از نوع لیست انتخابی استاتیک باشد به داخل شرط هداست می شود.
                    if ($param['Type']==6){
                        $Params=Report_ReportParameter::create([
                            'ModifyUser'=>Auth::user()->id,
                            'ReportId'=>$Report->id,
                            'Title'=>$param['Title'],
                            'Name'=>$param['Name'],
                            'Priority'=>$param['Priority'],
                            'Type'=>$param['Type'],
                            'IsOptional'=>$param['IsOptional'],
                            'Width'=>$param['Width'],
                        ]);
                        $StaticItems=json_decode($param["Query"], true);
                        if ($StaticItems)
                        {
                            //اگر هر پارامتر آیتم های استاتیک داشته یاشند.در جدول'Report_StaticItems' ذخیره می شود.
                            foreach ($StaticItems as $staticItem) {
                                Report_StaticItems::create([
                                    'ModifyUser'=>Auth::user()->id,
                                    'ReportParameterId'=>$Params->id,
                                    'key'=>$staticItem['key'],
                                    'value'=>$staticItem['value'],
                                ]);
                            }
                        }
                    }
                    else{
                        Report_ReportParameter::create([
                            'ModifyUser'=>Auth::user()->id,
                            'ReportId'=>$Report->id,
                            'Title'=>$param['Title'],
                            'Name'=>$param['Name'],
                            'Priority'=>$param['Priority'],
                            'Query'=>$param['Query'],
                            'Type'=>$param['Type'],
                            'IsOptional'=>$param['IsOptional'],
                            'Width'=>$param['Width'],
                        ]);
                    }
                }
            }
            else{
                //ویرایش گزارش بر اساس شناسه آن
                $Report=Report_Report::where('id',$request->ReportId)->update([
                    'ModifyUser'=>Auth::user()->id,
                    'ReportGroupId'=>$request->GroupId,
                    'Title'=>$request->Title,
                    'Query'=>$request->Query,
                    'HasPager'=>$request->HasPager,
                ]);
                //حذف تمامی ستون های گزازش
                Report_ReportColumns::where('ReportId',$request->ReportId)->delete();
                //دریافت تمامی پارامتر های گزارش
                $Param=Report_ReportParameter::where('ReportId',$request->ReportId)->get();
                if ($Param)
                {
                    //اگر پارامتر مقدار استاتیک داشته باشد آن ها را حذف سپس پارامتر را حذف می کنیم
                    foreach ($Param as $item) {
                        foreach ($item->StaticItems as $items) {
                            $items->delete();
                        }
                        $item->delete();
                    }
                }
                foreach ($request->Columns as $column){
//افزودن ستون های جدید گزارش
                    Report_ReportColumns::create([
                        'ModifyUser'=>Auth::user()->id,
                        'ReportId'=>$request->ReportId,
                        'Title'=>$column['ColumnName'],
                        'IsSeparator'=>$column['Separator'],
                        'IsSum'=>$column['Sum'],
                        'IsAverage'=>$column['Avg'],
                    ]);
                }
                foreach ($request->Params as $param){
                    //افزودن پارامتر های جدید گزارش
                    if ($param['Type']==6){
                        $Params=Report_ReportParameter::create([
                            'ModifyUser'=>Auth::user()->id,
                            'ReportId'=>$request->ReportId,
                            'Title'=>$param['Title'],
                            'Name'=>$param['Name'],
                            'Priority'=>$param['Priority'],
                            'Type'=>$param['Type'],
                            'IsOptional'=>$param['IsOptional'],
                            'Width'=>$param['Width'],
                        ]);
                        $StaticItems=json_decode($param["Query"], true);
                        if ($StaticItems){
                            foreach ($StaticItems as $staticItem) {
                                Report_StaticItems::create([
                                    'ModifyUser'=>Auth::user()->id,
                                    'ReportParameterId'=>$Params->id,
                                    'key'=>$staticItem['key'],
                                    'value'=>$staticItem['value'],
                                ]);
                            }
                        }
                    }
                    else{
                        Report_ReportParameter::create([
                            'ModifyUser'=>Auth::user()->id,
                            'ReportId'=>$request->ReportId,
                            'Title'=>$param['Title'],
                            'Name'=>$param['Name'],
                            'Priority'=>$param['Priority'],
                            'Query'=>$param['Query'],
                            'Type'=>$param['Type'],
                            'IsOptional'=>$param['IsOptional'],
                            'Width'=>$param['Width'],
                        ]);
                    }
                }
            }
            return 'True';
        }catch(\Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function DeleteReport(Request $request)
    {
//حذف گزارش با همه ستون ها ، پارامترها و آیتم های استاتیک
        Report_Report::where('id',$request->id)->delete();
        Report_ReportColumns::where('ReportId',$request->ReportId)->delete();
        $Param=Report_ReportParameter::where('ReportId',$request->id)->get();
        if ($Param)
        {
            foreach ($Param as $item) {
                foreach ($item->StaticItems as $items) {
                    $items->delete();
                }
                $item->delete();
            }
        }
     return redirect()->back();
    }
}
