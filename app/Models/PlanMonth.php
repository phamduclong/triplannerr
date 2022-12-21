<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PlanMonth extends Model
{
	 use SoftDeletes;
   protected $table = 'plan_months';

   protected $fillable = [
        'name',
        'no_of_month',
        'discount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
