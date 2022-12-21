<?php

namespace App\Models;
use App\Models\State;
use App\Models\TravelReports\TravelReports;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class SameTrip extends Model
{
    protected $table = 'same_trip';

    protected $fillable = [
      'report_id',
      'status',
      'created_at',
      'updated_at',
      'deleted_at',
    ];

    /*public function reports()
    {
        return $this->hasOne(TravelReports::class,'id','same_trip_id');
    }*/

    public function report()
    {
        return $this->hasOne(TravelReports::class,'id','report_id');
    }

    public function sametrip()
    {
        return $this->hasOne(TravelReports::class,'id','same_trip_id');
    }
}
