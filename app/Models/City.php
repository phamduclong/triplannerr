<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
   protected $table = 'cities';

   protected $fillable = [
        'name',
        'state_id',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
