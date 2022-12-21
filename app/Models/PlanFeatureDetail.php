<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\PlanFeatureId;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeatureDetail extends Model
{
   use SoftDeletes;
   protected $table = 'plan_feature_detail';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'plan_id',
        'plan_feature_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
