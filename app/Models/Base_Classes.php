<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Classes extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'Name',
        'Code',
        'CollegeId',
        'ClassStatus',
        'ClassType',
    ];

    public function College()
    {
        return $this->hasOne(Base_Colleges::class,'id','CollegeId');
    }

    public function Schedule()
    {
        return $this->hasMany(Main_Schedules::class,'ClassId','id');
    }
}
