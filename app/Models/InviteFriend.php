<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InviteFriend extends Model
{
   use SoftDeletes;
   protected $table = 'invite_friends';
}
