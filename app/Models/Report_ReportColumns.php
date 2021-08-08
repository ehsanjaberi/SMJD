<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_ReportColumns extends Model
{
    use HasFactory;
    protected $fillable=[
        'ModifyUser',
        'IsDeleted',
        'ReportId',
        'Title',
        'IsSeparator',
        'IsSum',
        'IsAverage',
    ];

    public function Report()
    {
        return $this->hasOne(Report_Report::class,'id','ReportId');
    }
}
