<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelReportGallery extends Model
{
   protected $table = 'travel_report_gallery';

   protected $fillable = [
        'travel_report_id',
        'gallery_image',
        'image_caption',
        'image_location',
        'image_sorting',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
