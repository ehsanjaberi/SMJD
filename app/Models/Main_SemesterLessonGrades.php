<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_SemesterLessonGrades extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'SemesterLessonId',
        'GradeTypeId',
        'MaxGrade',
    ];

    public function GradeType()
    {
        return $this->hasOne(Base_GradeTypes::class,'id','GradeTypeId');
    }

    public function SemesterLesson()
    {
        return $this->hasOne(Base_SemesterLessons::class,'id','SemesterLessonId');
    }

    public function Grade()
    {
        return $this->hasMany(Main_Uni_Stu_Grade::class,'SemesterLessonGradeId','id');
    }
}
