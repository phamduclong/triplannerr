<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\TravelReport;
use App\Models\Travelcategory;
use App\Models\TourReportAlert;
use App\Models\TourReportSuper;
use App\Models\Country;
use App\Models\Auth\User;
use App\Models\TravelAction;
use App\Models\TravelReportComponent;
use App\Models\BookInformation;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelReport extends Model
{
    use SoftDeletes;
   protected $table = 'travel_reports';

   protected $data = ['deleted_at'];

   protected $fillable = [
    'user_id',
    'travel_report_name',
    'travel_report_category',
    'report_startdate',
    'report_enddate',
    'country_departure',
    'country_destination',
    'total_travel_time',
    'travel_cost',
    'extended_descriptive',
    'cover_photo_trip',
    'sentimental_situation',
    'type_of_travel',
    'type_of_accommodation',
    'vector_type',
    'type_of_participants',
    'preferred_travel_budget',
    'preferred_type',
    'travel_favoritemealtype',
    'status',
    'created_at',
    'updated_at',
    'deleted_at'
    ];

    public function CategoryName(){
        return $this->belongsTo(Travelcategory::class, 'category_id'); 
    }

    public function CountryName(){
        return $this->belongsTo(Country::class, 'country_destination'); //
    }

    public function alert_relation(){
        return $this->hasMany(TourReportAlert::class,'tour_report_id');
    }

    public function super_relation(){
        return $this->hasMany(TourReportSuper::class,'tour_id');
     }

    public function AlertData(){
        return $this->hasMany(TourReportAlert::class,'tour_report_id');
    }

    public function SuperData(){
        return $this->hasMany(TourReportSuper::class,'tour_id');
     }

    public function UserName(){
        return $this->belongsTo(User::class, 'user_id');
    }
  
    public function bookinfo()
    {
         return $this->belongsTo(BookInformation::class);
    }
    
}
