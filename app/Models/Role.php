<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=['ModifyUser','IsDeleted','Name','ETitle'];
    public function RolePermission()
    {
        return $this->hasMany(RolePerimission::class,'RoleId','id');
    }

    public function UserRole()
    {
        return $this->hasMany(UserRole::class,'RoleId','id');
    }
}
