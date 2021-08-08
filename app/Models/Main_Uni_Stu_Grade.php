<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_Uni_Stu_Grade extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'UniversityStudentId',
        'SemesterLessonGradeId',
        'Grade',
        'Description'
    ];
}
