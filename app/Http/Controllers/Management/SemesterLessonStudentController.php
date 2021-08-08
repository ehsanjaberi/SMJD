<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Base_Colleges;
use App\Models\Base_Semester;
use App\Models\Base_SemesterLessonTeachers;
use App\Models\Base_UniversityStudents;
use App\Models\Main_SemesterLessonStudent;
use App\Models\Uni_SubSystems;
use Faker\Guesser\Name;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterLessonStudentController extends Controller
{
    public function Index()
    {
        $Systems=Uni_SubSystems::all();
        return view('Management.SemesterLessonStudent')->with(['Sub'=>$Systems]);
    }

    public function AddSemesterLessonStudent(Request $request)
    {
        $Lessons=$request->LessonList;
        $Student=Base_UniversityStudents::where('id',$request->StudentId)->first();
//        $Semester = Base_Semester::where('IsDefault', 1)->first();
        $Semester=Base_Colleges::where('id',$Student->CollegeId)->first()->University->Semesters->where('IsDefault',1)->first();
        $Student->Field->College->University;
        foreach ($Student->SemesterLessonStudent as $index=>$SemesterLessonStudent) {
            if ($SemesterLessonStudent->SemesterLesson->SemesterId==$Semester->id){
                $SemesterLessonStudent->delete();
            }
        }
        if ($Lessons){
            foreach ($Lessons as $lesson)
            {
                $SemesterLessonId=explode('|',$lesson)[0];
                $TeacherId=explode('|',$lesson)[1];
                Main_SemesterLessonStudent::create([
                    'ModifyUser'=>Auth::user()->id,
                    'SemesterLessonId'=>$SemesterLessonId,
                    'SemesterLessonTeacherId'=>$TeacherId,
                    'StudentId'=>$request->StudentId,
                ]);
            }
        }

        $Student=Base_UniversityStudents::where('id',$request->StudentId)->first();
        return $this->GetInf($Student->PersonalCode);

    }
    public function GetSemesterLessonStudent(Request $request)
    {
        return $this->GetInf($request->PersonalCode);
    }

    public function GetInf($PC)
    {
        $Student=Base_UniversityStudents::where('PersonalCode',$PC)->first();
        if ($Student) {
//            $Semester = Base_Semester::where('IsDefault', 1)->first();
            $Semester=Base_Colleges::where('id',$Student->CollegeId)->first()->University->Semesters->where('IsDefault',1)->first();
            $Arr = array();
            $Arr1 = array();
            $Student->Person;
            $Student->Field->College->University;
            foreach ($Student->SemesterLessonStudent as $index=>$semesterLessonStudent) {
                if ($semesterLessonStudent->SemesterLesson->SemesterId==$Semester->id){
                    $Gr=0;
                    foreach ($semesterLessonStudent->SemesterLesson->GradeTypes as $gradeType) {
                        foreach ($gradeType->Grade as $grade) {
                            if ($grade->UniversityStudentId==$Student->id)
                            {
                                $Gr+=$grade->Grade;
                            }
                        }
                    }
                    $Temp1=array(
                        'id'=>$index,
                        'LessonName'=>$semesterLessonStudent->SemesterLesson->Lesson->Name,
                        'TeacherName'=>$semesterLessonStudent->Teacher->Teacher->Person->Name.' '.$semesterLessonStudent->Teacher->Teacher->Person->Family,
                        'SemesterLessonId'=>$semesterLessonStudent->SemesterLesson->id,
                        'SemesterLessonTeacherId'=>$semesterLessonStudent->SemesterLessonTeacherId,
                        'Grade'=>$Gr
                    );
                    array_push($Arr1, $Temp1);
                }
            }
            foreach ($Student->Field->Lessons as $lesson) {
                foreach ($lesson->SemesterLesson as $semesterlesson) {
                    if ($Semester->id == $semesterlesson->SemesterId) {
                        foreach ($semesterlesson->Teachers as $teacher) {
                            $Temp = array(
                                "Teacher" => $teacher->Teacher->Person->Name . ' ' . $teacher->Teacher->Person->Family,
                                "LessonName" => $semesterlesson->Lesson->Name,
                                "SemesterLessonId" => $semesterlesson->id,
                                "SemesterLessonTeacherId" => $teacher->id,
                                "Checked" => false
                            );
                            foreach ($Arr1 as $arr) {
                                if ($arr['SemesterLessonId'] == $semesterlesson->id && $arr['SemesterLessonTeacherId'] == $teacher->id) {
                                    $Temp['Checked'] = true;
                                }
                            }
                            array_push($Arr, $Temp);
                        }
                    }
                }
            }
            return ['AssignedLesson'=>$Arr1,'Student'=>$Student,'AssignLesson'=>$Arr,'Semester'=>$Semester];
        }
        else{
            return ['Student'=>''];
        }
    }

    public function SearchStudent($id=null)
    {
        if  ($id!=null)
        {
            $output='<ul class="dropdown-menu" style="display: block;position:relative;">';
            $Students=Base_UniversityStudents::where('PersonalCode','like','%'.$id.'%')->get();
            foreach ($Students as $student)
            {
                $output.='<li class="click"><a href="#">'.$student->PersonalCode.'</a></li>';
            }
            $output .= '</ul>';
            return response()->json(['Output'=>$output]);
        }
        else{
            return response()->json(['Output'=>null]);
        }
    }
}
