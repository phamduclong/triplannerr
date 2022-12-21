<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankDetails extends Model
{
   use SoftDeletes;
   protected $table = 'bank_details';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'name_on_card',
        'card_number',
        'expiry_month',
        'expiry_year',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

   
}
