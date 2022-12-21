<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourServices extends Model
{
   protected $table = 'tour_services';

   protected $fillable = [
        'tour_id',
        'service_id'
    ];
}
