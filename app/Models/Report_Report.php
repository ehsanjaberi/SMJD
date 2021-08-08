<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_Report extends Model
{
    use HasFactory;
    protected $fillable=[
      'ModifyUser',
      'IsDeleted',
      'ReportGroupId',
      'Title',
      'Query',
      'SumColumns',
      'ViewColumns',
      'HasPager',
    ];

    public function Group()
    {
        return $this->hasOne(Report_ReportGroups::class,'id','ReportGroupId');
    }

    public function Columns()
    {
        return $this->hasMany(Report_ReportColumns::class,'ReportId','id');
    }
    public function Parameters()
    {
        return $this->hasMany(Report_ReportParameter::class,'ReportId','id');
    }
}
