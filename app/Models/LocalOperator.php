<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class LocalOperator extends Model
{
   protected $table = 'local_operators';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

}
