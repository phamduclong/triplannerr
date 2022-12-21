<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\TravelReport;

class TourReportAlert extends Model
{
   protected $table = 'tour_report_alerts';

   protected $fillable = [
        'tour_report_id',
        'user_id',
        'content',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
      public function TravelReport(){

        return $this->belongsTo(TravelReport::class);
    
      }
}
