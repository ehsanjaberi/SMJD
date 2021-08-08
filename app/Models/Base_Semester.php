<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Semester extends Model
{
    use HasFactory;
    protected $fillable = [
        'ModifyUser',
        'IsDeleted',
        'Name',
        'Code',
        'UniversityId',
        'SessionType',
        'SessionDuration',
        'StartDate',
//        'StartDayType',
        'EndDate',
        'IsDefault'
    ];

    public function University()
    {
        return $this->hasOne(Base_Universities::class,'id','UniversityId');
    }

}
