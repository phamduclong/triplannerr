<?php

namespace App\Models;

use App\Models\State;
use App\Models\BaseModel;

class TravelTypes extends BaseModel
{
   protected $table = 'travel_types';
   
   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

}
