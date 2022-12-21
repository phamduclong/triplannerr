<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PlanFeatureId;

class Plan extends Model
{
    use SoftDeletes;
    protected $table = 'plans';

    protected $data = ['deleted_at'];

    protected $fillable = [
        'name',
        'description',
        'plan_type',
        'amount',
        'privilege_ids',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function plan_feature()
    {
        return $this->belongsToMany(PlanFeatureId::class, 'plan_feature_id', 'plan_id', 'feature_id');
    }

    function PrivilegeName()
    {
        return $this->belongsTo(PlanPrivilege::class, 'privilege_ids');
    }
}
