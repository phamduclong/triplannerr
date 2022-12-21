<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TourReportFollower extends Model
{
   protected $table = ' tour_report_followers';

   protected $fillable = [
        'tour_report_id',
        'user_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
