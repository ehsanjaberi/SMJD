<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_Schedules extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'SemesterLessonId',
        'ClassId',
        'TeacherId',
        'StartTime',
        'EndTime',
        'HoldingData',
        'Week',
        'Day',
    ];

    public function Teacher()
    {
        return $this->hasOne(Base_UniversityTeacher::class,'id','TeacherId');
    }

    public function SemesterLesson()
    {
        return $this->hasOne(Base_SemesterLessons::class,'id','SemesterLessonId');
    }

    public function Class()
    {
        return $this->hasOne(Base_Classes::class,'id','ClassId');
    }
    public function StudentAttendance()
    {
        return $this->hasOne(Main_StudentsAttendance::class,'ScheduleId','id');
    }
}
