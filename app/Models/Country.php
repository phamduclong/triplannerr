<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   protected $table = 'countries';

   protected $fillable = [
        'sortname',
        'name',
        'phonecode',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
