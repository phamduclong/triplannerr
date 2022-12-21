<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelReportSlideshow extends Model
{
   protected $table = 'travel_report_slideshow';

   protected $fillable = [
        'travel_report_id',
        'slide_name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
