<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelReportReserved extends Model
{
    protected $table = 'travel_report_reserved';

    protected $fillable = [
        'user_id',
        'report_id ',
        'created_at ',
        'updated_at ',
        
    ];

} 
