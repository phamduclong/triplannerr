<?php

namespace App\Models;
use App\Models\State;
use App\Models\TravelReports;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;

class BookInformation extends Model
{
   protected $table = 'book_information';

   protected $fillable = [
    'report_id',
    'status',
    'created_at',
    'updated_at',
    'deleted_at',
  ];

  public function reportuser(){
    return $this->belongsTo(TravelReports::class, 'report_id'); 
  }

  public function requestuser(){
    return $this->belongsTo(User::class, 'user_id'); 
  }
}
