<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourServicesModel extends Model
{
   protected $table = 'tour_services';

   protected $fillable = [
        'tour_id',
        'service_id'
    ];
}
