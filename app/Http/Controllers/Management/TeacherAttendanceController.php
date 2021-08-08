<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Classes;
use App\Models\Base_Colleges;
use App\Models\Base_Semester;
use App\Models\Base_Universities;
use App\Models\Main_Schedules;
use App\Models\Main_TeachersAttendance;
use App\Models\Uni_SubSystems;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;

class TeacherAttendanceController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Management.TeacherAttendance')->with(['University'=>$University,'Sub'=>$Systems]);
    }

    public function GetSemesterLesson(Request $request)
    {
        $Schedules=array();
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $num = range(0, 9);
        $request->date = str_replace($persian, $num,$request->date);
        $College=Base_Colleges::find($request->CollegeId);
        $Arr=array();
        $InputDate= str_replace('/','-',$request->date);
        foreach ($College->Classes as $class)
        {
            foreach ($class->Schedule as $schedule)
            {
                if ($schedule->SemesterLesson->SemesterId==$request->SemesterId)
                {
                    $Date=$this->GetSemesterLessonHoldingDate($schedule->id,$schedule->Week,$schedule->Day,$request->SemesterId);
                    foreach ($Date as $date)
                    {
                        if ($date==$InputDate){
                            array_push($Schedules,$schedule);
                        }
                    }
                }
            }
        }
        $Classes=Base_Classes::where('IsDeleted',0)->where('CollegeId',$request->CollegeId)->get();

        $Array=array();
        foreach ($Classes as $class)
        {
            $Temp=array(
                "ClassId"=>$class->id,
                "title"=>$class->Name,
                "schedule"=>[]
            );
            foreach ($Schedules as $schedule)
            {
                if ($class->id == $schedule->ClassId && $request->SemesterId == $schedule->SemesterLesson->SemesterId)
                {
//                    return [$schedule->id,$InputDate];
                    $Attendance=Main_TeachersAttendance::where('ScheduleId',$schedule->id)->where('HoldingDate',$InputDate)->first();
                    ($Attendance)?$Status=$Attendance->Status:$Status=0;
                    $ArrayChild=array(
                        "start"=>$schedule->StartTime,
                        "end"=>$schedule->EndTime,
                        "text"=>$schedule->SemesterLesson->Lesson->Name.'('.$schedule->Teacher->Person->Name.' '.$schedule->Teacher->Person->Family.')',
                        "data"=>[
                            "SemesterLessonId"=>$schedule->SemesterLessonId,
                            "ClassId"=>$schedule->ClassId,
                            "TeacherId"=>$schedule->TeacherId,
                            "ScheduleId"=>$schedule->id,
                            "Status"=>$Status,
                        ]
                    );
                    array_push($Temp['schedule'],$ArrayChild);
                }
            }
            array_push($Array,$Temp);
        }

        return response()->json(['class'=>$Array]);
    }

    public function GetSemesterLessonHoldingDate($ScheduleId,$WeekId,$DayId,$SemesterId)
    {
//        return $request;
        $Schedule=Main_Schedules::find($ScheduleId);
        $Semester=Base_Semester::find($SemesterId);
        $StartDate=new Jalalian(substr($Semester->StartDate,0,4),substr($Semester->StartDate,5,2),substr($Semester->StartDate,8,2));
        $EndDate=new Jalalian(substr($Semester->EndDate,0,4),substr($Semester->EndDate,5,2),substr($Semester->EndDate,8,2));
        $StartWeek=$StartDate->subDays(($StartDate->getDayOfWeek()) - ($DayId));

        $arr=array();
        if ($WeekId == 0)
        {
            ($StartWeek < $StartDate) ? $StartWeek=$StartWeek->getNextWeek(): $StartWeek;
            while ($StartWeek <= $EndDate)
            {
                array_push($arr,strval($StartWeek->format('%Y-%m-%d')));
                $StartWeek=$StartWeek->getNextWeek();
            }
        }
//        Even
        elseif ($WeekId == 1)
        {
            $StartWeek=$StartWeek->getNextWeek();
            while ($StartWeek <= $EndDate)
            {
                array_push($arr,strval($StartWeek->format('%Y-%m-%d')));
                $StartWeek=$StartWeek->getNextWeek();
                $StartWeek=$StartWeek->getNextWeek();
            }
        }
//        Odd
        else{
            while ($StartWeek <= $EndDate)
            {
                if($StartWeek < $StartDate) {
                    $StartWeek=$StartWeek->getNextWeek();
                    $StartWeek=$StartWeek->getNextWeek();
                }
                array_push($arr,strval($StartWeek->format('%Y-%m-%d')));
                $StartWeek=$StartWeek->getNextWeek();
                $StartWeek=$StartWeek->getNextWeek();
            }
        }
        return $arr;
    }

    public function Store(Request $request)
    {
        $Date=str_replace('/','-',$request->HoldingDate);
        $Attendance=Main_TeachersAttendance::where('ScheduleId',$request->data['data']['ScheduleId'])
            ->where('HoldingDate',$Date)->first();
        if ($Attendance)
        {
            Main_TeachersAttendance::where('ScheduleId',$request->data['data']['ScheduleId'])->where('HoldingDate',$Date)
                ->update([
                    'Status'=>($Attendance->Status=='1')?'0':'1'
                ]);
        }
        else{
            Main_TeachersAttendance::create([
                'ModifyUser'=>Auth::user()->id,
                'ScheduleId'=>$request->data['data']['ScheduleId'],
                'HoldingDate'=>$Date,
                'Status'=>1
                ]);
        }
        return  'true';
    }
}
