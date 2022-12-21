<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TripBooking extends Model
{
   protected $table = 'trip_booking';

   protected $fillable = [
    'identification_option',
    'local_operator',
    'tourist_facility',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

}
