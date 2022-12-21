<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class AgencyOption extends Model
{
   protected $table = 'agency_options';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

}
