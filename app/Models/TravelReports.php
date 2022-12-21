<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TravelReportGallery;
use App\Models\Travelcategory;
use App\Models\TourReportAlert;
use App\Models\TourReportSuper;
use App\Models\Country;
use App\Models\SameTrip;
use App\Models\BookInformation;
use App\Models\TravelReportComponent;
use App\Models\TravelReportCarriers;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelReports extends Model
{
    protected $table = 'travel_reports';

    protected $fillable = [
        'user_id',
        'title',
        'category_id',
        'report_startdate',
        'report_enddate',
        'country_departure',
        'country_destination',
        'no_of_participants',
        'travel_time',
        'description',
        'cover_photo',
        'lattitude',
        'longitude',
        'accessibility',
        'report_option',
        'security_option',
        'image_audio',
        'no_of_carries',
        'currency_id',
        'slider_type',
        'slider_video',
        'slider_video_type',
        'agency_context',
        'agency_logo',
        'links',
        'total_exp',
        'identification_option',
        'local_operator',
        'tourist_facility',
        'birth_place',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'travel_cost',
        'age_of_participants',
        'role_type'
    ];

    protected $attributes = ['categories'];

    public function getCategoriesAttribute(){
        $cats = [];
        $categories = explode(',', $this->category_id);
        if(!empty($categories)){
            $cats = Travelcategory::select('id', 'name')->whereIn('id', $categories)->pluck('name', 'id')-> toArray();
        }
        return $cats;
    }

    public function image_gallery(){
        return $this->hasMany(TravelReportGallery::class,'travel_report_id');
    }

    public function category(){
        return $this->belongsTo(Travelcategory::class, 'category_id'); 
    }

    public function userdata()
    {
       return $this->belongsTo('App\Models\Auth\User', 'user_id');
    }

    public function report_carrierrs(){
        return $this->hasMany(TravelReportCarriers::class,'travel_report_id');
    }

    public function report_components(){
        return $this->hasMany(TravelReportComponent::class,'travel_report_id');
    }

    public function supers()
    {
        return $this->hasMany(TravelAction::class,'report_id')->where('action', 'super');
    }

    public function alerts()
    {
        return $this->hasMany(TravelAction::class,'report_id')->where('action', 'alert');
    }

    public function tripdata()
    {
        return $this->belongsTo(SameTrip::class,'same_trip_id');
    }   

    public function dep_country()
    {
        return $this->belongsTo(Country::class, 'country_departure'); 
    }  

    public function des_country()
    {
        return $this->belongsTo(Country::class, 'country_destination');
    }

    public function bookinfo()
    {
        return $this->belongsTo(BookInformation::class,'report_id');
    }

    public function gallery(){
        return $this->hasMany(TravelReportGallery::class, 'travel_report_id');
    }


} 
