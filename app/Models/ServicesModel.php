<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicesModel extends Model
{
   protected $table = 'services';

   protected $fillable = [
        'title',
        'description',
        'slug',
        'graphic_type',
        'graphic_content',
        'status',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
