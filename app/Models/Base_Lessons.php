<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Lessons extends Model
{
    use HasFactory;
    protected $fillable=['ModifyUser','IsDeleted','Code','Name','PracticalUnits','TheoricalUnits','FieldId','DegreeId'];

    public function Field()
    {
        return $this->hasOne(Base_Fields::class,'id','FieldId');
    }
    public function Degree()
    {
        return $this->hasOne(Base_Degree::class,'id','DegreeId');
    }

    public function SemesterLesson()
    {
        return $this->hasMany(Base_SemesterLessons::class,'LessonId','id');
    }
}
