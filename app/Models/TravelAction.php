<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class TravelAction extends Model
{
   protected $table = 'travel_actions';

   protected $fillable = [
    'report_id',
    'user_id',
    'action',
    'action_status',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
  ];
  public function TravelReport(){

    return $this->belongsTo(TravelReport::class);
}

}
