<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Classes;
use App\Models\Base_Colleges;
use App\Models\Base_Semester;
use App\Models\Base_SemesterLessons;
use App\Models\Base_UniversityStudents;
use App\Models\Main_Schedules;
use App\Models\Main_StudentsAttendance;
use App\Models\Uni_SubSystems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Morilog\Jalali\Jalalian;

class StudentAttendance extends Controller
{
    public function Index()
    {
        $person= Auth::user()->Person;
        $uniId=0;
        if ($person->Teacher)
        {
            $uniId=$person->Teacher->UniversityId;
        }
        if ($person->Employee)
        {
            $uniId=$person->Employee->UniversityId;
        }
        $Systems=Uni_SubSystems::all();
        $College=Base_Colleges::where('UniversityId',$uniId)->get();
        return view('Management.StudentAttendance')->with(['College'=>$College,'Sub'=>$Systems]);
    }
    public function GetSemesterLesson(Request $request)
    {
        $Classes=Base_Classes::where('CollegeId',$request->CollegeId)->get();
        $Semester=Base_Colleges::where('id',$request->CollegeId)->first()->University->Semesters->where('IsDefault',1)->first();

        $Array=array();
        foreach ($Classes as $key => $class) {
            foreach ($class->Schedule as $schedule) {
                if ($schedule->SemesterLesson->SemesterId==$Semester->id){
                    $Temp=array(
                        'ScheduleId'=>$schedule->id,
                        'LessonCode'=>$schedule->SemesterLesson->Code,
                        'LessonName'=>$schedule->SemesterLesson->Lesson->Name,
                        'TeacherName'=>$schedule->Teacher->Person->Name.' '.$schedule->Teacher->Person->Family,
                        'Week'=>$schedule->Week
                    );
                    array_push($Array,$Temp);
                }
            }
        }
        return $Array;
    }

    public function GetSemesterLessonHoldingDate(Request $request)
    {
        $Semester=Base_Colleges::where('id',$request->CollegeId)->first()->University->Semesters->where('IsDefault',1)->first();
//        $Semester=Base_Semester::where('IsDefault',1)->first();
        $Schedule=Main_Schedules::find($request->ScheduleId);
        return $this->Date($Semester->id,$Schedule->Week,$Schedule->Day);
    }

    public function GetSemesterLessonStudent(Request $request)
    {
//        return $request;
//        $Semester=Base_Semester::where('IsDefault',1)->first();
        $Schedule=Main_Schedules::where('id',$request->LessonList)->first();
        $Information=array(
            'ClassTitle'=>$Schedule->Class->Name,
            'LessonName'=>$Schedule->SemesterLesson->Lesson->Name,
            'TeacherName'=>$Schedule->Teacher->Person->Name.' '.$Schedule->Teacher->Person->Family,
        );
        $Array=array();
        foreach ($Schedule->SemesterLesson->SemesterLessonStudent as $semesterLessonStudent) {
            if ($Schedule->TeacherId==$semesterLessonStudent->Teacher->TeacherId){
                $Temp=array(
                    'StudentId'=>$semesterLessonStudent->StudentId,
                    'StudentName'=>$semesterLessonStudent->Student->Person->Name.' '.$semesterLessonStudent->Student->Person->Family,
                    'StudentCode'=>$semesterLessonStudent->Student->PersonalCode,
                    'Status'=>0,
                );
                $StudentStatus=Main_StudentsAttendance::where('UniversityStudentId',$semesterLessonStudent->StudentId)->where('ScheduleId',$request->LessonList)->where('HoldingDate',$request->HoldingDate)->first();
                if ($StudentStatus){
                    if ($StudentStatus->Status==1) {$Temp['Status']=1;}
                    elseif ($StudentStatus->Status==0){$Temp['Status']=2;}
                }
                array_push($Array,$Temp);
            }
        }

        return ['StudentList'=>$Array,'ClassInf'=>$Information];
    }
    public function Date($SemesterId,$WeekId,$DayId)
    {
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

    public function AB(Request $request)
    {
        $Student=Base_UniversityStudents::where('PersonalCode',$request->StudentNumber)->first()->id;
        $Status=Main_StudentsAttendance::where('ScheduleId',$request->ScheduleId)
            ->where('HoldingDate',$request->HoldingDate)
            ->where('UniversityStudentId',$Student)->first();
        if ($Status){
            Main_StudentsAttendance::where('ScheduleId',$request->ScheduleId)
                ->where('HoldingDate',$request->HoldingDate)
                ->where('UniversityStudentId',$Student)->update([
                    'Status'=>0
                ]);
        }else{
            $Attendance=new Main_StudentsAttendance();
            $Attendance->UniversityStudentId=$Student;
            $Attendance->UniversityStudentId=$Student;
            $Attendance->ScheduleId=$request->ScheduleId;
            $Attendance->HoldingDate=$request->HoldingDate;
            $Attendance->Status=0;
            $Attendance->save();
        }
        return 'OKAB';
    }
    public function PR(Request $request)
    {
        $Student=Base_UniversityStudents::where('PersonalCode',$request->StudentNumber)->first()->id;
        $Status=Main_StudentsAttendance::where('ScheduleId',$request->ScheduleId)
            ->where('HoldingDate',$request->HoldingDate)
            ->where('UniversityStudentId',$Student)->first();
        if ($Status){
            Main_StudentsAttendance::where('ScheduleId',$request->ScheduleId)
                ->where('HoldingDate',$request->HoldingDate)
                ->where('UniversityStudentId',$Student)->update([
                    'Status'=>1
                ]);
        }else{
            $Attendance=new Main_StudentsAttendance();
            $Attendance->UniversityStudentId=$Student;
                $Attendance->UniversityStudentId=$Student;
                $Attendance->ScheduleId=$request->ScheduleId;
                $Attendance->HoldingDate=$request->HoldingDate;
                $Attendance->Status=1;
                $Attendance->save();
        }
        return 'OKPR';
    }
}
