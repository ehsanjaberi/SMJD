<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser','IsDeleted','UserId','RoleId'
    ];
    public function Role() {
        return $this->hasOne(Role::class,'id','RoleId');
    }
}
