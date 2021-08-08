<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_UniversityTeacher extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'PersonId',
        'PersonalCode',
        'UniversityId',
        'DegreeId',
        'Field'
    ];
    public function Person()
    {
        return $this->hasOne(Base_Persons::class,'id','PersonId');
    }
    public function Degree()
    {
        return $this->hasOne(Base_Degree::class,'id','DegreeId');
    }
    public function University()
    {
        return $this->hasOne(Base_Universities::class,'id','UniversityId');
    }
}
