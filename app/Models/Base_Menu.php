<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Menu extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser','IsDeleted','Name','Title','SubSystemId','icon','Order','PermissionId'
    ];

    public function Parent()
    {
        return $this->hasOne(Uni_SubSystems::class,'id','SubSystemId');
    }
}
