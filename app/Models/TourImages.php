<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourImages extends Model
{
   protected $table = 'tour_image';

   protected $fillable = [
        'tour_id',
        'img_name',
        'created_at',
        'updated_at',
        'deleted_at',

    ];
}
