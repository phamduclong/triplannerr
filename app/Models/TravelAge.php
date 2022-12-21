<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class TravelAge extends Model
{
   protected $table = 'travel_ages';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

}
