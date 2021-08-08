<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_GradeTypes extends Model
{
    use HasFactory;
    protected $fillable=['ModifyUser','IsDeleted','Name','ETitle'];
}
