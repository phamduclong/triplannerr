<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class TravelProType extends Model
{
   protected $table = 'report_pro_type';

   protected $fillable = [
    'travel_report_id',
    'offer',
    'operator',
    'facility',
    'offer_cost',
    'operator_cost',
    'facility_cost',
    'status',
    'create_at',
    'updated_at',
    'deleted_at'
  ];

}
