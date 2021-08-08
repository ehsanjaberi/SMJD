<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uni_SubSystems extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'Name',
        'Title',
        'icon',
        'Order',
    ];

    public function Menu()
    {
        return $this->hasMany(Base_Menu::class,'SubSystemId','id');
    }
    public function ReportMenu()
    {
        return $this->hasMany(Report_ReportGroups::class,'SubSystemId','id');
    }
}
