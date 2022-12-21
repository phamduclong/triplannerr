<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PublicCard extends Model
{
   use SoftDeletes;
   protected $table = 'public_card';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'departure_from_date',
        'departure_to_date',
        'price',
        'payment_percentage',
        'min_participants',
        'max_participants',
        'paypal_id',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

   
}
