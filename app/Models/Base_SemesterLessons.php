<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_SemesterLessons extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'Code',
        'LessonId',
        'SemesterId',
    ];

    public function Semester()
    {
        return $this->hasOne(Base_Semester::class,'id','SemesterId');
    }
    public function Lesson()
    {
        return $this->hasOne(Base_Lessons::class,'id','LessonId');
    }

    public function Teachers()
    {
        return $this->hasMany(Base_SemesterLessonTeachers::class,'SemesterLessonId','id');
    }

    public function Schedule()
    {
        return $this->hasMany(Main_Schedules::class,'SemesterLessonId','id');
    }

    public function SemesterLessonStudent()
    {
        return $this->hasMany(Main_SemesterLessonStudent::class,'SemesterLessonId','id');
    }
    public function GradeTypes()
    {
        return $this->hasMany(Main_SemesterLessonGrades::class,'SemesterLessonId','id');
    }
}
