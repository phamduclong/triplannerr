<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\State;

class TravelBudget extends BaseModel
{
   protected $table = 'travel_budgets';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

}
