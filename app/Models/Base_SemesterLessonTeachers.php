<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_SemesterLessonTeachers extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'SemesterLessonId',
        'TeacherId',
    ];

    public function Teacher()
    {
        return $this->hasOne(Base_UniversityTeacher::class,'id','TeacherId');
    }
}
