<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base_Equipments extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'Code',
        'Name',
        'Description'
];
}
