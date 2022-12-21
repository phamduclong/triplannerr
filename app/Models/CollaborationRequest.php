<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserDetails;
use App\Models\Auth\User;

class CollaborationRequest extends Model
{
   use SoftDeletes;
   protected $table = 'collebration_requests';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'id',
        'user_id',
        'request_id',
        'blog_service',
        'role_type',
        'message',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function userdata(){
        return $this->belongsTo(UserDetails::class, 'user_id','user_id'); 
      }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id'); 
    }
}
