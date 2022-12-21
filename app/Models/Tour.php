<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TourImages;

class Tour extends Model
{
   protected $table = 'tour';

   protected $fillable = [
        'title',
        'description',
        'cost',
        'banner',
        'image',
        'review',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

  //join between two table
  public function tour_images(){
    return $this->hasMany(TourImages::class, 'tour_id');
  }

}
