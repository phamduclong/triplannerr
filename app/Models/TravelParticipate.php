<?php

namespace App\Models;

use App\Models\State;
use App\Models\BaseModel;

class TravelParticipate extends BaseModel
{
   protected $table = 'travel_participates';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

}
