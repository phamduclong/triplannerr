<?php

namespace App\Models\TravelReports;

use Illuminate\Database\Eloquent\Model;
use App\Models\TravelReportGallery;
use App\Models\Travelcategory;
use App\Models\TourReportAlert;
use App\Models\TourReportSuper;
use App\Models\Country;
use App\Models\TravelReportComponent;
use App\Models\TravelReportCarriers;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TravelAction;
use App\Models\Currency;
use App\Models\TravelReportSlideshow;
use App\Models\TravelProType;
use App\Models\TravelReportReserved;
use App\Models\TourReportShare;
use App\Models\TourReportFollowers;
use App\Models\UserParticipate;

class TravelReports extends Model
{
   protected $table = 'travel_reports';

   protected $fillable = [
        'user_id',
        'title',
        'slug',
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
        'sentimental_situation',
        'type_of_travel',
        'type_of_accommodation',
        'vector_type',
        'type_of_participants',
        'preferred_travel_budget',
        'preferred_type',
        'travel_favoritemealtype',
        'identification_option',
        'local_operator',
        'tourist_facility',
        'birth_place',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'travel_cost',
        'travel_offer',
        'travel_pro',
        'age_of_participants',
        'role_type',
        'number_want_join',
        'account_status',
        'number_want_infomation'
    ];

    protected $appends = ['categories', 'destinations'];

    public function getCategoriesAttribute(){
        $cats = [];
        $categories = explode(',', $this->category_id);
        if(!empty($categories)){
            $cats = Travelcategory::select('id', 'name')->whereIn('id', $categories)->pluck('name', 'id')-> toArray();
        }
        return $cats;
    }

    public function getDestinationsAttribute(){
        $destinations = [];
        $countries = explode(',', $this->country_destination);
        if(!empty($countries)){
            $destinations = Country::select('id', 'name')->whereIn('id', $countries)->pluck('name', 'id')->toArray();
        }
        return $destinations;
    }

    public function image_gallery(){
        return $this->hasMany(TravelReportGallery::class,'travel_report_id');
    }

    public function currency(){
        return $this->belongsTo(Currency::class, 'currency_id');
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
        return $this->hasMany(TravelAction::class,'report_id')->where(['action'=>'super', 'action_status'=>1]);
    }

    public function alerts()
    {
        return $this->hasMany(TravelAction::class,'report_id')->where(['action'=> 'alert', 'action_status'=>1]);
    }

    public function sametrip()
    {
        return $this->hasMany(TravelAction::class,'report_id')->where(['action'=> 'same trip page', 'action_status'=>1]);
    }

    public function gallery(){
        return $this->hasMany(TravelReportGallery::class, 'travel_report_id')->orderby('image_sorting','asc');
    }


    public function components(){
        return $this->hasMany(TravelReportComponent::class, 'travel_report_id');
    }

    public function slideshow(){

    }

     public function fbshare(){
        return $this->hasMany(TourReportShare::class, 'tour_report_id')->where('plateform', 'Facebook');
    }

    public function twshare(){
        return $this->hasMany(TourReportShare::class, 'tour_report_id')->where('plateform', 'Twitter');
    }

     public function follow(){
        return $this->hasMany(TourReportFollowers::class, 'tour_report_id');
    }

    public function report_offers(){
        return $this->hasMany(TravelProType::class, 'travel_report_id');
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


    public function reserved_users(){
        return $this->hasMany(TravelReportReserved::class, 'report_id');
    }

    public function participates(){
        return $this->hasMany(UserParticipate::class, 'report_id');
    }
}
