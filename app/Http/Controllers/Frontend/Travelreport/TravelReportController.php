<?php
namespace App\Http\Controllers\Frontend\Travelreport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Mail;
use DB;
use App\Models\Auth\Role;
use App\Models\SameTrip;
use App\Models\Country;
use App\Models\Auth\User;
use App\Models\BookInformation;
use App\Models\Travelcategory;
use App\Models\TourCarrier;
use App\Models\TravelReportCarriers;
use App\Models\TravelReportComponent;
use App\Models\TravelReportSlideshow;
use App\Models\TravelReportGallery;
use App\Models\TravelReport;
use App\Models\TravelReports\TravelReports;
use App\Models\TourReportSuper;
use App\Models\TourReportAlert;
use App\Models\TourReportFollower;
use App\Models\Currency;
use App\Models\AgencyOption;
use App\Models\LocalOperator;
use App\Models\TouristFacility;
use App\Models\UserDetails;
use App\Models\TravelProType;
use App\Models\TripBooking;
use App\Models\TravelVector;
use App\Models\ReportContent;
use App\Models\SliderAudio;
use App\Models\EmailDetails;
use App\Models\TravelFavoriteMealsType;
use App\Models\TravelFavoriteMealsCat;
use Illuminate\Support\Facades\Crypt;
use App\Models\TravelReportFavMeal;
use App\Models\TravelReportReserved;
use Image;
use App\Models\TravelTypes;
use App\Http\Requests\Frontend\TravelReport\TravelReportRequest;
use App\Models\Advertisement;
use App\Models\TravelSituation;
use App\Models\TravelAccommodation;
use App\Models\TravelParticipate;
use App\Models\TravelBudget;
use App\Models\TravelFormula;
use App\Models\UserParticipate;

use App\Jobs\SendMailCreateTravelReport;
use App\Models\InviteFriend;
use Carbon\Carbon;
use SendinBlue;
use GuzzleHttp;
use SendinBlue\Client;
use Illuminate\Support\Facades\Log;

class TravelReportController extends Controller
{
    public function create(Request $request)
    {
        $country_arr = $this->getcountry();
        $travelcateg_arr = $this->gettravelcateg();
        $travelpro_arr = $this->gettravelproname();
        //dd($travelpro_arr);
        $carrierg_arr=TravelVector::select('name', 'id')->where(['parent_id' => 0])->pluck('name', 'id')->toArray();
        $slide_data=SliderAudio::select('slide_audio', 'id')->orderby('id', 'desc')->pluck('slide_audio', 'slide_audio')
           ->toArray();
           //dd($slide_data);
        $user_id=Auth::user()->id;
        $user_email=Auth::user()->email;

        $reportdata= TravelReports::where('user_id',$user_id)->first();
        $userdata= UserDetails::where('user_id',$user_id)->first();
        $role_type=Auth::user()->role_type;
        $roledata=Role::where('name',$role_type)->first();
        $currency_arr = Currency::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_pro = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')->where([['role_type', 'travel_agency'], ['security_user', null]])->orderBy('display_name')->pluck('display_name', 'id');
        // print_r($travel_pro);
        // exit();

        $agency_option=AgencyOption::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
            // print_r($agency_option);
            // exit();
        $local_operator=LocalOperator::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
        $tourist_facility=TouristFacility::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
        $travel_situation=TravelSituation::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
        $travel_type=TravelTypes::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
        $travel_accommodation=TravelAccommodation::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
        $travel_vector=TravelVector::select('name', 'name')->where('parent_id',1)
                      ->pluck('name', 'name')
                      ->toArray();
        $travel_participate=TravelParticipate::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
        $travel_budget=TravelBudget::select('name', 'name')
                       ->pluck('name', 'name')
                       ->toArray();
        $travel_formula=TravelFormula::select('name', 'name')
                       ->pluck('name', 'name')
                       ->toArray();
        $travel_favoritemealtype=TravelVector::select('name', 'name')->where('parent_id','!=','0')->where('vector_type','meals')
                       ->pluck('name', 'name')
                       ->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'name')->toArray();

