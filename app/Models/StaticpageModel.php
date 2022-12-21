<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StaticpageModel extends Model
{
	use SoftDeletes;
    protected $table = 'static_pages';
    
}
