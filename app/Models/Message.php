<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable=['id','from_id','to_id','type','body','attachment','seen','created'];
    public $timestamps=false;

    public function User()
    {
        return $this->hasOne(User::class,'id','from_id');
    }
    public function UserTo()
    {
        return $this->hasOne(User::class,'id','to_id');
    }
}
