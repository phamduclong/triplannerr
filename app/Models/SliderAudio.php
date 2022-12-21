<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SliderAudio extends Model
{
	 use SoftDeletes;
   protected $table = 'slider_audio';

   protected $fillable = [
        'title',
        'slide_audio',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
