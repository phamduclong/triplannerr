<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlanFeatureId;


class PlanFeatureId extends Model
{
   
   protected $table = 'plan_feature_id';

   protected $fillable = [
        'plan_id',
        'feature_id',
    
    ];

    

}
