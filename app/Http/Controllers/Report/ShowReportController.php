<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Report_Report;
use App\Models\Uni_SubSystems;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowReportController extends Controller
{
    public function Index($id)
    {
        $Systems=Uni_SubSystems::all();
        $Report=Report_Report::find($id);
        foreach ($Report->Parameters as $parameter) {
            if ($parameter->Type==7) {
                $query=DB::select($parameter->Query);
                $parameter->Query=$query;
            }
        }
        return view('Report.ShowReport')->with(['Report'=>$Report,'Sub'=>$Systems]);
    }

    public function ReportResult(Request $request)
    {
        try {
            //فراخوانی اطلاعات گزارش خاص
            $Report=Report_Report::find($request->ReportId);
            $Query=$Report->Query;
            //جایگزاری پرامتر ها در کوئری با مقادیر دریافتی تز کاربر
            foreach (json_decode($request->Param,true) as $item) {
                $Query=str_replace($item['Name'],$item['Value'],$Query);
            }
            $arr=array();
            //افزودن ستون های انتخابی گزارش به آرایه
            if ($request->Columns){
                foreach ($Report->Columns as $column) {
                    foreach ($request->Columns  as $item) {
                        if ($column->id==$item)
                        {
                            array_push($arr,$column);
                        }
                    }
                }
            }
            //اجرای کوئری
            $db=DB::select($Query);
            return response()->json(['Status'=>'True','Rows'=>$db,'Head'=>$arr]);
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }

    }
}
