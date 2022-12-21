<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmailDetails extends Model
{
   use SoftDeletes;
   protected $table = 'emaildetails';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'type',
        'subject',
        'content',
        'sent_to',
        'sent_from',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

   

    
}
