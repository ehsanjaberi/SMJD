<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Universities extends Model
{
    use HasFactory;
    protected $fillable=['ModifyUser','IsDeleted','Code','Name','Address'];

    public function UniversityPost()
    {
        return $this->hasMany(Base_UniversityPosts::class,'UniversityId','id');
    }

    public function Semesters()
    {
        return $this->hasMany(Base_Semester::class,'UniversityId','id');
    }
}
