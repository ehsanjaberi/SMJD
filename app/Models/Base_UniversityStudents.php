<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_UniversityStudents extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'PersonId',
        'PersonalCode',
        'CollegeId',
        'FieldId',
        'DegreeId',
        'StartDate',
        'EndDate'
    ];
    public function Person()
    {
        return $this->hasOne(Base_Persons::class,'id','PersonId');
    }

    public function Degree()
    {
        return $this->hasOne(Base_Degree::class,'id','DegreeId');
    }
    public function Field()
    {
        return $this->hasOne(Base_Fields::class,'id','FieldId');
    }
    public function College()
    {
        return $this->hasOne(Base_Colleges::class,'id','CollegeId');
    }

    public function SemesterLessonStudent()
    {
        return $this->hasMany(Main_SemesterLessonStudent::class,'StudentId','id');
    }
    public function Grades()
    {
        return $this->hasMany(Main_Uni_Stu_Grade::class,'UniversityStudentId','id');
    }
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
