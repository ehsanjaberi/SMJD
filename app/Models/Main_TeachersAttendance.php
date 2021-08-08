<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_TeachersAttendance extends Model
{
    use HasFactory;
    protected $fillable=[
      'ModifyUser',
      'IsDeleted',
      'ScheduleId',
      'HoldingDate',
      'Status',
    ];
}
