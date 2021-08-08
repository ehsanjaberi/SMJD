<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_UniversityPosts extends Model
{
    use HasFactory;
    protected $fillable=['id','ModifyUser','IsDeleted','UniversityId','Code','Name'];

    public function University()
    {
        return $this->hasOne(Base_Universities::class,'id','UniversityId');
    }
}
