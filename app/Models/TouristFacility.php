<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class TouristFacility extends Model
{
   protected $table = 'tourist_facility';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

}
