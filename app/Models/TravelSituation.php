<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class TravelSituation extends Model
{
   protected $table = 'travel_sentimental_situations';

   protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
