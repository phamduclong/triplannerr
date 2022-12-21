<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourDestination extends Model
{
   protected $table = 'tour_destinations';

   protected $fillable = [
        'tour_id',
        'destination_id',
    ];
}
