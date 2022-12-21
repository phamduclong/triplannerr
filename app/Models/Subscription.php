<?php

namespace App\Models;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class Subscription extends Model
{
   protected $table = 'subscriptions';
   
   protected $fillable = [
    'user_id',
    'plan_name',
    'plan_amount',
    'quantity',
    'invoice_id',
    'invoice_description',
    'payment_status',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
   ];

   public function getuser(){
      return $this->belongsTo(User::class, 'user_id'); 
    }
}
