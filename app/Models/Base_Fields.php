<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Fields extends Model
{
    use HasFactory;
    protected $fillable=['ModifyUser','IsDeleted','Code','Name','CollegeId','IsDaily'];
    public function College()
    {
        return $this->hasOne(Base_Colleges::class,'id','CollegeId');
    }

    public function Lessons()
    {
        return $this->hasMany(Base_Lessons::class,'FieldId','id');
    }
}
