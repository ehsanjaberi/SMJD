<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_SemesterLessonStudent extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'SemesterLessonId',
        'SemesterLessonTeacherId',
        'StudentId',
        'Grade',
    ];

    public function Student()
    {
        return $this->hasOne(Base_UniversityStudents::class,'id','StudentId');
    }
    public function SemesterLesson()
    {
        return $this->hasOne(Base_SemesterLessons::class,'id','SemesterLessonId');
    }

    public function Teacher()
    {
        return $this->hasOne(Base_SemesterLessonTeachers::class,'id','SemesterLessonTeacherId');
    }
}
