<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Classes;
use App\Models\Base_Colleges;
use App\Models\Base_Semester;
use App\Models\Base_SemesterLessons;
use App\Models\Base_Universities;
use App\Models\Main_Schedules;
use App\Models\Uni_SubSystems;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use Morilog\Jalali\Tests\JalalianTest;

class SemesterLessonToClassController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        $University=Base_Universities::where('IsDeleted',0)->get();
        return view('Management.SemesterLessonToClass')->with(['University'=>$University,'Sub'=>$Systems]);
    }

    public function Add(Request $request)
    {
        $arr=$this->Date($request);
        if ($request->DeletedItems)
        {
            foreach ($request->DeletedItems as $deletedItem) {
                Main_Schedules::where('id',$deletedItem)->where('ModifyUser',Auth::user()->id)->delete();
            }
        }
        foreach ($request->TimeLine as $Class)
        {
            foreach ($Class['schedule'] as $schedule)
            {
                if ($schedule['data']['ScheduleId'] != 0)
                {
//                  Edit
//                  write sentence
                    Main_Schedules::where('id',$schedule['data']['ScheduleId'])->where('ModifyUser',Auth::user()->id)->update([
                        'ModifyUser'=>Auth::user()->id,
                        'SemesterLessonId'=>$schedule['data']['SemesterLessonId'],
                        'ClassId'=>$Class['ClassId'],
                        'TeacherId'=>$schedule['data']['TeacherId'],
                        'StartTime'=>$schedule['start'],
                        'EndTime'=>$schedule['end'],
                        'HoldingData'=>Base_Semester::find($request->SemesterId)->first()->StartDate,
//                        'Week'=>$request->WeekId,
                        'Day'=>$request->DayId,
                    ]);
                }
                else{
//                  Add
//                  write sentence
                    Main_Schedules::create([
                        'ModifyUser'=>Auth::user()->id,
                        'SemesterLessonId'=>$schedule['data']['SemesterLessonId'],
                        'ClassId'=>$Class['ClassId'],
                        'TeacherId'=>$schedule['data']['TeacherId'],
                        'StartTime'=>$schedule['start'],
                        'EndTime'=>$schedule['end'],
                        'HoldingData'=>Base_Semester::find($request->SemesterId)->first()->StartDate,
                        'Week'=>$request->WeekId,
                        'Day'=>$request->DayId,
                    ]);
                }
            }
        }
        return $this->Pub($request);
    }
    public function GetInformation(Request $request)
    {
        return $this->Pub($request);
    }

    public function Pub($request)
    {
        $Fields=Base_Colleges::where('id',$request->CollegeId)->first()->Fields;
        $Lesson=array();
        $Schedules=array();
        $i=1;
//        Ok
        foreach ($Fields as $filed)
        {

            foreach ($filed->Lessons as $lesson)
            {

                foreach ($lesson->SemesterLesson as $semesterlesson)
                {

                    if ($request->SemesterId == $semesterlesson->SemesterId)
                    {

                        foreach ($semesterlesson->Teachers as $teacher)
                        {
                                $Temp=array(
                                    "id"=>$i,
                                    "title"=>$semesterlesson->Lesson->Name.'('.$teacher->Teacher->Person->Name.' '.$teacher->Teacher->Person->Family.')',
                                    "TeacherId"=>$teacher->TeacherId,
                                    "SemesterLessonId"=>$semesterlesson->id,
                                );
                                array_push($Lesson,$Temp);
                                $i++;
                        }

                        foreach ($semesterlesson->Schedule as $schedule)
                        {
                            if ($request->WeekId == 0)
                            {
                                if ($schedule->Week == 0 && $request->DayId == $schedule->Day)
                                {
                                    array_push($Schedules,$schedule);
                                }
                            }
                            else{
                                if (($request->WeekId == $schedule->Week || 0 == $schedule->Week ) && $request->DayId == $schedule->Day)
                                {
                                    array_push($Schedules,$schedule);
                                }
                            }

//                            else if ($request->WeekId == 1 && $request->DayId == $schedule->Day)
//                            elseif ($request->WeekId == 2 && $request->DayId == $schedule->Day)
//                            {
//                                array_push($Schedules,$schedule);
//                            }

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
                    $ArrayChild=array(
                        "start"=>$schedule->StartTime,
                        "end"=>$schedule->EndTime,
                        "text"=>$schedule->SemesterLesson->Lesson->Name.'('.$schedule->Teacher->Person->Name.' '.$schedule->Teacher->Person->Family.')',
                        "data"=>[
                            "SemesterLessonId"=>$schedule->SemesterLessonId,
                            "ClassId"=>$schedule->ClassId,
                            "TeacherId"=>$schedule->TeacherId,
                            "ScheduleId"=>$schedule->id,
                            "Week"=>$schedule->Week,
                        ]
                    );
                    array_push($Temp['schedule'],$ArrayChild);
                }
            }
            array_push($Array,$Temp);
        }

        return response()->json(['SemesterLesson'=>$Lesson,'class'=>$Array]);
    }

    public function Date($request)
    {
        $Semester=Base_Semester::find($request->SemesterId);
        $StartDate=new Jalalian(substr($Semester->StartDate,0,4),substr($Semester->StartDate,5,2),substr($Semester->StartDate,8,2));
        $EndDate=new Jalalian(substr($Semester->EndDate,0,4),substr($Semester->EndDate,5,2),substr($Semester->EndDate,8,2));
        $StartWeek=$StartDate->subDays(($StartDate->getDayOfWeek()) - ($request->DayId));

        $arr=array();
        if ($request->WeekId == 0)
        {
            ($StartWeek < $StartDate) ? $StartWeek=$StartWeek->getNextWeek(): $StartWeek;
            while ($StartWeek <= $EndDate)
            {
                array_push($arr,strval($StartWeek->format('%Y-%m-%d')));
                $StartWeek=$StartWeek->getNextWeek();
            }
        }
//        Even
        elseif ($request->WeekId == 1)
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
    public function Add1(Request $request)
    {
        $SemesterLesson=Base_SemesterLessons::where('SemesterId',$request->SemesterId)->get();
//        $Schedule=Main_Schedules::where()->get();
        foreach ($SemesterLesson as $Lesson)
        {
            $Lesson->Schedule;
//            return $Lesson->Lesson->Field->College->id;
        }
//        return $SemesterLesson;
//        Check if exist, no insert
        $Classes=json_decode($request->timeline,true);
        foreach ($Classes as $class)
        {
            foreach ($class['schedule'] as $schedule)
            {
                if ($schedule['data']['ScheduleId'] != 0)
                {
                    Main_Schedules::where('id',$schedule['data']['ScheduleId'])->update([
                        'ModifyUser'=>Auth::user()->id,
                        'SemesterLessonId'=>$schedule['data']['SemesterLessonId'],
                        'ClassId'=>$class['ClassId'],
                        'TeacherId'=>$schedule['data']['TeacherId'],
                        'StartTime'=>$schedule['start'],
                        'EndTime'=>$schedule['end'],
                        'HoldingData'=>$request->WeekId,
                    ]);
                }
                else{
                    Main_Schedules::create([
                        'ModifyUser'=>Auth::user()->id,
                        'SemesterLessonId'=>$schedule['data']['SemesterLessonId'],
                        'ClassId'=>$class['ClassId'],
                        'TeacherId'=>$schedule['data']['TeacherId'],
                        'StartTime'=>$schedule['start'],
                        'EndTime'=>$schedule['end'],
                        'HoldingData'=>$request->WeekId,
                    ]);
                }
            }
        }
        $DeletedItem=json_decode($request->DeletedItem,true);
        if ($DeletedItem)
        {
            foreach ($DeletedItem as $item)
            {
                Main_Schedules::where('id',$item['ScheduleId'])->update([
                    'IsDeleted'=>1
                ]);
            }
        }
        return $this->Pub($request);
    }
}
