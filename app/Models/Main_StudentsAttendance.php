<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_StudentsAttendance extends Model
{
    use HasFactory;
    protected $filable=[
        'ModifyUser',
        'IsDeleted',
        'UniversityStudentId',
        'ScheduleId',
        'HoldingDate',
        'Status',
    ];

    public function Student()
    {
        return $this->hasOne(Base_UniversityStudents::class,'id','UniversityStudentId');
    }
}
