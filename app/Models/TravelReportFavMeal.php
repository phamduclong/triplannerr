<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelReportFavMeal extends Model
{
   protected $table = 'travel_fav_meal_cost';

   protected $fillable = [
        'travel_report_id',
        'travel_fav_meal',
        'individual_cost',
        'total_cost',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
