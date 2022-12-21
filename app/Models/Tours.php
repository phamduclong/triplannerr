<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Services;
use App\Models\Destination;
use App\Models\Currency;
use App\Models\TourServices;
use App\Models\TourDestination;
use App\Models\TourGraphic;

class Tours extends Model
{
   protected $table = 'tours';

   protected $fillable = [
        'user_id',
        'departure_id',
        'title',
        'description',
        'no_of_days',
        'no_of_nights',
        'banner',
        'cost',
        'start_date_time',
        'end_date_time',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_descirption',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function tour_destination()
    {
        return $this->hasMany(TourDestination::class, 'tour_id');
    }

    public function tour_services()
    {
        return $this->hasMany(TourServices::class, 'tour_id');
    }

    public function tour_other_image()
    {
        return $this->hasMany(TourGraphic::class, 'tour_id');
    }
}
