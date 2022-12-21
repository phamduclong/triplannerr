<?php
   
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\PlanFeatureId;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
   use SoftDeletes;
   protected $table = 'feedbacks';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'feedback_type',
        'feedback_id',
        'content',
        'rating_type1',
        'rating_type2',
        'rating_type3',
        'rating_type4',
        'rating_type5',
        'rating_type6',
        'rating_type7',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

   
}
