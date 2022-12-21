<?php

namespace App\Models;
use App\Models\State;
use App\Models\TravelFavoriteMealsType;
use Illuminate\Database\Eloquent\Model;
class TravelFavoriteMealsType extends Model
{
   protected $table = 'travel_favorite_meals_type';

   protected $fillable = [
   	'parent_id',
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

   public function travel_meal(){
   
    return $this->belongsTo(self::class,'parent_id');
   
   }

}
