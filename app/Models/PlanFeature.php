<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\PlanFeature;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanFeature extends Model
{
    use SoftDeletes;
   protected $table = 'plan_features';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'plan_id',
        'feature_name',
        'plan_privilege_id',
        'occurence',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

     public function plan_feature()
    {
        return $this->belongsToMany(PlanFeatureId::class, 'plan_feature_id', 'plan_id', 'feature_id');
    }

    public function PrivilegeName(){

        return $this->belongsTo('App\Models\PlanPrivilege', 'plan_privilege_id'); // links this->course_id to courses.id
    }


}
