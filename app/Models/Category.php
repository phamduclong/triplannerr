<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   protected $table = 'categories';

   protected $fillable = [
    'name',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

}
