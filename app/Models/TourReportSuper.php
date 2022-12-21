<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\TravelReport;

class TourReportSuper extends Model
{
   protected $table = 'tour_report_supers';

   protected $fillable = [
        'tour_id',
        'user_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

      public function TravelReport(){

        return $this->belongsTo(TravelReport::class, 'user_id');
    
      }

}
