<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = [
        'ModifyUser',
        'IsDeleted',
        'Username',
        'password',
        'PersonId',
    ];
    protected $hidden = [
        'password',
    ];

    public function Person()
    {
        return $this->hasOne(Base_Persons::class,'id','PersonId');
    }

    public function UserRole()
    {
        return $this->hasOne(UserRole::class,'UserId','id');
    }

    public function Messages()
    {
        return $this->hasMany(Message::class,'from_id','id');
    }
}
