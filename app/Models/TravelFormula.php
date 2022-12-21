<?php

namespace App\Models;

use App\Models\State;
use App\Models\BaseModel;

class TravelFormula extends BaseModel
{
   protected $table = 'travel_formulas';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

}
