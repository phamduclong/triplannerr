<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelReportCarriers extends Model
{
   protected $table = 'travel_report_carriers';

   protected $fillable = [
        'travel_report_id',
        'carrier_name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
