<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ReportContent extends Model
{
   protected $table = 'request_content';

   protected $fillable = [
    'description',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

}
