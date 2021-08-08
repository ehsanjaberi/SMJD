<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_ReportParameter extends Model
{
    use HasFactory;
    protected $fillable=[
      'ModifyUser',
      'IsDeleted',
      'ReportId',
      'Title',
      'Name',
      'Priority',
      'Type',
      'Query',
      'IsOptional',
      'Width',
    ];

    public function Report()
    {
        return $this->hasOne(Report_Report::class,'id','ReportId');
    }

    public function StaticItems()
    {
        return $this->hasMany(Report_StaticItems::class,'ReportParameterId','id');
    }
}
