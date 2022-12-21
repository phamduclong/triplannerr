<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Advertisement;

class AdsData extends Model
{
   use SoftDeletes;
   protected $table = 'ads_data';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'ad_id',
        'ip_address',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function ads(){
    return $this->belongsTo(Advertisement::class, 'ad_id'); 
    }

    
}
