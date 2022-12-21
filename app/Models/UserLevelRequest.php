<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserLevelRequest;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLevelRequest extends Model
{
   use SoftDeletes;
   protected $table = 'user_level_requests';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'user_id',
        'feedback_id',
        'current_role_id',
        'new_role_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

    ];    

   public function RoleName(){

        return $this->belongsTo('App\Models\Auth\Role', 'current_role_id'); // 
    }

    public function RoleNewName(){

        return $this->belongsTo('App\Models\Auth\Role', 'new_role_id'); // 
    }

}