        return view('frontend.travel_report.create',compact('slide_data','roledata','userdata','country_arr','travelcateg_arr','carrierg_arr', 'currency_arr','agency_option','local_operator','tourist_facility', 'reportdata', 'travel_situation', 'travel_type', 'travel_accommodation', 'travel_vector', 'travel_participate', 'travel_budget', 'travel_formula', 'travel_favoritemealtype', 'travel_ages', 'travel_pro', 'travelpro_arr'));
    }


    public function getcountry()
    {
        $country= Country::where(['is_active'=>'1'])->orderby('name', 'asc')->pluck('name', 'id')->toArray();
        return ($country)?$country:"";
    }


    public function gettravelproname()
    {
        $travelpro_arr[] = 'Select Pro';
        $travel_pro= User::where('role_type', 'travel_agency')->orderby('user_name','asc')->pluck('user_name', 'user_name')->toArray();
        return ($travel_pro)?$travel_pro:"";
    }

    public function gettravelcateg()
    {
        $travelcateg_arr[] = 'Select Category';
        $travel_categ= Travelcategory::where(['status'=>'1'])->orderby('name','asc')->pluck('name', 'id')->toArray();
        return ($travel_categ)?$travel_categ:"";
    }


    public function getcarrier()
    {
        $carrier_categ= TourCarrier::where(['status'=>'1'])->orderby('id','asc')->pluck('title', 'id')->toArray();
        return ($carrier_categ)?$carrier_categ:"";
    }

    function dateDiffInDays($date1, $date2)
    {
        $diff = strtotime($date2) - strtotime($date1);
        return abs(round($diff / 86400));
    }

    public function store($id = null, Request $request) {

        // print_r($request->all());
        // exit(0);

        // $validated = $request->validate([
        //     'title' => 'required|string',
        // ]);

        $form_data = $request->all();

        $title = !empty($form_data['travel_report_name'])?$form_data['travel_report_name']:'';

        $report_data = [
            'user_id' => Auth::User()->id,
            'title' => $title,
            'slug' => convertoToSlug($title),
            'category_id' => !empty($form_data['travel_report_category']) ? implode(',', $form_data['travel_report_category']) : '',
            'report_startdate' => date('Y-m-d',strtotime($form_data['trip_start'])),
            'report_enddate' => date('Y-m-d',strtotime($form_data['trip_end'])),
            'country_departure' => $form_data['country_departure'],
            'country_destination' => !empty($form_data['country_destination']) ? implode(',', $form_data['country_destination']) : '',
            'no_of_participants' => $form_data['no_of_participants'],
            'travel_time' => $this->dateDiffInDays($form_data['trip_start'], $form_data['trip_end']),
            // 'description' => strip_tags($form_data['report_description']),
            'description' => $form_data['report_description'],
            'security_option' => $form_data['security_option'],
            'image_audio' => $form_data['image_audio'],
            'no_of_carries' => count($form_data['component_name']),
            'currency_id' => $form_data['currency_id'],
            'slider_type' => $form_data['slider_type'],
            'slider_video_type' => $form_data['slider_video_type'],
            'status'    => 1,
            'travel_cost'   => array_sum($form_data['individual_cost']),
            'report_option' => isset($request->report_option)?$request->report_option:'report',
            'agency_context' => isset($request->agency_context)?$request->agency_context:'',
            'travel_offer' => isset($request->offer)?$request->offer:0,
            'sentimental_situation' => '', //$form_data['sentimental_situation'],
            'type_of_travel' => !empty($form_data['type_of_travel'])?$form_data['type_of_travel']:'',
            'type_of_accommodation' => !empty($form_data['type_of_accommodation'])?$form_data['type_of_accommodation']:'',
            'vector_type' => !empty($form_data['vector_type'])?$form_data['vector_type']:'',
            //'birth_place' => 20, //isset($form_data['birth_place'])?$form_data['birth_place']: 0, // date('Y-m-d',strtotime($form_data['birth_place'])),
            'birth_place' => !empty($form_data['birth_place'])?$form_data['birth_place']:1,
            'type_of_participants' => !empty($form_data['type_of_participants'])?$form_data['type_of_participants']:'',
            'preferred_travel_budget' => !empty($form_data['preferred_travel_budget'])?$form_data['preferred_travel_budget']:'',
            'preferred_type' => !empty($form_data['preferred_type'])?$form_data['preferred_type']:'',
            'travel_favoritemealtype' => !empty($form_data['type_of_fav_meals'])?$form_data['type_of_fav_meals']:'',
            'local_operator' => !empty($form_data['local_operator'])?$form_data['local_operator']:'',
            'tourist_facility' => !empty($form_data['tourist_facility'])?$form_data['tourist_facility']:'',
            'identification_option' => !empty($form_data['identification_option'])?$form_data['identification_option']:'',
            'role_type' => Auth::user()->role_type,
            'account_status' => 'normally',
            // 'travel_pro' => !empty($form_data['travel_pro']) ? implode(',', $form_data['travel_pro']) : '',
            //'travel_pro' => !empty($form_data['travel_pro'])?$form_data['travel_pro']:'',

             $videofile = $request->file('slider_video'), //get the file
             $checkvideofile = $request->hasFile('slider_video'),
             $videoPath = public_path('/video/frontend/travel_report/slidervideo'),
        ];
        //dd($report_data);

         if(!empty($form_data['slider_video_type'] == 'image')){
                 $report_data['slider_video'] = $this->UploadFileConfigVideo($videoPath, $checkvideofile, $videofile);
             }else{

                 $report_data['slider_video'] = !empty($form_data['slider_video'])?$form_data['slider_video']:'';
             }


            if($report_data['slider_video_type'] == 'link' ){
                if(!empty($report_data['slider_video'])){

                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $request->slider_video, $matches);

                $videoId =  !empty($matches[1])?$matches[1]:0;
                   $url = explode('?v=', $videoId);

                   $report_data['slider_video'] = end($url);
                   //dd($report_data['slider_video']);
                }
          }

       //dd($report_data['slider_video']);

        if(isset($form_data['cover_photo_trip']) && !empty($form_data['cover_photo_trip']))
        {
            $filename = $request->file('cover_photo_trip');
            $checkfile = $request->hasFile('cover_photo_trip');
            $destinationPath = public_path('/img/frontend/travel_report/coverphoto');
            $report_data['cover_photo'] = $this->UploadFileConfig($destinationPath, $checkfile, $filename);

        }

        if(isset($form_data['agency_logo']) && !empty($form_data['agency_logo'])){
            $agency_logo = $request->file('agency_logo');
            $logofile = $request->hasFile('agency_logo');
            $logoPath = public_path('/img/frontend/travel_report/agency_logo');
            $report_data['agency_logo'] = $this->UploadFileConfig($logoPath, $logofile, $agency_logo);
        }

        if(isset($form_data['links']) && !empty($form_data['links']))
        {
            $social_links=implode(',',$form_data['links']);
            $report_data['links']=isset($social_links)?$social_links:'';
        }


        if($travel_report = TravelReports::create($report_data)){
            $travel_report_id = $travel_report->id;

            if(isset($form_data['gallery_photo']) && !empty($form_data['gallery_photo']) && count($form_data['gallery_photo']) > 0 )
            {
                $galleryimgname = $request->file('gallery_photo');
                $checkgalleryimg = $request->hasFile('gallery_photo');

                $galleryimgcrop = $form_data['crop_photo'];
                //dd($galleryimgcrop);


                $this->travel_report_gallery_save($galleryimgname, $checkgalleryimg, $form_data['gallery_caption'], $form_data['location_of_shot'],  $form_data['sorting_in_gallery'], $form_data['image_lat'],$form_data['image_long'], $galleryimgcrop, $travel_report_id);
            }

            if(isset($form_data['component_name']) && !empty($form_data['component_name']) && count($form_data['component_name']) > 0 ){
                $travelProName = isset($form_data['travel_pro_name']) ? $form_data['travel_pro_name'] : [];
                $this->travel_report_component_save($form_data['component_name'], $form_data['sub_component_name'], $form_data['individual_cost'], $form_data['no_of_participants'], $form_data['travel_pro'], $travelProName, $travel_report_id);
            }


            if(isset($form_data['operator']) && !empty($form_data['operator']) && !empty($form_data['operator_cost']) ){
                $this->travel_report_pro_operator_save($form_data['operator'], $form_data['operator_cost'], $travel_report_id);
            }

            // if(isset($form_data['user_id_checked'])){
            //     $this->travel_report_reversed_save($form_data['user_id_checked'], $travel_report_id);
            // }
            if(isset($form_data['user_id_checked'][0])){
                // $this->travel_report_reversed_save($form_data['user_id_checked'], $travel_report_id);
                $travelReportReversed = new TravelReportReserved();
                $travelReportReversed->user_id = $form_data['user_id_checked'][0];
                $travelReportReversed->report_id = $travel_report_id;
                $travelReportReversed->save();
            }

            $usermail=array('email'=>Auth::user()->email,'user_name'=>Auth::user()->user_name);
            $username = Auth::user()->user_name;

            //    Mail::send('frontend.mail.create-report', ['user_name' => $username], function ($m) use ($usermail) {
            //     $m->from('hello@app.com', 'Travel Maker');

            //     $m->to($usermail['email'])->subject('Create Report');
            // });
            $job = new SendMailCreateTravelReport($username, $usermail);
            dispatch($job);

            return redirect('view/travel_report/'.$travel_report->slug)->withFlashSuccess(__('Travel report has been created successfully'));
            //return redirect('view/control-panel')->withFlashSuccess(__('Travel report has been created successfully'));
        }

        else{
            return redirect()->back()->withFlashWarning(__('There is some technical problem in creating your report'));
        }


        /*$data = new TravelReports();
        $user_id = Auth::User('id');
        $data->user_id = $user_id->id;

        $data->title = $request->travel_report_name;
        $data->category_id = $request->travel_report_category;

        $data->report_startdate = date('Y-m-d', strtotime($request->trip_start));
        $data->report_enddate = date('Y-m-d', strtotime($request->trip_end));
        $data->country_departure = $request->country_departure;
        $data->country_destination = $request->country_destination;
        $data->no_of_participants = $request->no_of_participants;
        $data->travel_time = $request->total_travel_time;
        $data->agency_context = $request->agency_context;
        $data->travel_cost = $request->total_cost_of_trip;
        $data->description = $request->description;
        $data->report_option = isset($request->report_option)?$request->report_option:'report';
        $data->no_of_carries= $request->no_of_carries;
        $data->security_option= $request->security_option;
        $data->currency_id= $request->currency_id;
        $data->image_audio= $request->image_audio;
        $data->slider_type = isset($request->slider_type)?$request->slider_type:'transitions';
        $data->status = '0';

        $videofile = $request->file('slider_video'); //get the file
        $checkvideofile = $request->hasFile('slider_video');
        $videoPath = public_path('/video/frontend/travel_report/slidervideo');
        $data->slider_video = $this->UploadFileConfig($videoPath, $checkvideofile, $videofile);

        $filename = $request->file('cover_photo_trip'); //get the file
        $checkfile = $request->hasFile('cover_photo_trip');
        $destinationPath = public_path('/img/frontend/travel_report/coverphoto');
        $data->cover_photo = $this->UploadFileConfig($destinationPath, $checkfile, $filename);

        $agency_logo = $request->file('agency_logo'); //get the file
        $logofile = $request->hasFile('agency_logo');
        $logoPath = public_path('/img/frontend/travel_report/agency_logo');
        $data->agency_logo = $this->UploadFileConfig($logoPath, $logofile, $agency_logo);

        // $data->touristic_operator = $request->touristic_operator;
        // $data->check_in = $request->check_in;
        // $data->check_out  = $request->check_out;
        // $data->contacts = $request->contact;
        // $data->notes = $request->notes;


        if(isset($request->links) && !empty($request->links))
        {
            $social_links=implode(',',$request->links);
            $data->links=isset($social_links)?$social_links:'';
        }

        $data->save();

        $this->basic_email($user_id->email, $user_id->user_name);

        $this->travel_report_component_save($request->component_name, $request->individual_cost, $request->total_cost, $data->id);

        $this->travel_fav_meal_cost($request->travel_fav_meal, $request->individual_meal_cost, $request->total_meal_cost, $data->id);

        $this->travel_report_pro_offer_save($request->offer, $request->offer_cost, $data->id);

        $this->travel_report_pro_operator_save($request->operator, $request->operator_cost, $data->id);

        $this->travel_report_pro_facility_save($request->facility, $request->facility_cost, $data->id);

        $galleryimgname = $request->file('gallery_photo'); //get the file
        $checkgalleryimg = $request->hasFile('gallery_photo');

        $this->travel_report_gallery_save($galleryimgname, $checkgalleryimg, $request->gallery_caption, $request->location_of_shot,  $request->sorting_in_gallery, $request->image_lat,$request->image_long,$data->id);

        $slidename = $request->file('slideshow_with_audio'); //get the file
        $checkslide = $request->hasFile('slideshow_with_audio');
        $this->travel_report_slideshow_save($slidename, $checkslide, $data->id);

        return redirect()->route('frontend.user.control_panel')->withFlashSuccess(__('alerts.backend.tour.created'));*/
    }


    public function travel_report_reversed_save($user_id_checked, $lastinsertId ){

        if($user_id_checked){
            foreach ($user_id_checked as  $value) {
                $mulltipleReservedArr = array(
                    'report_id' => $lastinsertId,
                    'user_id' => $value,
                );

                 //echo "<pre>";print_r($mulltipleReservedArr); die;
              TravelReportReserved::insert($mulltipleReservedArr);

            }
        }
    }

    public function travel_report_carrier_save($carrier_name, $lastinsertId){
        if($carrier_name)
        {
            foreach($carrier_name as $carrier_name_value)
            {
                $mulltipleArr = array(
                   'travel_report_id' => $lastinsertId,
                   'carrier_name' => $carrier_name_value,
                   'status' =>'1'
                );

                TravelReportCarriers::insert($mulltipleArr);
            }
         }
    }

    public function travel_report_component_save($component_name, $sub_component_name, $individual_cost, $participents, $travel_pro, $travel_pro_name, $lastinsertId){
        if($component_name && $individual_cost && $participents)
        {
            foreach($component_name as $key=>$component_name_value)
            {
                $sub_component_id = 0;
                if(!empty($sub_component_name[$key]) && is_numeric($sub_component_name[$key])){
                    $sub_component_id = $sub_component_name[$key];
                }
                /*else if(empty($sub_component_name[$key])){
                    $sub_component_id = $component_name_value;
                }
                else{
                    $sub_component_id = $sub_component_name[$key];
                }*/


                $mulltipleArr_comp = array(
                   'travel_report_id' => $lastinsertId,
                   'component_name' => $component_name_value,
                   'sub_component_id' => $sub_component_id,
                   'individual_cost' => $individual_cost[$key],
                   'total_cost' => $individual_cost[$key] * $participents,
                   'status' =>'1',
                   'travel_pro' => isset($travel_pro[$key]) && !empty($travel_pro[$key]) ? $travel_pro[$key] : null,
                   'travel_pro_name' => isset($travel_pro_name[$key]) && !empty($travel_pro_name[$key]) ? $travel_pro_name[$key][0] : null

                );
                TravelReportComponent::insert($mulltipleArr_comp);
            }
         }

    }

    public function travel_fav_meal_cost($travel_fav_meal, $individual_meal_cost, $total_meal_cost, $lastinsertId){

        if($travel_fav_meal && $individual_meal_cost && $total_meal_cost)
        {
            foreach($travel_fav_meal as $key=>$fav_meal_name_value)
            {
                $mulltipleArr_cost = array(
                   'travel_report_id' => $lastinsertId,
                   'travel_fav_meal' => $fav_meal_name_value,
                   'individual_cost' => $individual_meal_cost[$key],
                   'total_cost' => $total_meal_cost[$key],
                   'status' =>'1'
                );

                TravelReportFavMeal::insert($mulltipleArr_cost);
            }
         }
    }


    public function travel_report_pro_offer_save($offer, $offer_cost, $lastinsertId){
        if($offer && $offer_cost)
        {
            foreach($offer as $key=>$offer_name)
            {
                $mulltipleArr_comp = array(
                   'travel_report_id' => $lastinsertId,
                   'offer' => $offer_name,
                   'offer_cost' => $offer_cost[$key],
                   'status' =>'1'
                );

                TravelProType::insert($mulltipleArr_comp);
            }
        }
    }

         //Add travel report pro operator
    public function travel_report_pro_operator_save($operator, $operator_cost, $lastinsertId){
        if($operator && $operator_cost)
        {
            foreach($operator as $key=>$operator_name)
            {

                $mulltipleArr_comp = array(
                    'travel_report_id' => $lastinsertId,
                    'operator' => $operator_name,
                    'operator_cost' => $operator_cost[$key],
                    'status' =>'1'
                );

                TravelProType::insert($mulltipleArr_comp);
            }
        }
    }


    public function travel_report_pro_facility_save($facility, $facility_cost, $lastinsertId){
        if($facility && $facility_cost)
        {
            foreach($facility as $key=>$facility_name)
            {
                $mulltipleArr_comp = array(
                   'travel_report_id' => $lastinsertId,
                   'facility' => $facility_name,
                   'facility_cost' => $facility_cost[$key],
                   'status' =>'1'
                );
                TravelProType::insert($mulltipleArr_comp);
            }
         }

    }


    public function travel_report_gallery_save($galleryimgname, $checkgalleryimg, $gallery_caption, $location_of_shot,  $sorting_in_gallery,$image_lat,$image_long, $galleryimgcrop, $lastinsertId){

        if($checkgalleryimg)
        {

            $cropImagePath = public_path().'/crop_images/';

            foreach($galleryimgname as $key=>$gallery_row)
            {

                $publicpath = (public_path().'/img/frontend/travel_report/gallery/');

                $image = $this->UploadFileConfig($publicpath, $checkgalleryimg, $gallery_row);


                $mulltiplegalleryArr = array(
                    'travel_report_id' => $lastinsertId,
                    'gallery_image' => $image,
                    'image_caption' => $gallery_caption[$key],
                    'image_location' => !empty($location_of_shot[$key])?$location_of_shot[$key]:'',
                    'image_sorting' => $sorting_in_gallery[$key],
                    'image_lat' => $image_lat[$key],
                    'image_long' => $image_long[$key],
                    'status' => '1'
                );


                if(!empty($galleryimgcrop[$key]) && file_exists($cropImagePath.$galleryimgcrop[$key])){
                        if(rename($cropImagePath.$galleryimgcrop[$key], $cropImagePath.$image)){
                            @unlink($cropImagePath.$galleryimgcrop[$key]);
                        }
                    }

                    TravelReportGallery::insert($mulltiplegalleryArr);
                }
         }

    }

    public function imageResize($imageSrc,$imageWidth,$imageHeight){

    $newImageWidth =20; //set new image width
    $newImageHeight =20; //set new image height

    //new image layer
    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);


    //image copy resampled
    imagecopyresampled($newImageLayer, $imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
  }


    public function travel_report_slideshow_save($slidename, $checkslide, $lastinsertId){
        if($checkslide)
        {
            foreach($slidename as $slide_row)
            {
                $publicpath = (public_path().'/img/frontend/travel_report/slideshow');
                $new_image = $this->UploadFileConfig($publicpath, $checkslide, $slide_row);
                $mulltipleslideArr = array(
                   'travel_report_id' => $lastinsertId,
                   'slide_name' => $new_image,
                   'status' => '1'
                );
                TravelReportSlideshow::insert($mulltipleslideArr);
            }
        }
    }

    //move file uplaod configration
    // public function UploadFileConfig($publicpath, $checkfile, $filename){
    //     if ($checkfile) {
    //         $image = $filename;
    //         $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
    //         $image = Image::make($image->getRealPath());
    //         $image->resize(1350, 350, function ($constraint) {
    //             $constraint->aspectRatio(floor(1350/350));
    //         })->save($publicpath.'/'.$img_name);
    //     }
    //     return  isset($img_name)?$img_name:'';
    // }

    public function UploadFileConfig($publicpath, $checkfile, $filename){

        if ($checkfile) {
            //get the file
            $image = $filename;
            //get
            $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
            //public path
            $destinationPath = $publicpath;
            //mve to destination you mentioned
            $image->move($destinationPath, $img_name);
        }
            return  isset($img_name)?$img_name:'';
    }

    public function UploadFileConfigVideo($videoPath, $checkvideofile, $videofile){
        if ($checkvideofile) {
            $image = $videofile;
            $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
            $destinationPath = $videoPath;
            $image->move($destinationPath, $img_name);
        }
        return isset($img_name)?$img_name:'';
    }


     //update travel report component
    public function travel_report_component_update($component_name, $individual_cost, $total_cost, $travel_pro, $lastinsertId){
        if($component_name)
        {
            TravelReportComponent::where('travel_report_id',$lastinsertId)->delete();
            if($component_name && $individual_cost && $total_cost)
            {
                foreach($component_name as $key=>$component_name_value)
                {
                   // dd($mulltipleArr_comp);
                    $mulltipleArr_comp = array(
                        'travel_report_id' => $lastinsertId,
                        'component_name' => $component_name_value,
                        'individual_cost' => $individual_cost[$key],
                        'total_cost' => $total_cost[$key],
                        'status' =>'1',
                        'travel_pro' => $travel_pro[$key]
                    );
                    TravelReportComponent::insert($mulltipleArr_comp);
                }
            }
        }
    }

 //Update travel report Gallery
    public function travel_report_gallery_update($galleryimgname, $checkgalleryimg, $gallery_caption, $location_of_shot,  $sorting_in_gallery, $id){

        if($checkgalleryimg)
        {

            foreach($galleryimgname as $key=>$gallery_row)
            {
                $publicpath = (public_path().'/img/frontend/travel_report/gallery/');
                $new_gallery_image = $this->UploadFileConfig($publicpath, $checkgalleryimg, $gallery_row);

                $mulltiplegalleryArr = array(
                  'travel_report_id' => $id,
                   'gallery_image' => $new_gallery_image,
                   'image_caption' => $gallery_caption[$key],
                   'image_location' => !empty($location_of_shot[$key])?$location_of_shot[$key]:'',
                   'image_sorting' => $sorting_in_gallery[$key],
                   'status' => '1'
                );
               TravelReportGallery::where('id',$id)->delete();
                TravelReportGallery::insert($mulltiplegalleryArr);
            }
         }

    }

    public function travel_report_slideshow_update($slidename, $checkslide, $slidertype, $lastinsertId)
    {
        if($checkslide)
        {
            TravelReportSlideshow::where('travel_report_id',$lastinsertId)->delete();

            foreach($slidename as $slide_row)
            {

                $publicpath = (public_path().'/img/frontend/travel_report/slideshow');

                $new_image = $this->UploadFileConfigVideo($publicpath, $checkslide, $slide_row);

                $mulltipleslideArr = array(
                    'travel_report_id' => $lastinsertId,
                    'slide_name' => $new_image,
                    'slider_type' => $slidertype,
                    'status' => '1'
                );

                TravelReportSlideshow::insert($mulltipleslideArr);
            }
        }
    }

    public function basic_email($email, $user_name){
        $data = array('name'=>$user_name,'email'=>$email);
        $email_address = array('admin_email'=>'test@mailinator.com', 'user_email'=>$email,'main_user_name'=>$user_name);

        Mail::send(['text'=>'frontend.mail.create-report'], $data, function($message) use($email_address) {

            $message->to($email_address['admin_email'], 'Traveler Maker')->subject('Create Report');
           //dd($email_address['admin_email']);

        });
    }


    public function view($id = null,Request $request){

        // $report_id=$request->slug;
        // $report_id=encrypt_decrypt('decrypt', $report_id);
        $user_id=isset(Auth::user()->id)?Auth::user()->id:'';

        $travel_report = TravelReports::withCount('supers', 'alerts', 'report_components')->with('image_gallery', 'userdata', 'report_components')->where('slug', $request->slug)->first();

        if($travel_report->account_status == 'cancel' || $travel_report->account_status == 'pending'){
            return "Page Not Found";
        }


        $cover= UserDetails::where('user_id',$travel_report->user_id)->select('cover_image')->first();
        if(Auth::check()){
            $userdata= UserDetails::where('user_id',$user_id)->first();
        }else{
            $userdata= UserDetails::where('user_id',$travel_report->user_id)->first();
        }
        
        $role_type = $travel_report->userdata->role_type;
        $roledata=Role::where('name',$role_type)->first();

        $categories = !empty($travel_report->category_id)?explode(',', $travel_report->category_id):'';

        $country_ids = $travel_report->country_departure;

        if(!empty($categories) && !empty($country_ids) && !empty($userdata->preferred_travel_budget)) {
                $vector=!empty($userdata->vector_type)?explode(',', $userdata->vector_type):'';
                //dd($vector);
                $acco=!empty($userdata->type_of_accommodation)?explode(',', $userdata->type_of_accommodation):'';
                //dd($acco);
                $participant=!empty($userdata->type_of_participants)?explode(',', $userdata->type_of_participants):'';
                 //dd($participant);
                $favorite=!empty($userdata->travel_favoritemealtype)?explode(',', $userdata->travel_favoritemealtype):'';

                $adsCond=['status'=>1,'budget'=>$userdata->preferred_travel_budget];

                $ads_data = Advertisement::orderby('id','desc')->where($adsCond);
                //dd($ads_data);

                if(!empty($userdata->type_of_travel)) {
                    $ads_data->orWhere('travel_type',$userdata->type_of_travel);
                }

                if(!empty($userdata->preferred_type)) {
                    $adsCond['preffered_stay_formula']=$userdata->preferred_type;

                }
                if(!empty($categories)) {
                    $ads_data->orWhere('category_id',$categories);
                }
                if(!empty($country_ids)) {
                    $ads_data->orWhere('country_departure',$country_ids);
                }
                if(!empty($vector)) {
                    $ads_data->orWhere('vector_type',$vector);
                }
                if(!empty($participant)) {
                    $ads_data->orWhere('type_of_participant',$participant);
                }
                if(!empty($acco)) {
                    $ads_data->orWhere('type_of_accomodation',$acco);
                }
                if(!empty($favorite)) {
                    $ads_data->orWhere('type_of_fav_meal',$favorite);
                }
                $ads_data=$ads_data->get();

            } else {
                $ads_data='';
            }
            $arrKeyTravelPro = [];
            foreach($travel_report->report_components as $value){
                array_push($arrKeyTravelPro, $value->travel_pro);
            }
            $travel_PRO = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')
                                ->where('role_type', 'travel_agency')
                                ->whereIn('id',$arrKeyTravelPro)
                                ->orderBy('display_name')->pluck('display_name', 'id');

            $travel_PRO_LINK = User::select(DB::raw("CONCAT('profile', '/', role_type, '/', LOWER(first_name), LOWER(last_name), '/', id) AS link_travel_pro"), 'id')
                                ->where('role_type', 'travel_agency')
                                ->whereIn('id',$arrKeyTravelPro)
                                ->orderBy('link_travel_pro')->pluck('link_travel_pro', 'id');

            $security_user = User::select('security_user', 'id')->where('role_type', 'travel_agency')->whereIn('id',$arrKeyTravelPro)->orderBy('security_user')->pluck('security_user', 'id');

            foreach($travel_report->report_components as $value){
                foreach($travel_PRO_LINK as $key => $val){
                    if($value->travel_pro == $key){
                        $value->link_travel_pro = $val;
                    }
                }
            }
            foreach($travel_report->report_components as $value){
                foreach($security_user as $key => $val){
                    if($value->travel_pro == $key){
                        $value->security_user = $val;
                    }
                }
            }
            foreach($travel_report->report_components as $value){
                foreach($travel_PRO as $key => $val){
                    if($value->travel_pro == $key){
                        $value->travel_pro = $val;
                    }
                }
            }



        $country_arr = $this->getcountry();
        return view('frontend.travel_report.view',compact('cover','roledata', 'travel_report', 'userdata', 'ads_data', 'role_type', 'country_arr'));
    }


    public function check_report_title(Request $request)  {
        $check_report = 0;
        $form_data = $request->all();
        $title=$form_data['title'];
        $vector_id=!empty($form_data['vector_id'])?$form_data['vector_id']:0;
        $exist=TravelReports::select('id', 'title')->where(['title'=> $title])->where('id', '<>',  $vector_id )->pluck('id')->first();
        if($exist) {
            $check_report = 1;
        }
        return $check_report;
    }

    // modifica travel report da control panel
    public function edit($slug = null,Request $request){

        $user_id    = Auth::user()->id;
        $role_type  = Auth::user()->role_type;
        $roledata   = Role::where('name', $role_type)->first();

        if(!empty($slug)){
            $report = TravelReports::with('gallery', 'components', 'report_offers')->where(['slug'=> $slug])->first();
            $id = $report->id;
            if(!empty($report)){
                $travelcateg_arr = $this->gettravelcateg();
                $travelpro_arr = $this->gettravelproname();

                $carrierg_arr=TravelVector::select('name', 'id')->where(['parent_id' => 0])->pluck('name', 'id')->toArray();

                $slide_data=SliderAudio::select('slide_audio', 'id')->orderby('id', 'desc')->pluck('slide_audio', 'slide_audio')->toArray();

                // $travel_pro = User::select('user_name', 'user_name')->where('role_type', 'travel_agency')->pluck('user_name', 'user_name')->toArray();
                $travel_pro = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')->where('role_type', 'travel_agency')->orderBy('display_name')->pluck('display_name', 'id');

                $country_arr = $this->getcountry();
                $currency_arr = Currency::orderby('name','asc')->select('name', 'id')->pluck('name', 'id')->toArray();
                $agency_option=AgencyOption::select('name', 'id')
                      ->pluck('name', 'id')
                      ->toArray();
                $local_operator=LocalOperator::select('name', 'id')
                              ->pluck('name', 'id')
                              ->toArray();
                $tourist_facility=TouristFacility::select('name', 'id')
                              ->pluck('name', 'id')
                              ->toArray();
                $userdata= UserDetails::where('user_id',$user_id)->first();
                $reportdata= TravelReports::where('user_id',$user_id)->first();

                // $travel_report_reserved = TravelReportReserved::select('user_id', 'id')->where('report_id', $report->id)->pluck('user_id', 'id')->toArray();
                $ReservedTravelReport = TravelReportReserved::where('report_id', $report->id)->first();
                $travel_report_reserved = isset($ReservedTravelReport) ? $ReservedTravelReport->user_id : '';

                $travel_situation=TravelSituation::select('name', 'name')
                      ->pluck('name', 'name')
                      ->toArray();
                $travel_type=TravelTypes::select('name', 'name')
                              ->pluck('name', 'name')
                              ->toArray();
                $travel_accommodation=TravelAccommodation::select('name', 'name')
                              ->pluck('name', 'name')
                              ->toArray();
                $travel_vector=TravelVector::select('name', 'name')->where('parent_id',1)
                              ->pluck('name', 'name')
                              ->toArray();
                $travel_participate=TravelParticipate::select('name', 'name')
                              ->pluck('name', 'name')
                              ->toArray();
                $travel_budget=TravelBudget::select('name', 'name')
                               ->pluck('name', 'name')
                               ->toArray();
                $travel_formula=TravelFormula::select('name', 'name')
                               ->pluck('name', 'name')
                               ->toArray();
                $travel_favoritemealtype=TravelVector::select('name', 'name')->where('parent_id','!=','0')->where('vector_type','meals')
                               ->pluck('name', 'name')
                               ->toArray();
                return view('frontend.travel_report.edit',compact('slide_data', 'report', 'roledata', 'userdata','country_arr', 'travelcateg_arr', 'carrierg_arr', 'currency_arr', 'agency_option', 'local_operator', 'tourist_facility', 'reportdata', 'travel_report_reserved','id', 'roledata', 'travel_situation', 'travel_type', 'travel_accommodation', 'travel_vector', 'travel_participate', 'travel_budget', 'travel_formula', 'travel_favoritemealtype', 'travel_pro', 'travelpro_arr'));
            }
            else{
                return redirect('account')->withFlashWarning(__('Sorry we don\'t have this record'));
            }
        }
        else{
            return redirect('account')->withFlashWarning(__('Sorry we don\'t have this record'));
        }


        /*$request_id=encrypt_decrypt('decrypt',$request->id);
        $reportdata=TravelReports::where('id',$request_id)->first();

        $user_id=Auth::user()->id;
        if($user_id==$reportdata->user_id){
            $report_id=$request->id;
            $slide_data=SliderAudio::get();

            $component=TravelReportComponent::where('travel_report_id',$request_id)->get();
            $component=TravelReportComponent::where('travel_report_id',$request_id)->get();
            $gallery=TravelReportGallery::where('travel_report_id',$request_id)->orderby('id','desc')->get();

            $slideshow=TravelReportSlideshow::where('travel_report_id',$request_id)->get();
            $country_arr = $this->getcountry();
            $currency_arr = Currency::orderby('name','asc')->select('name', 'id')->get();
            $traveltype_offer=TravelProType::where('travel_report_id',$request_id)->select('offer','offer_cost')->whereNotNull('offer')->first();
            $traveltype_operator=TravelProType::where('travel_report_id',$request_id)->select('operator','operator_cost')->whereNotNull('operator')->first();
            $traveltype_facility=TravelProType::where('travel_report_id',$request_id)->select('facility','facility_cost')->whereNotNull('facility')->first();

            $travelcateg_arr = $this->gettravelcateg();

            $carrierg_arr=TravelVector::select('name', 'id')->pluck('name', 'id')->toArray();

            $travel_favorite_meals_type=TravelFavoriteMealsType::select('name', 'id')->pluck('name', 'id')->toArray();


            $userdata= UserDetails::where('user_id',$user_id)->first();
            $role_type=Auth::user()->role_type;
            $roledata=Role::where('name',$role_type)->first();

            $agency_option=AgencyOption::select('name', 'id')
                          ->pluck('name', 'id')
                          ->toArray();
             $local_operator=LocalOperator::select('name', 'id')
                          ->pluck('name', 'id')
                          ->toArray();
             $tourist_facility=TouristFacility::select('name', 'id')
                          ->pluck('name', 'id')
                          ->toArray();

             $travel_meal=TravelReportFavMeal::where('travel_report_id',$request_id)->get();

            return view('frontend.travel_report.edit',compact('traveltype_offer','traveltype_operator','traveltype_facility','slide_data','slideshow','gallery','component','report_id','reportdata','roledata','userdata','country_arr',
            'travelcateg_arr','carrierg_arr', 'currency_arr','agency_option','local_operator','tourist_facility', 'travel_meal'));
        }
        else
        {
            return redirect('account')->withFlashSuccess(__('alerts.frontend.edit_report.check'));
        }*/

    }

        // start for edit page  crop image

    // modifica un report travel
    public function update( Request $request ) {

        // $validated = $request->validate([
        //     'title' => 'required|string',
        // ]);

        $report_id = $request->report_id;

        $form_data = $request->all();

        $user_id = Auth::User('id');

        $report = TravelReports::where('id', $report_id)->first();
        $total_cost = isset($request->total_cost_of_trip)?$request->total_cost_of_trip:'';
        $participant = isset($request->no_of_participants)?$request->no_of_participants:'';

        if(!empty($report)){
            $title = isset($request->travel_report_name)?$request->travel_report_name:'';


          $report->title = $title;
          $report->slug = convertoToSlug($title);

          $report->category_id = !empty($form_data['travel_report_category']) ? implode(',', $form_data['travel_report_category']) : '';
          $report->report_startdate = date('Y-m-d', strtotime($request->trip_start));
          $report->report_enddate = date('Y-m-d', strtotime($request->trip_end));
          $report->country_departure = isset($request->country_departure)?$request->country_departure:'';
          $report->country_destination = !empty($form_data['country_destination']) ? implode(',', $form_data['country_destination']) : '';
          $report->no_of_participants = isset($request->no_of_participants)?$request->no_of_participants:'';
          $report->travel_time = $this->dateDiffInDays($form_data['trip_start'], $form_data['trip_end']);
        //   $report->description = strip_tags(($request->report_description)?$request->report_description:'');
          $report->description = $request->report_description?$request->report_description:'';
          $report->report_option = isset($request->report_option)?$request->report_option:'report';
          $report->no_of_carries= isset($request->no_of_carries)?$request->no_of_carries:'1';
          $report->security_option= isset($request->security_option)?$request->security_option:'';
          $report->currency_id= isset($request->currency_id)?$request->currency_id:'';
          $report->image_audio= isset($request->image_audio)?$request->image_audio:'';
          $report->slider_type = isset($request->slider_type)?$request->slider_type:'transitions';
          $report->slider_video_type = isset($request->slider_video_type)?$request->slider_video_type:'';
          $report->travel_cost = $total_cost;
          $report->travel_offer = isset($request->offer)?$request->offer:0;
          $report->status = '1';

          $report->sentimental_situation= ''; //isset($request->sentimental_situation)?$request->sentimental_situation:'';
          $report->type_of_travel= isset($request->type_of_travel)?$request->type_of_travel:'';
          $report->type_of_accommodation= isset($request->type_of_accommodation)?$request->type_of_accommodation:'';

          $report->vector_type= isset($request->vector_type)?$request->vector_type:'';
          $report->type_of_participants= isset($request->type_of_participants)?$request->type_of_participants:'';
          $report->preferred_travel_budget= isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';
          $report->preferred_type= isset($request->preferred_type)?$request->preferred_type:'';
          $report->travel_favoritemealtype= isset($request->type_of_fav_meals)?$request->type_of_fav_meals:'';
          $report->birth_place=!empty($request->birth_place)?$request->birth_place:1; //$request->birth_place; //date('Y-m-d', strtotime($request->birth_place));
          $report->local_operator= isset($request->local_operator)?$request->local_operator:'';
          $report->tourist_facility= isset($request->tourist_facility)?$request->tourist_facility:'';
          $report->identification_option= isset($request->identification_option)?$request->identification_option:'';
          $report->travel_pro = !empty($form_data['pro_travel']) ? implode(',', $form_data['pro_travel']) : '';
          //$report->travel_pro= isset($request->travel_pro)?$request->travel_pro:'';
           // dd($report);
          if($user_id->role_type=='travel_blogger'){
            $social_links='';

          }elseif($user_id->role_type=='travel_maker'){
              $social_links='';

          }elseif($user_id->role_type=='traveler'){
             $social_links='';
         }

         else{

            // $social_links=implode(',',$form_data['links']);
            $social_links='';

         }

          $report->links=isset($social_links)?$social_links:'';

          if($request->hasFile('cover_photo_trip'))
          {
              $filename = $request->file('cover_photo_trip'); //get the file
              $checkfile = $request->hasFile('cover_photo_trip');
              $destinationPath = public_path('/img/frontend/travel_report/coverphoto');
              $report->cover_photo = $this->UploadFileConfig($destinationPath, $checkfile, $filename);
          }else{
              $cover_photo=$report->cover_photo;
          }

          if ($report->slider_video_type == 'image' ){

              if(!empty($request->hasFile('slider_video')))
              {

                  $videofile = $request->file('slider_video'); //get the file
                  $checkvideofile = $request->hasFile('slider_video');
                  $videoPath = public_path('/video/frontend/travel_report/slidervideo');
                  $report->slider_video = $this->UploadFileConfigVideo($videoPath, $checkvideofile, $videofile);
              }
          }

          if($report->slider_video_type == 'link' ){

            if(!empty($request->slider_video)){

                preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $request->slider_video, $matches);

                $videoId =  !empty($matches[1])?$matches[1]:0;
               // dd($videoId);

                $url = explode('?v=',  $videoId);
                   $report->slider_video = end($url);
                }
          }

          if($report->save()){

            //$this->basic_email($user_id->email, $user_id->user_name);
            $cropImagePath = public_path().'/crop_images/';

          if(isset($form_data['component_name']) && !empty($form_data['component_name']) && count($form_data['component_name']) > 0 ){

                foreach ($form_data['component_name'] as $key => $value){

                    $total_cost = $form_data['total_cost_of_trip'];
                    $report_component = [
                      'travel_report_id'=> $request->report_id,
                      'component_name' => $form_data['component_name'][$key],
                      'sub_component_id'=> !empty($form_data['sub_component_name'][$key]) ? $form_data['sub_component_name'][$key] : 0,
                      'individual_cost' => $form_data['individual_cost'][$key],
                      'total_cost' => $total_cost,
                      'travel_pro' => isset($form_data['travel_pro'][$key]) && !empty($form_data['travel_pro'][$key]) ? $form_data['travel_pro'][$key] : null,
                      'travel_pro_name' => isset($form_data['travel_pro_name'][$key][0]) && !empty($form_data['travel_pro_name'][$key][0]) ? $form_data['travel_pro_name'][$key][0] : null
                    ];
                    //dd($total_cost);
                    Log::info($report_component);

                    if(!empty($form_data['component_id'][$key])){
                        TravelReportComponent::where('id', $form_data['component_id'][$key])->update($report_component);
                    }
                    else{
                        TravelReportComponent::create($report_component);
                    }
                }
            }

            if(isset($form_data['gallery_caption']) && !empty($form_data['gallery_caption']) && count($form_data['gallery_caption']) > 0 ){
                foreach ($form_data['gallery_caption'] as $key => $value){

                    $report_gallery = [
                      'travel_report_id'=> $request->report_id,
                      'image_caption'=> $form_data['gallery_caption'][$key],
                      'image_location'=> !empty($form_data['location_of_shot'][$key])?$form_data['location_of_shot'][$key]:'',
                      'image_sorting'=> $form_data['sorting_in_gallery'][$key],
                      'image_lat'=> $form_data['image_lat'][$key],
                      'image_long'=> $form_data['image_long'][$key],

                    ];

                    if(!empty($form_data['gallery_photo'][$key])){
                        //$publicpath = (public_path().'/img/frontend/travel_report/gallery/');

                        $publicpath = (public_path().'/img/frontend/travel_report/gallery/');
                        $image = $form_data['gallery_photo'][$key];
                        $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();

                        $image = Image::make($image->getRealPath());
                        $image->resize(1350, 1013, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($publicpath.'/'.$img_name);

                        $report_gallery['gallery_image'] = $img_name;

                        if(!empty($form_data['crop_photo'][$key]) && file_exists($cropImagePath.$form_data['crop_photo'][$key])){
                            if(rename($cropImagePath.$form_data['crop_photo'][$key], $cropImagePath.$img_name)){
                                @unlink($cropImagePath.$form_data['crop_photo'][$key]);
                            }
                        }
                    }

                    if(!empty($form_data['gallery_id'][$key])){
                        TravelReportGallery::where('id', $form_data['gallery_id'][$key])->update($report_gallery);
                    }
                    else{
                        TravelReportGallery::create($report_gallery);
                    }
                }
            }

            // if(isset($form_data['user_id_checked'])){
            //     $this->travel_report_reversed_update($form_data['user_id_checked'], $report_id);
            // }
            if(isset($form_data['user_id_checked'])){
                $travelReportReversed = TravelReportReserved::where('report_id', $report_id)->first();
                if(isset($travelReportReversed)){
                    $travelReportReversed->user_id = $form_data['user_id_checked'][0];
                }else{
                    $travelReportReversed = new TravelReportReserved();
                    $travelReportReversed->user_id = $form_data['user_id_checked'][0];
                    $travelReportReversed->report_id = $report_id;
                }
                
                $travelReportReversed->save();
            }

            if(isset($form_data['offer']) && !empty($form_data['offer']) && !empty($form_data['offer_cost']) ){
                TravelProType::whereNotIn('id', $form_data['offer_id'])->where('travel_report_id', $request->report_id)->delete();
                foreach ($form_data['offer'] as $key => $value) {
                    $mulltipleArr_comp = array(
                        'travel_report_id' => $request->report_id,
                        'offer' => $form_data['offer'][$key],
                        'offer_cost' => $form_data['offer_cost'][$key],
                        'status' =>'1'
                    );
                    if(isset($form_data['offer_id']) && !empty($form_data['offer_id'][$key])){
                        TravelProType::where(['id' => $form_data['offer_id'][$key]])->update($mulltipleArr_comp);
                    }
                    else{
                        TravelProType::create($mulltipleArr_comp);
                    }

                }

                $this->travel_report_component_update($request->component_name, $request->individual_cost, $request->total_cost, $request->travel_pro, $report_id);
            }

            return redirect( 'view/travel_report/'.$report->slug)->withFlashSuccess(__('Travel report has been updated successfully'));
                //return redirect( 'control-panel')->withFlashSuccess(__('Travel report has been updated successfully'));
            }

        }
        else{

        }
    }

     public function travel_report_reversed_update($user_id_checked, $lastinsertId ){
        TravelReportReserved::where('report_id', $lastinsertId)->delete();
        if($user_id_checked){
            foreach ($user_id_checked as  $value) {
                $mulltipleReservedArr = array(
                    'report_id' => $lastinsertId,
                    'user_id' => $value,
                );

              //echo "<pre>";print_r($mulltipleReservedArr); die;
              TravelReportReserved::insert($mulltipleReservedArr);

            }
        }
    }

    public function sameTrip($id=null){
        //dd($id);
        $trip_id = $id;
        $sametrip_data= SameTrip::with('report', 'sametrip')->where('report_id',$id)->orwhere('same_trip_id',$trip_id)->get();
        $user_id=Auth::user()->id;
        $role_type=Auth::user()->role_type;
        $roledata=Role::where('name',$role_type)->first();
        $userdata= UserDetails::where('user_id',$user_id)->first();

        $report_data = TravelReports::withCount('supers', 'alerts', 'sametrip')->where(function($q) use ($user_id){
            $q->where('security_option', 'public')
            ->orWhere('user_id', $user_id)
            ->orWhere(function($q) use ($user_id){
                return $q->whereHas('reserved_users', function($qr) use ($user_id){
                    return $qr->where('user_id', $user_id);
                });
            });
        })->orderBy('id', 'desc')->paginate(9);

        //echo '<pre>'; print_r( $travel_reports);exit;
       //dd($travel_reports);
       if(!empty($report_data->toArray())) {
            $travelData=$report_data->toArray();

            $country_ids=[];
            $categories=[];
            if(!empty($travelData['data'])){
                foreach ($travelData['data'] as $key=>$value) {
                    if(!empty($value['category_id'])) {
                        $cats=explode(',', $value['category_id']);

                        foreach ($cats as $k => $val) {
                            $categories[$val]=$val;
                        }
                    }
                    $country_ids[$value['country_departure']]=$value['country_departure'];
                }
            }
        }


        $userdata= UserDetails::where('user_id',$user_id)->first();


        if(!empty($categories) && !empty($country_ids)) {

            $vector=!empty($userdata->vector_type)?explode(',', $userdata->vector_type):[];

            $acco=!empty($userdata->type_of_accommodation)?explode(',', $userdata->type_of_accommodation):[];
            $participant=!empty($userdata->type_of_participants)?explode(',', $userdata->type_of_participants):[];
            $favorite=!empty($userdata->travel_favoritemealtype)?explode(',', $userdata->travel_favoritemealtype):[];
            $adsCond=['status'=>1];

            $ads_data = Advertisement::orderby('id','desc')->where($adsCond);

            if(!empty($userdata->type_of_travel)) {
                $ads_data->orWhere('travel_type',$userdata->type_of_travel);

            }

            if(!empty($userdata->preferred_type)) {
                $adsCond['preffered_stay_formula']=$userdata->preferred_type;
            }

            if(!empty($categories)) {
                $ads_data->orWhere('category_id',$categories);

            }

            if(!empty($country_ids)) {
                $ads_data->orWhere('country_departure',$country_ids);
            }

            if(!empty($vector)) {
                $ads_data->orWhere('vector_type',$vector);
            }

            if(!empty($participant)) {
                $ads_data->orWhere('type_of_participant',$participant);
            }

            if(!empty($acco)) {
                $ads_data->orWhere('type_of_accomodation',$acco);
            }

            if(!empty($favorite)) {
                $ads_data->orWhere('type_of_fav_meal',$favorite);
            }
            $ads_data=$ads_data->get();
        } else {
            $ads_data=[];
        }

       //$report_data=TravelReports::where('id',$trip_id)->first();

        return view('frontend.user.same_trip',compact('roledata','report_data','sametrip_data', 'trip_id', 'ads_data', 'userdata', 'trip_id'));


      }

    //   public function travel_report_view(){
    //     return view('frontend.travel_report.view');
    //   }

     //Report Diary Page
      public function travel_report_dairy($id = null,Request $request){
        $report_id=$request->id;
        $report_id=encrypt_decrypt('decrypt', $report_id);
        $user_id=isset(Auth::user()->id)?Auth::user()->id:'';
        $userdata= UserDetails::where('user_id',$user_id)->first();
        $travel_report = TravelReports::withCount('report_components')->with('image_gallery', 'category' ,'userdata', 'report_components')->where('id', $report_id)->where('report_option','diary')->first();
        $cover= UserDetails::where('user_id',$travel_report->user_id)->select('cover_image')->first();
        $role_type = $travel_report->userdata->role_type;
        $roledata=Role::where('name', $role_type)->first();
        /*$travel_report = TravelReports::where('id', $report_id)->where('report_option','diary')->first();*/

        $categories = !empty($travel_report->category_id)?explode(',', $travel_report->category_id):'';

        $country_ids = $travel_report->country_departure;

        if(!empty($categories) && !empty($country_ids) && !empty($userdata->preferred_travel_budget)) {
                $vector=!empty($userdata->vector_type)?explode(',', $userdata->vector_type):'';
                //dd($vector);
                $acco=!empty($userdata->type_of_accommodation)?explode(',', $userdata->type_of_accommodation):'';
                //dd($acco);
                $participant=!empty($userdata->type_of_participants)?explode(',', $userdata->type_of_participants):'';
                 //dd($participant);
                $favorite=!empty($userdata->travel_favoritemealtype)?explode(',', $userdata->travel_favoritemealtype):'';

                $adsCond=['status'=>1,'budget'=>$userdata->preferred_travel_budget];

                $ads_data = Advertisement::orderby('id','desc')->where($adsCond);
                //dd($ads_data);

                if(!empty($userdata->type_of_travel)) {
                    $ads_data->orWhere('travel_type',$userdata->type_of_travel);
                }

                if(!empty($userdata->preferred_type)) {
                    $adsCond['preffered_stay_formula']=$userdata->preferred_type;

                }
                if(!empty($categories)) {
                    $ads_data->orWhere('category_id',$categories);
                }
                if(!empty($country_ids)) {
                    $ads_data->orWhere('country_departure',$country_ids);
                }
                if(!empty($vector)) {
                    $ads_data->orWhere('vector_type',$vector);
                }
                if(!empty($participant)) {
                    $ads_data->orWhere('type_of_participant',$participant);
                }
                if(!empty($acco)) {
                    $ads_data->orWhere('type_of_accomodation',$acco);
                }
                if(!empty($favorite)) {
                    $ads_data->orWhere('type_of_fav_meal',$favorite);
                }
                $ads_data=$ads_data->get();

            } else {
                $ads_data='';
            }

          return view('frontend.travel_diary.view',compact('userdata','roledata','travel_report', 'cover', 'ads_data'));
      }

      //Report offer Page
      public function travel_report_proposal($id = null,Request $request){
        // $report_id=$request->id;
        // $report_id=encrypt_decrypt('decrypt', $report_id);
        $user_id=isset(Auth::user()->id)?Auth::user()->id:'';
        $userdata= UserDetails::where('user_id',$user_id)->first();
        $travel_report = TravelReports::withCount('report_components')->with('image_gallery', 'userdata', 'report_components', 'currency')->where('slug', $request->slug)->first();
        //echo '<pre>'; print_r($travel_report); die;
        $role_type = $travel_report->userdata->role_type;
        $roledata=Role::where('name',$role_type)->first();

        $report_id = $travel_report->id;

       $categories = !empty($travel_report->category_id)?explode(',', $travel_report->category_id):'';

        $country_ids = $travel_report->country_departure;

        if(!empty($categories) && !empty($country_ids) && !empty($userdata->preferred_travel_budget)) {
                $vector=!empty($userdata->vector_type)?explode(',', $userdata->vector_type):'';
                //dd($vector);
                $acco=!empty($userdata->type_of_accommodation)?explode(',', $userdata->type_of_accommodation):'';
                //dd($acco);
                $participant=!empty($userdata->type_of_participants)?explode(',', $userdata->type_of_participants):'';
                 //dd($participant);
                $favorite=!empty($userdata->travel_favoritemealtype)?explode(',', $userdata->travel_favoritemealtype):'';

                $adsCond=['status'=>1,'budget'=>$userdata->preferred_travel_budget];

                $ads_data = Advertisement::orderby('id','desc')->where($adsCond);
                //dd($ads_data);

                if(!empty($userdata->type_of_travel)) {
                    $ads_data->orWhere('travel_type',$userdata->type_of_travel);
                }

                if(!empty($userdata->preferred_type)) {
                    $adsCond['preffered_stay_formula']=$userdata->preferred_type;

                }
                if(!empty($categories)) {
                    $ads_data->orWhere('category_id',$categories);
                }
                if(!empty($country_ids)) {
                    $ads_data->orWhere('country_departure',$country_ids);
                }
                if(!empty($vector)) {
                    $ads_data->orWhere('vector_type',$vector);
                }
                if(!empty($participant)) {
                    $ads_data->orWhere('type_of_participant',$participant);
                }
                if(!empty($acco)) {
                    $ads_data->orWhere('type_of_accomodation',$acco);
                }
                if(!empty($favorite)) {
                    $ads_data->orWhere('type_of_fav_meal',$favorite);
                }
                $ads_data=$ads_data->get();

            } else {
                $ads_data='';
            }

       return view('frontend.travel_offer.view',compact('userdata','roledata','travel_report','report_id', 'ads_data'));
   }

    public function All_reports_data(Request $request){
        $userid=$request->user_id;
        $type=$request->type;
        if($type=='all_travel_report'){
               $travel_report=TravelReports::where('user_id', $userid)->get();
               return $data= $travel_report;
        }elseif($type=='only_travel'){
               $travel_report=TravelReports::where('user_id', $userid)->where('report_option','report')->get();
               return $data= $travel_report;
        }elseif($type=='only_same_trip'){

        }elseif($type=='only_travel_diary'){

            $travel_report=TravelReports::where('user_id', $userid)->where('report_option','diary')->get();

            return $data= $travel_report;
        }elseif($type=='only_offer'){
            $travel_report=TravelReports::where('user_id', $userid)->where('report_option','offer')->get();
               return $data= $travel_report;
        }

      }
       public function create_booking($id)
      {
        $user_id=$id;
        $agency_option=UserDetails::select('cover_image','identification_option','role_type', 'user_id','local_operator','tourist_facility')
            ->where('user_id',$id)->first();
       //dd($user_id);
        $role_type=$agency_option->role_type;
        $roledata=Role::where('name',$role_type)->first();
        return view('frontend.tripbooking.create',compact('roledata','agency_option','user_id'));
      }

      public function store_booking(Request $request)
      {
        $booking = new TripBooking();
        $user_id = Auth::User('id');
        $booking->user_id = $user_id->id;
        $booking->profile_id = $request->profile_id;
        if(isset($request->identification_option) && !empty($request->identification_option))
        {
        $identification_option_implode=implode(',',$request->identification_option);
        $booking->identification_option=isset($identification_option_implode)?$identification_option_implode:'';
        }
        if(isset($request->local_operator) && !empty($request->local_operator))
        {
        $local_operator_implode=implode(',',$request->local_operator);
        $booking->local_operator=isset($local_operator_implode)?$local_operator_implode:'';
        }
        if(isset($request->tourist_facility) && !empty($request->tourist_facility))
        {
        $tourist_facility_implode=implode(',',$request->tourist_facility);
        $booking->tourist_facility=isset($tourist_facility_implode)?$tourist_facility_implode:'';
        }

        $user_email=User::select('id','email','user_name')->where('id',$user_id->id)->first();
        $profile_email=User::select('id','email')->where('id',$request->profile_id)->first();
        $booking->save();
        //request_email,profile_email,identification,operator,touristfacility
        $data['name'] = $user_email->user_name;
        $data['email'] = $user_email->email;
        $data['identification_option'] = $booking->identification_option;
        $data['local_operator'] = $booking->local_operator;
        $data['tourist_facility'] = $booking->tourist_facility;

        $email_address = array('admin_email'=>$profile_email->email);

        Mail::send('frontend.mail.travel-service', $data, function($message) use($email_address){
         $message->to($email_address['admin_email'], 'Traveler Maker')
          ->subject('Request Travel Services');
        });
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
          }else{
            return redirect()->back()->withFlashSuccess(__('alerts.backend.travelservice.created'));
          }
    }

    public function delete_slide(Request $request){
        $slideid=$request->img_id;
        $slide=TravelReportSlideshow::where('id',$slideid)->delete();
        return 1;
     }

     public function delete_gallery_row(Request $request){

        $reportid=$request->row_id;
        $report_id=$request->report_id;
        //DB::enableQueryLog();
        TravelReportSlideshow::where('id',$reportid)->where('travel_report_id',$report_id)->delete();
        //dd(DB::getQueryLog());
        if(!empty($report_id)){
            return 1;
        }else{
            return 0;
        }
     }

     public function removedatagridrow(Request $request){

        $reportid=$request->row_id;
        $report_id=$request->report_id;
        $slide=TravelReportComponent::where('id',$reportid)->where('travel_report_id',$report_id)->delete();
        if($report_id){
            return 1;
        }else{
            return 0;
        }

     }

     public function requestcontent($id,$userid,Request $request){

        // $report_id=$id;

        // $img=TravelReports::where('id', $report_id)->select('cover_photo')->first();
        // $report_img=$img->cover_photo;

        // $user_id=isset(Auth::user()->id)?Auth::user()->id:'';
        // $role_type = Auth::user()->role_type;
        // $roledata=Role::where('name',$role_type)->first();
        //   return view('frontend.travel_report.request_content',compact('roledata','user_id','report_img'));

        $form_data = $request->all();
        $report = TravelReports::with('userdata')->where(['id' => $id])->first();

        $logged_in_user = Auth::user();
        $form_data['name'] = $logged_in_user->user_name;
        $form_data['email'] = $logged_in_user->email;
        $email_address = $report->userdata->email;
        $user_address = $logged_in_user->email;

        $form_data['first_name'] = $logged_in_user->first_name;
        $form_data['last_name'] = $logged_in_user->last_name;

        $url = url('/');
        $first_name = Auth::user()->first_name;
        $last_name = Auth::user()->last_name;
        $role_type = Auth::user()->role_type;
        $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . Auth::user()->id;
        $form_data['profile_link'] = $url . '/' . $link;
        $form_data['travel_report_name'] = $report->title;
        $form_data['travel_report_link'] = $url . '/view/travel_report/' . $report->slug;


        $mail_text=EmailDetails::where('type','I am Participate')->first();

        $form_data['content'] = isset($mail_text->content)?$mail_text->content:'';
        $sub='Information Request';

        Mail::send('frontend.mail.report-request-infomation', $form_data, function($message) use($email_address,$sub){
                $message->to($email_address, 'Traveler Pro')
                ->subject($sub);
            }
        );
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        }
        else{
            Mail::send('frontend.mail.thanks-one', $form_data,function($message) use($user_address,$sub){
                $message->to($user_address, 'Traveler Pro')->subject($sub);
            });
            // Mail::send('frontend.mail.report-request-infomation', $form_data, function($message) use($email_address,$sub){
            //         $message->to($email_address, 'Traveler Maker')
            //         ->subject($sub);
            //     }
            // );
            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            }else{
                try {
                    DB::beginTransaction();
                    // return view('frontend.mailchimp.create')->withFlashSuccess(__('alerts.backend.travelservice.created'));
                    $currentNumberWantInfomation = $report->number_want_infomation;
                    if(empty($currentNumberWantInfomation)){
                        $currentNumberWantInfomation = 0;
                    }
                    $newNumberWantInfomation = $currentNumberWantInfomation + 1;
                    $report->number_want_infomation = $newNumberWantInfomation;
                    $report->save();

                    $userParticipate = new UserParticipate();
                    $userParticipate->report_id = $report->id;
                    $userParticipate->travel_report_name = $report->title;
                    $userParticipate->date_click = Carbon::now();
                    $userParticipate->user_name = $last_name . ' ' . $first_name;
                    $userParticipate->link_profile = $form_data['profile_link'];
                    $userParticipate->user_email = $form_data['email'];
                    $userParticipate->save();
                    
                    DB::commit();
                    return redirect()->back()->withFlashSuccess("Your request has been sent successfully");
                } catch (\Exception $e) {
                    DB::rollBack();
                    
                    return redirect()->back()->withFlashSuccess("Error!");
                }

            }
        }
    }

    public function reportcontent_request(Request $request)
    {
        $form_data = $request->all();
        //echo '<pre>'; print_r($form_data); die;



        if(!empty($form_data['report_id'])){
            $report = TravelReports::with('userdata')->where(['id' => $form_data['report_id']])->first();

            $logged_in_user = Auth::user();

            if(!empty($logged_in_user)){
                 // /dd($logged_in_user);
                if($form_data['request_type'] == 'interested'){
                    $form_data['name'] = $logged_in_user->user_name;
                    $form_data['email'] = $logged_in_user->email;
                    $email_address = $report->userdata->email;
                    $user_address = $logged_in_user->email;
                    $mail_text=EmailDetails::where('type','I am Interested')->first();
                    $form_data['content'] = isset($mail_text->content)?$mail_text->content:'';
                    $sub= isset($mail_text->subject)?$mail_text->subject:'Interest Request';

                    Mail::send('frontend.mail.report-request-interest', $form_data,function($message) use($email_address,$sub){
                            $message->to($email_address, 'Traveler Maker')->subject($sub);
                        }
                    );

                    if (Mail::failures()) {
                        return response()->Fail('Sorry! Please try again latter');
                    }
                    else{
                        Mail::send('frontend.mail.thanks', $form_data,function($message) use($user_address,$sub){
                            $message->to($user_address, 'Traveler Maker')->subject($sub);
                        });
                        if (Mail::failures()) {
                            return response()->Fail('Sorry! Please try again latter');
                        }
                        else{
                            return view('frontend.mailchimp.create')->withFlashSuccess(__('alerts.backend.travelservice.created'));
                        }
                    }

                }

                else{

                    $form_data['name'] = $logged_in_user->user_name;
                    $form_data['email'] = $logged_in_user->email;
                    $email_address = $report->userdata->email;
                    $user_address = $logged_in_user->email;

                    $form_data['first_name'] = $logged_in_user->first_name;
                    $form_data['last_name'] = $logged_in_user->last_name;

                    $url = url('/');
                    $first_name = Auth::user()->first_name;
                    $last_name = Auth::user()->last_name;
                    $role_type = Auth::user()->role_type;
                    $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . Auth::user()->id;
                    $form_data['profile_link'] = $url . '/' . $link;
                    $form_data['travel_report_name'] = $report->title;
                    $form_data['travel_report_link'] = $url . '/view/travel_report/' . $report->slug;


                    $mail_text=EmailDetails::where('type','I am Participate')->first();

                    $form_data['content'] = isset($mail_text->content)?$mail_text->content:'';
                    $sub=isset($mail_text->subject)?$mail_text->subject:'Participate Request';

                    $userParticipate = new UserParticipate();
                    $userParticipate->report_id = $form_data['report_id'];
                    $userParticipate->travel_report_name = $report->title;
                    $userParticipate->date_click = Carbon::now();
                    $userParticipate->user_name = $last_name . ' ' . $first_name;
                    $userParticipate->link_profile = $form_data['profile_link'];
                    $userParticipate->user_email = $form_data['email'];
                    $userParticipate->save();

                    Mail::send('frontend.mail.report-request-participate', $form_data, function($message) use($email_address,$sub){
                            $message->to($email_address, 'Traveler Maker')
                          ->subject($sub);
                        }
                    );
                    if (Mail::failures()) {
                        return response()->Fail('Sorry! Please try again latter');
                    }
                    else{
                        Mail::send('frontend.mail.thanks', $form_data,function($message) use($user_address,$sub){
                            $message->to($user_address, 'Traveler Maker')->subject($sub);
                        });
                        // Mail::send('frontend.mail.report-request-participate', $form_data, function($message) use($email_address,$sub){
                        //         $message->to($email_address, 'Traveler Maker')
                        //         ->subject($sub);
                        //     }
                        // );
                        if (Mail::failures()) {
                            return response()->Fail('Sorry! Please try again latter');
                        }else{
                            // return view('frontend.mailchimp.create')->withFlashSuccess(__('alerts.backend.travelservice.created'));
                            $currentNumberWantJoin = $report->number_want_join;
                            if(empty($currentNumberWantJoin)){
                                $currentNumberWantJoin = 0;
                            }
                            $newNumberWantJoin = $currentNumberWantJoin + 1;
                            $report->number_want_join = $newNumberWantJoin;
                            $report->save();
                            return redirect()->back()->withFlashSuccess("Your request has been sent successfully");
                        }
                    }

                }
            }
            else{
                return redirect()->route('frontend.auth.login')->withFlashSuccess(__('You are not authorised to access this page. Please login / Signup first.'));
            }
        }

        /*$report_owner_id=$id;
        $user_email=User::select('id','email','user_name')->where('id',$userid)->first();
        $report_owner_email=User::select('id','email')->where('id',$id)->first();
        $data['name'] = $user_email->user_name;
        $data['email'] = $user_email->email;
        if($slug=='interested'){
            $mail_text=EmailDetails::where('type','I am Interested')->first();

            $sub= isset($mail_text->subject)?$mail_text->subject:'Interest Request';

        }else{
            $mail_text=EmailDetails::where('type','I am Participate')->first();

            $sub=isset($mail_text->subject)?$mail_text->subject:'IParticipate Request';
        }

        $data['content'] = isset($mail_text->content)?$mail_text->content:'';
        //$email_address = array('admin_email'=>'democheck@mailinator.com');
        //$user_address = array('user_email'=>'democheck@mailinator.com');
        $email_address = array('admin_email'=>'checkmaker@mailinator.com');
        $user_address = array('user_email'=>'checkmaker@mailinator.com');
        if($slug=='interested'){
            Mail::send('frontend.mail.report-request-interest', $data, function($message) use($email_address,$sub){
                    $message->to($email_address['admin_email'], 'Traveler Maker')->subject($sub);
                }
            );
            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            }
            else{
                Mail::send('frontend.mail.thanks', $data,function($message) use($user_address,$sub){
                    $message->to($user_address['user_email'], 'Traveler Maker')->subject($sub);
                });
                if (Mail::failures()) {
                    return response()->Fail('Sorry! Please try again latter');
                }
                else{
                    return view('frontend.mailchimp.create')->withFlashSuccess(__('alerts.backend.travelservice.created'));
                }
            }
        }else{
            Mail::send('frontend.mail.report-request-participate', $data, function($message) use($email_address,$sub){
                    $message->to($email_address['admin_email'], 'Traveler Maker')
                  ->subject($sub);
                }
            );
            if (Mail::failures()) {
                return response()->Fail('Sorry! Please try again latter');
            }
            else{
                Mail::send('frontend.mail.thanks', $data,function($message) use($user_address,$sub){
                    $message->to($user_address['user_email'], 'Traveler Maker')->subject($sub);
                });
                if (Mail::failures()) {
                    return response()->Fail('Sorry! Please try again latter');
                }else{
                    return view('frontend.mailchimp.create')->withFlashSuccess(__('alerts.backend.travelservice.created'));
                }
            }
        }*/

     }

     public function showslider(Request $request){
         return $request->slider_type;
     }

     public function report_send_content(Request $request){
        $senddata = new ReportContent();
        $senddata->user_id = $request->user_id;
        $senddata->description = $request->description;
        $senddata->save();

        $user_email=User::select('id','email','user_name')->where('id',$request->user_id)->first();
        $profile_email=User::select('id','email')->where('role_type','admin')->first();

        $data['name'] = $user_email->user_name;
        $data['email'] = $user_email->email;
        $data['description'] = $senddata->description;
        $email_address = array('admin_email'=>$profile_email->email);

        Mail::send('frontend.mail.report-request', $data, function($message) use($email_address){
            $message->to($email_address['admin_email'], 'Traveler Maker')
             ->subject('Request Travel Content');
           });
           if (Mail::failures()) {
               return response()->Fail('Sorry! Please try again latter');
             }else{
               return redirect()->back()->withFlashSuccess(__('alerts.backend.travelservice.created'));
       }
     }

     public function request_diary($id,$userid){

           $report_id=$id;

           $user_id=$userid;

           $user_email=User::select('id','email','user_name')->where('id',$user_id)->first();

           $report_data=TravelReports::where('id',$report_id)->first();

           $profile_email=User::select('id','email','user_name')->where('id',$report_data->user_id)->first();

           $data['name'] = $user_email->user_name;
           $data['email'] = $user_email->email;
           $data['report_name'] = $report_data->title;
          //$email_address = array('admin_email'=>'democheck@mailinator.com');
           $email_address = array('admin_email'=>$profile_email->email);
           $mail_text=EmailDetails::where('type','Request the Download of the Travel Diary')->first();
           $sub=isset($mail_text->subject)? $mail_text->subject:'Request Diary';
           $data['content'] = isset($mail_text->content)?$mail_text->content:'';
           Mail::send('frontend.mail.request_diary', $data, function($message) use($email_address,$sub){
               $message->to($email_address['admin_email'], 'Traveler Maker')
                ->subject($sub);
              });
              if (Mail::failures()) {
                  return response()->Fail('Sorry! Please try again latter');
                }else{
                  return redirect()->back()->withFlashSuccess(__('alerts.backend.travelservice.created'));
          }

     }

     public function request_information($id,$userid){

           $report_id=$id;
           $user_id=$userid;
           $bookdata = new BookInformation();
           $bookdata->user_id = $user_id;
           $bookdata->report_id = $report_id;
           $bookdata->status = '1';
           $bookdata->save();
           $user_email=User::select('id','email','user_name')->where('id',$user_id)->first();

           $report_data=TravelReports::where('id',$report_id)->first();

           $profile_email=User::select('id','email','user_name')->where('id',$report_data->user_id)->first();
           //$profile_email->email = 'democheck@mailinator.com';

           $mail_text=EmailDetails::where('type','Book or Request Information')->first();

           $data['name'] = $user_email->user_name;
           $data['email'] = $user_email->email;
           $data['cost'] = $report_data->travel_cost;
           $data['member'] = $report_data->no_of_participants;
           $data['report_name'] = $report_data->title;
           $data['report_id'] = $id;

           $sub=isset($mail_text->subject)? $mail_text->subject:'Request Information';
           $data['content'] = isset($mail_text->content)?$mail_text->content:'';
           $email_address = [$profile_email->email, 'booking@travelmaker.info'];

           Mail::send('frontend.mail.request_information', $data, function($message) use($email_address,$sub){
               $message->to($email_address, 'Traveler Maker')
                ->subject($sub);
              });
              if (Mail::failures()) {
                  return response()->Fail('Sorry! Please try again latter');
                }else{
                  return redirect()->back()->withFlashSuccess(__('alerts.backend.travelservice.created'));
          }
     }
    public function subscribemailchimp(){
       return view('frontend.mailchimp.create');
    }

    public function imageLocation(Request $request){

        $response = [];
        $filename = $request->file('file'); //get the file
        $fls = !empty($_FILES['file'])?$_FILES['file']:[];

        $checkfile = $request->hasFile('file');
       // $destinationPath = public_path('/img/frontend/travel_report/coverphoto');
        $destinationPath2 = public_path('img/frontend/travel_report/coverphoto/');
        //$image_file = $this->UploadFileConfig($destinationPath, $checkfile, $filename);
       $location = [];
       if( $checkfile && !empty($fls['name'])){
            $f = pathinfo($fls['name']);
            $ext = $f['extension'];
            $newName = time().'.'.$ext;
            $fullPath = $destinationPath2.$newName;
            if(move_uploaded_file($filename, $fullPath)){
                // if($ext == 'png'){
                //     $location = []; 
                // }else{
                    $location = $this->get_image_location($fullPath);
                // }
                
            }
          //  $image = url('/img/frontend/travel_report/coverphoto/'.$image_file);

        }
        if(!empty($location))
        {
            $address = $this->getaddress($location['latitude'], $location['longitude']);
            if(!empty($address)){
                $response['status'] = 1;
                $response['data']   = $address;
                $response['lat']    = $location['latitude'];
                $response['lng']    = $location['longitude'];
                $response['message']= 'done';
            }
            else{
                $response['status'] = 2;
                $response['lat']    = $location['latitude'];
                $response['lng']    = $location['longitude'];
                $response['message']= 'Please add google maps api key to get location';
            }
        }

        else{
            $response['status'] = 0;
            $response['message']= 'Image don\'t have gps cordinates';
        }
        echo json_encode($response); die;
    }

    function getaddress($lat,$lng)
    {
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
        $json = @file_get_contents($url);
        $data=json_decode($json);
        $status = $data->status;
        if($status=="OK")
        {
            return $data->results[0]->formatted_address;
        }
        else
        {
           return false;
        }
    }

    public function deleteGalleryimg(){
        $ids = $_REQUEST['id'];
        TravelReportGallery::where('id', $ids)->delete();
    }


    function get_image_location($image = ''){
        $exif = @exif_read_data($image, 0, true);

        if($exif && isset($exif['GPS'])){
            $GPSLatitudeRef = $exif['GPS']['GPSLatitudeRef'];
            $GPSLatitude    = $exif['GPS']['GPSLatitude'];
            $GPSLongitudeRef= $exif['GPS']['GPSLongitudeRef'];
            $GPSLongitude   = $exif['GPS']['GPSLongitude'];

            $lat_degrees = count($GPSLatitude) > 0 ? $this->gps2Num($GPSLatitude[0]) : 0;
            $lat_minutes = count($GPSLatitude) > 1 ? $this->gps2Num($GPSLatitude[1]) : 0;
            $lat_seconds = count($GPSLatitude) > 2 ? $this->gps2Num($GPSLatitude[2]) : 0;

            $lon_degrees = count($GPSLongitude) > 0 ? $this->gps2Num($GPSLongitude[0]) : 0;
            $lon_minutes = count($GPSLongitude) > 1 ? $this->gps2Num($GPSLongitude[1]) : 0;
            $lon_seconds = count($GPSLongitude) > 2 ? $this->gps2Num($GPSLongitude[2]) : 0;

            $lat_direction = ($GPSLatitudeRef == 'W' or $GPSLatitudeRef == 'S') ? -1 : 1;
            $lon_direction = ($GPSLongitudeRef == 'W' or $GPSLongitudeRef == 'S') ? -1 : 1;

            $latitude = $lat_direction * ($lat_degrees + ($lat_minutes / 60) + ($lat_seconds / (60*60)));
            $longitude = $lon_direction * ($lon_degrees + ($lon_minutes / 60) + ($lon_seconds / (60*60)));
            return array('latitude'=>$latitude, 'longitude'=>$longitude);
        }else{
            return false;
        }

    }

    function gps2Num($coordPart)
    {
        $parts = explode('/', $coordPart);

        if(count($parts) <= 0)// jic
            return 0;
        if(count($parts) == 1)
            return $parts[0];

        return floatval($parts[0]) / floatval($parts[1]);
    }


    public function travelCostSummary(Request $request){
        $form_data = $request->all();
        $container_length = $form_data['container_length'] + 1;
        if(!empty($form_data['container_length']) && $form_data['container_length'] > 0){
            $travel_vectors=TravelVector::select('name', 'id')->where(['parent_id' => 0])->pluck('name', 'id')->toArray();
            $travel_pro = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')->where('role_type', 'travel_agency')->orderBy('display_name')->pluck('display_name', 'id');
            return view('frontend.travel_report.cost_summary', compact('travel_vectors', 'container_length', 'travel_pro'));
        }
    }

    public function travelCostSummaryEdit(Request $request){
        $form_data = $request->all();
        $container_length = $form_data['container_length'] + 1;
        if(!empty($form_data['container_length']) && $form_data['container_length'] > 0){
            $travel_vectors=TravelVector::select('name', 'id')->where(['parent_id' => 0])->pluck('name', 'id')->toArray();
            $travel_pro = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')->where('role_type', 'travel_agency')->orderBy('display_name')->pluck('display_name', 'id');
            return view('frontend.travel_report.cost_summary_edit', compact('travel_vectors', 'container_length', 'travel_pro'));
        }
    }

    public function addNewInvitation(Request $request){
        $numberOfInvitation = $request->numberOfInvitation;
        $today = Carbon::now()->format('d/m/Y');
        return view('frontend.travel_report.new_invitation', compact('numberOfInvitation', 'today'));
    }

    public function sendInvitation(Request $request){
        $inviteFriend = new InviteFriend();
        $inviteFriend->user_id = Auth::user()->id;
        $inviteFriend->name = $request->surname;
        $inviteFriend->email = $request->emailaddress;
        $inviteFriend->status_invitation = 'pending';
        $inviteFriend->date_invite = Carbon::now();
        $inviteFriend->save();

        return redirect()->back();
    }

    public function checkTypeVoucher(Request $request){
        $typeVoucher = $request->typeVoucher;
        $numberInviteAccept = InviteFriend::where([
            ['user_id', Auth::user()->id],
            ['status_invitation', 'accept']
        ])->count();

        if($typeVoucher == 'voucherFiveDollar'){
            $user = User::where('id', Auth::user()->id)->first();
            $statusVoucherOfUser = $user->voucher_five_dollar;
            if(empty($statusVoucherOfUser)){
                if($numberInviteAccept >= 10){
                    $user->voucher_five_dollar = 'used';
                    $user->save();

                    require_once(base_path() . '/vendor/autoload.php');

                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $createContact = new \SendinBlue\Client\Model\CreateContact();
                    $createContact['email'] = Auth::user()->email;
                    $createContact['updateEnabled'] = true;
                    $createContact['listIds'] = [41];      
                    try {
                        $result = $apiInstance->createContact($createContact);
                    } catch (\Exception  $e) {
                        Log::info($e->getMessage());
                    }
                    return 'Request Voucher € 5.00 Successfully!';
                }else{
                    return 'You Are Not Eligible To Use This Voucher';
                }
            }else{
                return 'You Have Already Used This Voucher';
            }
        }

        if($typeVoucher == 'voucherTwentyFiveDollar'){
            $user = User::where('id', Auth::user()->id)->first();
            $statusVoucherOfUser = $user->voucher_twenty_five_dollar;
            if(empty($statusVoucherOfUser)){
                if($numberInviteAccept >= 50){
                    $user->voucher_twenty_five_dollar = 'used';
                    $user->save();

                    require_once(base_path() . '/vendor/autoload.php');

                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $createContact = new \SendinBlue\Client\Model\CreateContact();
                    $createContact['email'] = Auth::user()->email;
                    $createContact['updateEnabled'] = true;
                    $createContact['listIds'] = [42];      
                    try {
                        $result = $apiInstance->createContact($createContact);
                    } catch (\Exception  $e) {
                        Log::info($e->getMessage());
                    }
                    return 'Request Voucher € 25.00 Successfully!';
                }else{
                    return 'You Are Not Eligible To Use This Voucher';
                }
            }else{
                return 'You Have Already Used This Voucher';
            }
        }

        if($typeVoucher == 'voucherFiftyDollar'){
            $user = User::where('id', Auth::user()->id)->first();
            $statusVoucherOfUser = $user->voucher_fifty_dollar;
            if(empty($statusVoucherOfUser)){
                if($numberInviteAccept >= 100){
                    $user->voucher_fifty_dollar = 'used';
                    $user->save();

                    require_once(base_path() . '/vendor/autoload.php');

                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $createContact = new \SendinBlue\Client\Model\CreateContact();
                    $createContact['email'] = Auth::user()->email;
                    $createContact['updateEnabled'] = true;
                    $createContact['listIds'] = [43];      
                    try {
                        $result = $apiInstance->createContact($createContact);
                    } catch (\Exception  $e) {
                        Log::info($e->getMessage());
                    }
                    return 'Request Voucher € 50.00 Successfully!';
                }else{
                    return 'You Are Not Eligible To Use This Voucher';
                }
            }else{
                return 'You Have Already Used This Voucher';
            }
        }


        if($typeVoucher == 'voucherOneMonth'){
            $user = User::where('id', Auth::user()->id)->first();
            $statusVoucherOfUser = $user->voucher_one_month;
            if(empty($statusVoucherOfUser)){
                if($numberInviteAccept >= 1){
                    $user->voucher_one_month = 'used';
                    $user->save();

                    require_once(base_path() . '/vendor/autoload.php');

                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $createContact = new \SendinBlue\Client\Model\CreateContact();
                    $createContact['email'] = Auth::user()->email;
                    $createContact['updateEnabled'] = true;
                    $createContact['listIds'] = [44];      
                    try {
                        $result = $apiInstance->createContact($createContact);
                    } catch (\Exception  $e) {
                        Log::info($e->getMessage());
                    }
                    return 'Request Voucher 1 Month Of Free Memberschip Successfully!';
                }else{
                    return 'You Are Not Eligible To Use This Voucher';
                }
            }else{
                return 'You Have Already Used This Voucher';
            }
        }

        if($typeVoucher == 'voucherThreeMonth'){
            $user = User::where('id', Auth::user()->id)->first();
            $statusVoucherOfUser = $user->voucher_three_month;
            if(empty($statusVoucherOfUser)){
                if($numberInviteAccept >= 3){
                    $user->voucher_three_month = 'used';
                    $user->save();

                    require_once(base_path() . '/vendor/autoload.php');

                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $createContact = new \SendinBlue\Client\Model\CreateContact();
                    $createContact['email'] = Auth::user()->email;
                    $createContact['updateEnabled'] = true;
                    $createContact['listIds'] = [45];      
                    try {
                        $result = $apiInstance->createContact($createContact);
                    } catch (\Exception  $e) {
                        Log::info($e->getMessage());
                    }
                    return 'Request Voucher 3 Month Of Free Memberschip Successfully!';
                }else{
                    return 'You Are Not Eligible To Use This Voucher';
                }
            }else{
                return 'You Have Already Used This Voucher';
            }
        }

        if($typeVoucher == 'voucherOneYear'){
            $user = User::where('id', Auth::user()->id)->first();
            $statusVoucherOfUser = $user->voucher_one_year;
            if(empty($statusVoucherOfUser)){
                if($numberInviteAccept >= 10){
                    $user->voucher_one_year = 'used';
                    $user->save();

                    require_once(base_path() . '/vendor/autoload.php');

                    $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                    $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                        new GuzzleHttp\Client(),
                        $config
                    );
                    $createContact = new \SendinBlue\Client\Model\CreateContact();
                    $createContact['email'] = Auth::user()->email;
                    $createContact['updateEnabled'] = true;
                    $createContact['listIds'] = [46];      
                    try {
                        $result = $apiInstance->createContact($createContact);
                    } catch (\Exception  $e) {
                        Log::info($e->getMessage());
                    }
                    return 'Request Voucher 1 Year Of Free Memberschip Successfully!';
                }else{
                    return 'You Are Not Eligible To Use This Voucher';
                }
            }else{
                return 'You Have Already Used This Voucher';
            }
        }
    }

    public function getSubVectors(Request $request){
        $form_data = $request->all();
        if(!empty($form_data['vector_id'])){
            $travel_vectors=TravelVector::select('name', 'id')->where(['parent_id' => $form_data['vector_id']])->pluck('name', 'id')->toArray();
            if(!empty($travel_vectors)){
                echo json_encode($travel_vectors);
            }
        }
        die;
    }

    public function getTravelPro(Request $request){
        $form_data = $request->all();
        if(!empty($form_data['vector_id'])){
            $travel_vectors=User::select('user_name', 'id')->Where('role_type', 'travel_agency')->pluck('user_name', 'id')->toArray();

            if(!empty($travel_vectors)){
                echo json_encode($travel_vectors);
            }
        }
        die;
    }

    public function getImageSections(Request $request){
        $form_data = $request->all();
        $container_length = $form_data['container_length'] + 1;
        if(!empty($form_data['container_length']) && $form_data['container_length'] > 0){
            return view('frontend.travel_report.image_sections', compact('container_length'));
        }
    }

    public function removeTravelReportComponent(Request $request){
        $form_data = $request->all();
        $status = 0;
        if(!empty($form_data['vector_id'])){
            if(TravelReportComponent::where(['id' => $form_data['vector_id']])->delete()){
                $status = 1;
            }
        }
        echo $status; die;
    }


    public function removeGallery(Request $request){
        $form_data = $request->all();
        $status = 0;
        if(!empty($form_data['gallery_id'])){
            if(TravelReportGallery::where(['id' => $form_data['gallery_id']])->delete()){
                $status = 1;
            }
        }

        echo $status; die;
    }

      public function reserved_user(Request $request){
        $reportdata=TravelReports::where('user_id',$request->userid)->select('id','title')->get();
         // response()->json(['data'=>$reportdata]);

        if($reportdata->count()!==0){
            echo json_encode($reportdata);
        }else{
            return 0;
        }
    }

    public function travelreport(Request $request){
        //$user_id= implode(",", $request->user_id);
        $user_id = $request->user_id;
        $report_id= $request->report_id;
        $updatedata=TravelReportReserved::where('report_id',$report_id)->first();
        //dd($updatedata);
        if(!empty($updatedata)){
            $action_status=TravelReportReserved::where('report_id',$report_id)->update([
              'user_id' => $user_id,
              'report_id' => $report_id,
            ]);
        }else{

            $adddata= new TravelReportReserved;
            $adddata->user_id = $user_id;
            $adddata->report_id = $report_id;
            $adddata->save();
        }
        return redirect()->back();
    }

     public function reservedreport(Request $request){
        $reported_user_roles = [];
        if($request->user_role == 'travel_agency'){
            $reported_user_roles = ['traveler', 'travel_maker', 'travel_blogger', 'travel_agency'];
        }
        elseif($request->user_role == 'travel_blogger'){
            $reported_user_roles = ['traveler', 'travel_maker', 'travel_blogger'];
        }
        elseif($request->user_role == 'travel_maker'){
            $reported_user_roles = ['traveler', 'travel_maker'];
        }
        else{
            $reported_user_roles = ['traveler'];
        }
        $my_users = User::whereIn('role_type', $reported_user_roles)->where('id', '!=', $request->userid)->select('user_name', 'id')->pluck('user_name', 'id')->toArray();
        echo json_encode($my_users); die;
    }

    public function filterByAsc($word)
    {
        $places = $this->place->ascendingBy($word);
        return view('cms.place.index',compact('places'));
    }

    public function delete(String $slug){
        $a = TravelReports::where('slug', $slug)->delete();
        return redirect()->back()->withFlashSuccess(__('Travel report has been deleted successfully'));
    }

    public function delete_video($id){

        // $video = TravelReports::where('id',encrypt_decrypt('decrypt', $id))->update(array('slider_video' => ''));
        $video = TravelReports::where('id',$id)->update(array('slider_video' => ''));
        //dd($video);


      return redirect()->back()->withFlashSuccess(__('Video delete successfully'));
    }

    public function requestInvitation(Request $request)
    {
        try {
            $date = Carbon::now();
            $request->user()->update([
                'request_active_invitation' => 'pending',
                'request_invitation_date' => $date
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'failed',
            ], 500);
        }
    }

    public function listParticipate($id)
    {
        try {
            $travelPar = TravelReports::with('participates')->findOrfail($id);
            $html = view('frontend.includes.list-participate', ['travelPar' => $travelPar])->render();

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'html' => $html
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
