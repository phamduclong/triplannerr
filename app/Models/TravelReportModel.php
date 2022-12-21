<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TravelReport;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelReportModel extends Model
{
    use SoftDeletes;
   protected $table = 'travel_reports';

   protected $data = ['deleted_at'];

   protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'report_date',
        'report_country',
        'travel_time',
        'description',
        'cover_photo',
        'lattitude',
        'longitude',
        'status',
        'travel_cost',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

     public function CategoryName(){

        return $this->belongsTo('App\Models\TravelcategoryModel', 'category_id'); // links this->course_id to courses.id
    }

   public function super_relation(){
       return $this->belongsTo(TourReportSuper::class, 'tour_id');
    }


   public function alert_relation(){
       return $this->belongsTo(TourReportAlert::class, 'tour_report_id')->where(['status'=>'1']);
    }

}
