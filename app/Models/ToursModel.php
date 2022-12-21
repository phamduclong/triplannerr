<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ServicesModel;
use App\Models\DestinationModel;
use App\Models\CurrencyModel;
use App\Models\TourServicesModel;
use App\Models\TourDestinationModel;
use App\Models\TourGraphicModel;

class ToursModel extends Model
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
        return $this->hasMany(TourDestinationModel::class, 'tour_id');
    }

    public function tour_services()
    {
        return $this->hasMany(TourServicesModel::class, 'tour_id');
    }

    public function tour_other_image()
    {
        return $this->hasMany(TourGraphicModel::class, 'tour_id');
    }
}
