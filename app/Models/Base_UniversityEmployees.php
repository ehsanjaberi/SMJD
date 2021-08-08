<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_UniversityEmployees extends Model
{
    use HasFactory;
    protected $fillable=['id','ModifyUser','IsDeleted','PersonId','PersonalCode','UniversityId','DegreeId','Field'];

    public function Person()
    {
        return $this->hasOne(Base_Persons::class,'id','PersonId');
    }

    public function Post()
    {
        return $this->hasOne(Base_EmployeePost::class,'UniversityEmployeeId','id');
    }

    public function University()
    {
        return $this->hasOne(Base_Universities::class,'id','UniversityId');
    }
}
