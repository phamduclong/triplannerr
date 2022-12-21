<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PlanPrivilege;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanPrivilege extends Model
{
    use SoftDeletes;
   protected $table = 'plan_privileges';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'name',
        'controller',
        'action',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    

}
