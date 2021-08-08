<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Colleges extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'Code',
        'Name',
        'UniversityId',
        'Email',
        'Website',
        'Address',
        'PostalCode',
        'logo',
        ];
    public function University()
    {
        return $this->hasOne(Base_Universities::class,'id','UniversityId');
    }
    public function Students()
    {
        return $this->hasMany(Base_UniversityStudents::class,'CollegeId','id');
    }
    public function Fields()
    {
        return $this->hasMany(Base_Fields::class,'CollegeId','id');
    }
    public function Classes()
    {
        return $this->hasMany(Base_Classes::class,'CollegeId','id');
    }
}
