<?php

namespace App\Models;

use App\Models\TravelReports\TravelReports;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserParticipate extends Model
{
   use SoftDeletes;
   protected $table = 'user_participate';

   public function travel_report()
   {
      return $this->belongsTo(TravelReports::class, 'report_id');
   }
}
