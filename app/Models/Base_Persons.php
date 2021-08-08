<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Persons extends Model
{
    use HasFactory;
    protected $fillable=['id','ModifyUser','IsDeleted','Name','Family','NationalCode','Gender','Image'];

    public function Employee()
    {
        return $this->hasOne(Base_UniversityEmployees::class,'PersonId','id');
    }

    public function Student()
    {
        return $this->hasOne(Base_UniversityStudents::class,'PersonId','id');
    }
    public function Teacher()
    {
        return $this->hasOne(Base_UniversityTeacher::class,'PersonId','id');
    }
}
