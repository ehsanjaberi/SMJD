<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_ReportGroups extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'SubSystemId',
        'Name',
        'Title',
        'Icon',
    ];

    public function Reports()
    {
        return $this->hasMany(Report_Report::class,'ReportGroupId','id');
    }
}
