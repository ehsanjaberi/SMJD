<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report_StaticItems extends Model
{
    use HasFactory;
    protected $fillable=[
      'ModifyUser',
      'IsDeleted',
      'ReportParameterId',
      'key',
      'value',
      'IsDefault',
    ];
}
