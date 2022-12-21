<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
   protected $table = 'states';

   protected $fillable = [
        'name',
        'country_id',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',

    ];
}
