<?php

namespace App\Models;

use App\Models\State;
use App\Models\BaseModel;

class TravelAccommodation extends BaseModel
{
   protected $table = 'travel_accommodations';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

}
