<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\AdsData;

class Advertisement extends Model
{
   use SoftDeletes;
   protected $table = 'advertisements';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'title',
        'description',
        'view',
        'location',
        'type',
        'type_file',
        'embedded_link',
        'ad_url',
        'category_id',
        'country',
        'country_departure',
        'age',
        'travel_type',
        'vector_type',
        'type_of_accomodation',
        'type_of_participant',
        'preffered_stay_formula',
        'type_of_fav_meal',
        'budget',
        'ads_type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at', 
        'travel_pro_id',
        'travel_pro_name',
        'travel_pro_link',
    ];

    public function ads_click(){
       return $this->belongsTo(AdsData::class, 'id'); 
    }
}
