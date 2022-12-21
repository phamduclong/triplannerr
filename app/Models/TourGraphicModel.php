<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourGraphicModel extends Model
{
   protected $table = 'tour_graphics';

   protected $fillable = [
        'tour_id',
        'original_image',
        'thumb_image',
        'middle_size_image'
    ];
}
