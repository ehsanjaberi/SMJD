<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePerimission extends Model
{
    use HasFactory;
    protected $fillable=['id','ModifyUser','IdDeleted','PermissionId','RoleId'];
    public function Permission()
    {
        return $this->hasOne(Perimission::class,'id','PermissionId');
    }
}
