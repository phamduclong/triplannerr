<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
//use App\Models\TourCarrier;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourCarrier extends Model
{
   use SoftDeletes;
   protected $table = 'tour_carriers';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'title',
        'description',
        'graphic_type',
        'graphic_content',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

}
