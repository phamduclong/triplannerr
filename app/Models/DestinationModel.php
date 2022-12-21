<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationModel extends Model
{
   protected $table = 'destinations';

   protected $fillable = [
        'destination_id',
        'name',
        'description',
        'country_id',
        'country',
        'state',
        'city',
        'wheather',
        'popular',
        'visits',
        'lattitude',
        'longitude',
        'is_active',
        'created_at',
        'updated_at',
        'deleted_at',

    ];
}
