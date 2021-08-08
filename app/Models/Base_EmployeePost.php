<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_EmployeePost extends Model
{
    use HasFactory;
    protected $fillable=['ModifyUser','IsDeleted','UniversityPostId','UniversityEmployeeId'];

    public function UniversityPost()
    {
        return $this->hasOne(Base_UniversityPosts::class,'id','UniversityPostId');
    }
}
