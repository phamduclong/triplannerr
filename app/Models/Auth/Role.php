<?php

namespace App\Models\Auth;

use Altek\Accountant\Contracts\Recordable;
use Altek\Accountant\Recordable as RecordableTrait;
use App\Models\Auth\Traits\Method\RoleMethod;
use Spatie\Permission\Models\Role as SpatieRole;


/**
 * Class Role.
 */
class Role extends SpatieRole implements Recordable
{
    use RecordableTrait,
        RoleMethod;

        protected $table = 'roles';

        protected $fillable = [
        'name',
        'guard_name',
        'image',
        'created_at',
        'updated_at',
      
    ];
}
