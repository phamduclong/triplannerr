<?php

namespace App\Http\Controllers\Frontend;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TravelReports\TravelReports;
use App\Models\TourReportSuper;
use App\Models\TourReportAlert;
use App\Models\TourReportFollower;
use App\Models\Country;
use App\Models\TravelAction;
use App\Models\Travelcategory;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\Advertisement;
use App\Models\AdsData;
use App\Models\Staticpage;
use App\Models\TravelBudget;
use App\Models\TravelFormula;
use App\Models\TravelFavoriteMealsType;
use Auth;
use App\Models\UserDetails;
use SendinBlue;
use GuzzleHttp;
use SendinBlue\Client;
/**

//use Illuminate\Support\Facades\Cache;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {

        if(Auth::user('id')==null)
        {
            return redirect()->guest('main-login');
        }

        $user_id = Auth::user()->id;
        $parameters = [];
        $travel_types = DB::table('travel_types')->pluck('name', 'name')->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'id')->toArray();
        $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_accommodations = DB::table('travel_vectors')->where(['vector_type' => 'overnight_stays'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_participates = DB::table('travel_participates')->pluck('name', 'name')->toArray();
        $travel_categ = Travelcategory::where('deleted_at', null)->orderby('id','desc')->pluck('name', 'id')->toArray();
        $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();
        $travel_formula = TravelFormula::orderby('name','asc')->pluck('name', 'name')->toArray();
        $travel_budget = TravelBudget::orderby('id','asc')->pluck('name', 'name')->toArray();
        $travel_mealtype = DB::table('travel_vectors')->orderby('id','desc')->where(['vector_type' => 'meals'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $countsuper = TravelAction::where('action','super')->count();
        $countalert = TravelAction::where('action','alert')->count();

        $travel_reports = TravelReports::withCount('supers', 'alerts', 'sametrip')->where(function($q) use ($user_id){
            $q->where([
                ['security_option', 'public'],
                ['account_status', '!=', 'pending'],
                ['account_status', '!=', 'cancel']
            ])
            ->orWhere('user_id', $user_id)
            ->orWhere(function($q) use ($user_id){
                return $q->whereHas('reserved_users', function($qr) use ($user_id){
                    return $qr->where('user_id', $user_id);
                });
            }); 
        })->orderBy('supers_count', 'desc')->paginate(9);
        
        /*->where('security_option', 'public')->orWhere('user_id', Auth::user()->id)
            ->orWhere(function($q) use ($user_id){
                return $q->whereHas('reserved_users', function($qr) use ($user_id){
                    return $qr->where('user_id', $user_id);
                });
        })*/
        $ads_data1 = Advertisement::orderByRaw('RAND()')->take(5)->where('status', '1')->where('view','home')->where('location','top')->orwhere('location','middle')->get();
        $ads_data_bottom = Advertisement::orderByRaw('RAND()')->take(3)->where('status', '1')->where('view','home')->where('location','bottom')->orwhere('location','footer')->get();
        //$ads_data1 = Advertisement::orderByRaw('RAND()')->take(5)->where('status', '1')->get();

        if(!empty($travel_reports->toArray())) {

            $travelData=$travel_reports->toArray();
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
      
        $travel_reports_reserved = TravelReports::withCount('supers', 'alerts')->orderBy('id', 'desc')->where('security_option', 'reserved')->paginate(9);

       // echo "<pre>"; print_r($categories); print_r($country_ids); print_r($userdata->preferred_travel_budget); die;
        
        if(!empty($categories) && !empty($country_ids) && !empty($userdata->preferred_travel_budget)) {
            $vector=!empty($userdata->vector_type)?explode(',', $userdata->vector_type):[];
            $acco=!empty($userdata->type_of_accommodation)?explode(',', $userdata->type_of_accommodation):[];
            $participant=!empty($userdata->type_of_participants)?explode(',', $userdata->type_of_participants):[];
            $favorite=!empty($userdata->travel_favoritemealtype)?explode(',', $userdata->travel_favoritemealtype):[];
            $adsCond=['status'=>1,'budget'=>$userdata->preferred_travel_budget];

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
        //dd($ads_data);
        $this->configcontact1();
       
        return view('frontend.index', compact('travel_categ','country_arr', 'travel_types', 'travel_ages', 'travel_vectors', 'travel_accommodations', 'travel_participates','countsuper','countalert', 'travel_reports','ads_data','travel_budget','travel_formula', 'parameters','travel_mealtype', 'travel_reports_reserved','userdata', 'ads_data', 'ads_data1','ads_data_bottom'));
    }

    public function configcontact1(){
        
        require_once(base_path() . '/vendor/autoload.php');

        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new SendinBlue\Client\Api\ContactsApi(
            new GuzzleHttp\Client(),
            $config
        );
        $createContact = new \SendinBlue\Client\Model\CreateContact(); 
        $createContact['email'] = Auth::user()->email;
       
        try {
            $result = $apiInstance->createContact($createContact);
        } catch (\Exception  $e) {
          
        }
        
    }

    public function main_login()
    {
        return view('frontend.main_login');
    }

    public function getfiltertravelreport(request $request){
     
        $parameters = $request->all();
        //dd($parameters);
        $user_id = Auth::user()->id;
        $travel_types = DB::table('travel_types')->pluck('name', 'name')->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'id')->toArray();
        $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_accommodations = DB::table('travel_accommodations')->pluck('name', 'name')->toArray();
        $travel_participates = DB::table('travel_participates')->pluck('name', 'name')->toArray();
        $travel_categ = Travelcategory::orderby('id','desc')->pluck('name', 'id')->toArray();
        $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();
        $travel_formula = TravelFormula::orderby('name','asc')->pluck('name', 'name')->toArray();
        $travel_budget = TravelBudget::orderby('name','desc')->pluck('name', 'name')->toArray();

        $travel_mealtype = DB::table('travel_vectors')->orderby('name','desc')->where(['vector_type' => 'meals'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();

        $travel_reports = TravelReports::with('userdata', 'category')->withCount('supers', 'alerts')->join('user_details', 'travel_reports.user_id', '=', 'user_details.user_id')->where(function($q) use ($user_id){
            $q->where([
                ['travel_reports.security_option', 'public'],
                ['travel_reports.account_status', '!=', 'pending'],
                ['travel_reports.account_status', '!=', 'cancel']
            ])
            ->orWhere('travel_reports.user_id', $user_id)
            ->orWhere(function($q) use ($user_id){
                return $q->whereHas('reserved_users', function($qr) use ($user_id){
                    return $qr->where('user_id', $user_id);
                });
            }); 
        });

     
        $userdata= UserDetails::where('user_id',$user_id)->first();

        if(!empty($request->age)){
            $age_ratio = getAgeRatio($request->age);
            $birth_date = $this->getdatediff($age_ratio);
            $explode_birth_string = explode('-', $birth_date);
            $start_date = date($explode_birth_string[1].'-01-01');
            $end_date = date($explode_birth_string[0].'-12-30');
            $travel_reports = $travel_reports->whereBetween('travel_reports.birth_place', [$start_date,$end_date]);
        }

        if (!empty($request->country)) {
            $country_id = $request->country;
            $travel_reports->where(function($q) use ($country_id){
                $q->whereRaw("FIND_IN_SET(?, travel_reports.country_destination)", [$country_id])->orWhere('travel_reports.country_departure', $country_id);
            });
        }

        if (!empty($request->travel_categ)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.category_id)", [$request->travel_categ]);
        }

        if (!empty($request->travel_type)) {
            $travel_reports->where('travel_reports.type_of_travel', $request->travel_type);

        }

        if (!empty($request->vector_type)) {
            
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.vector_type)", [$request->vector_type]);
           
        }


        if (!empty($request->type_of_accommodation)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.type_of_accommodation)", [$request->type_of_accommodation]);
        }

        if (!empty($request->type_of_participants)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.type_of_participants)", [$request->type_of_participants]);
        }

        if (!empty($request->preferred_type_formula)) {
            $travel_reports->where('travel_reports.preferred_type', $request->preferred_type_formula);
        }


        if (!empty($request->preferred_travel_budget)) {
            $travel_reports->where('travel_reports.preferred_travel_budget', $request->preferred_travel_budget);

        }

        if (!empty($request->preferred_travel_mealtype)) {
            $travel_reports->where('travel_reports.travel_favoritemealtype', $request->preferred_travel_mealtype);
            //dd($request->preferred_travel_mealtype);
        }

        $condition = ['status' => 1];
        //$condition = ['user_id' => $user_id];
        if($request->get('travel_categ')){

           $condition['category_id'] = $request->get('travel_categ');

        } 

        if($request->get('country')){

           $condition['country_departure'] = $request->get('country');

        } 

        if($request->get('age')){

           $condition['age'] = $request->get('age');

        } 

        if($request->get('travel_type')){

           $condition['travel_type'] = $request->get('travel_type');

        } 

        if($request->get('vector_type')){

           $condition['vector_type'] = $request->get('vector_type');

        } 

        if($request->get('travel_accommodations')){

           $condition['type_of_accomodation'] = $request->get('travel_accommodations');

        } 

        if($request->get('travel_participates')){

           $condition['type_of_participant'] = $request->get('travel_participates');

        } 

        if($request->get('travel_formula')){

           $condition['preffered_stay_formula'] = $request->get('travel_formula');

        } 

        if($request->get('travel_mealtype')){

           $condition['type_of_fav_meal'] = $request->get('travel_mealtype');

        }

        if($request->get('travel_budget')){

           $condition['budget'] = $request->get('travel_budget');

        }

        $ads_data = Advertisement::orderByRaw('RAND()')->take(5)->where($condition)->where('location','top')->orwhere('location','middle')->get();
        $ads_data_bottom = Advertisement::orderByRaw('RAND()')->take(3)->where($condition)->where('location','bottom')->orwhere('location','footer')->get();
         //echo '<pre>'; print_r( $ads_data);exit;

        // $travel_reports = TravelReports::withCount('supers', 'alerts', 'sametrip')->where(function($q) use ($user_id){
        //     $q->where('security_option', 'public')
        //     ->orWhere('user_id', $user_id)
        //     ->orWhere(function($q) use ($user_id){
        //         return $q->whereHas('reserved_users', function($qr) use ($user_id){
        //             return $qr->where('user_id', $user_id);
        //         });
        //     }); 
        // })->orderBy('id', 'desc')->get();
        

        // $travel_reports = TravelReports::withCount('supers', 'alerts', 'sametrip')->where(function($q) use ($user_id){
        //     $q->where('security_option', 'public')
        //     ->orWhere('user_id', $user_id)
        //     ->orWhere(function($q) use ($user_id){
        //         return $q->whereHas('reserved_users', function($qr) use ($user_id){
        //             return $qr->where('user_id', $user_id);
        //         });
        //     }); 
        // })->orderBy('supers_count', 'desc')->get();
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_report'){
            $travel_reports = $travel_reports->where('travel_reports.role_type', 'traveler')
                           ->orWhere([
                                ['travel_reports.role_type', 'travel_maker'],
                                ['travel_reports.report_option', 'report']
                           ]);
        }
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_buddy_search'){
            $travel_reports = $travel_reports->where([
                                ['travel_reports.role_type', 'travel_maker'],
                                ['travel_reports.report_option', 'offer']
                           ]);
        }
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_post'){
            $travel_reports = $travel_reports->where('travel_reports.role_type', 'travel_blogger');
        }
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_offert'){
            $travel_reports = $travel_reports->where('travel_reports.role_type', 'travel_agency');
        }
        $travel_reports = $travel_reports->orderBy('supers_count', 'desc')->take(9)->get();

        return view('frontend.home.search', compact('travel_categ','ads_data_bottom','country_arr', 'travel_types', 'travel_ages', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'parameters', 'travel_reports', 'travel_formula', 'travel_budget','travel_mealtype', 'ads_data', 'condition', 'userdata'));

    }

    public function showMoreReportsForHome(Request $request){
        $parameters = $request->all();
        //dd($parameters);
        $user_id = Auth::user()->id;
        $travel_types = DB::table('travel_types')->pluck('name', 'name')->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'id')->toArray();
        $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_accommodations = DB::table('travel_accommodations')->pluck('name', 'name')->toArray();
        $travel_participates = DB::table('travel_participates')->pluck('name', 'name')->toArray();
        $travel_categ = Travelcategory::orderby('id','desc')->pluck('name', 'id')->toArray();
        $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();
        $travel_formula = TravelFormula::orderby('name','asc')->pluck('name', 'name')->toArray();
        $travel_budget = TravelBudget::orderby('name','desc')->pluck('name', 'name')->toArray();

        $travel_mealtype = DB::table('travel_vectors')->orderby('name','desc')->where(['vector_type' => 'meals'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();

        $travel_reports = TravelReports::with('userdata', 'category')->withCount('supers', 'alerts')->join('user_details', 'travel_reports.user_id', '=', 'user_details.user_id')->where(function($q) use ($user_id){
            $q->where([
                ['travel_reports.security_option', 'public'],
                ['travel_reports.account_status', '!=', 'pending'],
                ['travel_reports.account_status', '!=', 'cancel']
            ])
            ->orWhere('travel_reports.user_id', $user_id)
            ->orWhere(function($q) use ($user_id){
                return $q->whereHas('reserved_users', function($qr) use ($user_id){
                    return $qr->where('user_id', $user_id);
                });
            }); 
        });

     
        $userdata= UserDetails::where('user_id',$user_id)->first();

        if(!empty($request->age)){
            $age_ratio = getAgeRatio($request->age);
            $birth_date = $this->getdatediff($age_ratio);
            $explode_birth_string = explode('-', $birth_date);
            $start_date = date($explode_birth_string[1].'-01-01');
            $end_date = date($explode_birth_string[0].'-12-30');
            $travel_reports = $travel_reports->whereBetween('travel_reports.birth_place', [$start_date,$end_date]);
        }

        if (!empty($request->country)) {
            $country_id = $request->country;
            $travel_reports->where(function($q) use ($country_id){
                $q->whereRaw("FIND_IN_SET(?, travel_reports.country_destination)", [$country_id])->orWhere('travel_reports.country_departure', $country_id);
            });
        }

        if (!empty($request->travel_categ)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.category_id)", [$request->travel_categ]);
        }

        if (!empty($request->travel_type)) {
            $travel_reports->where('travel_reports.type_of_travel', $request->travel_type);

        }

        if (!empty($request->vector_type)) {
            
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.vector_type)", [$request->vector_type]);
           
        }


        if (!empty($request->type_of_accommodation)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.type_of_accommodation)", [$request->type_of_accommodation]);
        }

        if (!empty($request->type_of_participants)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.type_of_participants)", [$request->type_of_participants]);
        }

        if (!empty($request->preferred_type_formula)) {
            $travel_reports->where('travel_reports.preferred_type', $request->preferred_type_formula);
        }


        if (!empty($request->preferred_travel_budget)) {
            $travel_reports->where('travel_reports.preferred_travel_budget', $request->preferred_travel_budget);

        }

        if (!empty($request->preferred_travel_mealtype)) {
            $travel_reports->where('travel_reports.travel_favoritemealtype', $request->preferred_travel_mealtype);
            //dd($request->preferred_travel_mealtype);
        }

        $condition = ['status' => 1];
        //$condition = ['user_id' => $user_id];
        if($request->get('travel_categ')){

           $condition['category_id'] = $request->get('travel_categ');

        } 

        if($request->get('country')){

           $condition['country_departure'] = $request->get('country');

        } 

        if($request->get('age')){

           $condition['age'] = $request->get('age');

        } 

        if($request->get('travel_type')){

           $condition['travel_type'] = $request->get('travel_type');

        } 

        if($request->get('vector_type')){

           $condition['vector_type'] = $request->get('vector_type');

        } 

        if($request->get('travel_accommodations')){

           $condition['type_of_accomodation'] = $request->get('travel_accommodations');

        } 

        if($request->get('travel_participates')){

           $condition['type_of_participant'] = $request->get('travel_participates');

        } 

        if($request->get('travel_formula')){

           $condition['preffered_stay_formula'] = $request->get('travel_formula');

        } 

        if($request->get('travel_mealtype')){

           $condition['type_of_fav_meal'] = $request->get('travel_mealtype');

        }

        if($request->get('travel_budget')){

           $condition['budget'] = $request->get('travel_budget');

        }

        $ads_data = Advertisement::orderByRaw('RAND()')->take(5)->where($condition)->where('location','top')->orwhere('location','middle')->get();
        $ads_data_bottom = Advertisement::orderByRaw('RAND()')->take(3)->where($condition)->where('location','bottom')->orwhere('location','footer')->get();
         
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_report'){
            $travel_reports = $travel_reports->where('travel_reports.role_type', 'traveler')
                           ->orWhere([
                                ['travel_reports.role_type', 'travel_maker'],
                                ['travel_reports.report_option', 'report']
                           ]);
        }
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_buddy_search'){
            $travel_reports = $travel_reports->where([
                                ['travel_reports.role_type', 'travel_maker'],
                                ['travel_reports.report_option', 'offer']
                           ]);
        }
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_post'){
            $travel_reports = $travel_reports->where('travel_reports.role_type', 'travel_blogger');
        }
        if(isset($request->type_of_travel_report) && $request->type_of_travel_report == 'travel_offert'){
            $travel_reports = $travel_reports->where('travel_reports.role_type', 'travel_agency');
        }

        $PAGE = $request->page;
        $travel_reports = $travel_reports->orderBy('supers_count', 'desc')->take(9*$PAGE)->get();

        return view('frontend.home.more_travel_reports', compact('travel_categ','ads_data_bottom','country_arr', 'travel_types', 'travel_ages', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'parameters', 'travel_reports', 'travel_formula', 'travel_budget','travel_mealtype', 'ads_data', 'condition', 'userdata'));
    }

    //get date year diffrence
    public function getdatediff($birth_date){

        $cureent_date = date('Y');

        $explode_birth_arr = explode('-',$birth_date);
        if(count($explode_birth_arr) < 2){
            $explode_birth_arr = ['30', '100'];
        }

        $firstrange = date('Y', strtotime('- '.$explode_birth_arr[0].' Years'));

        $second_range = date('Y', strtotime('- '.$explode_birth_arr[1].' Years'));

        $combine_string = $firstrange.'-'.$second_range;

        return ($combine_string)?$combine_string:'';
    }
    

    public function Characteristics_conditions($role){
        $role_type=$role; 
       return view('frontend.characteristics',compact('role_type'));
    }
    
    public function ads_click(Request $request)
    {
        $update_ads=AdsData::where('ip_address',$request->userip)->where('ad_id',$request->ad_id)->first();
         if(!empty($update_ads)){
            
              $update_ads->ip_address=$request->userip;
              $update_ads->ad_id=$request->ad_id;
              $update_ads->save(); 

         }else{
           
              $ads=new AdsData;
              $ads->ip_address=$request->userip;
              $ads->ad_id=$request->ad_id;
              $ads->save();
         }
      
    }

    public function loadmoredata(Request $request){
    
   
       $parameters = $request->all();
       //dd($parameters);

        $travel_types = DB::table('travel_types')->pluck('name', 'id')->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'id')->toArray();
        $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'id')->toArray();
        $travel_accommodations = DB::table('travel_accommodations')->pluck('name', 'id')->toArray();
        $travel_participates = DB::table('travel_participates')->pluck('name', 'id')->toArray();
        $travel_categ = Travelcategory::orderby('id','desc')->pluck('name', 'id')->toArray();
        $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();

        $travel_reports = TravelReports::with('userdata', 'category')->withCount('supers', 'alerts')->join('user_details', 'travel_reports.user_id', '=', 'user_details.user_id');        

        if (!empty($request->travel_categ)) {
            $travel_reports = $travel_reports->where('travel_reports.category_id', $request->travel_categ);
        }

        if(!empty($request->age)){
            $age_ratio = getAgeRatio($request->age);
            $birth_date = $this->getdatediff($age_ratio);
            $explode_birth_string = explode('-', $birth_date);
            $start_date = date($explode_birth_string[1].'-01-01');
            $end_date = date($explode_birth_string[0].'-12-30');
            $travel_reports = $travel_reports->whereBetween('travel_reports.birth_place', [$start_date,$end_date]);

        }

        if (!empty($request->country)) {
            $travel_reports = $travel_reports->where('travel_reports.country_destination', $request->country)->orWhere('travel_reports.country_departure', $request->country);
        }

        if (!empty($request->traveltype)) {
            $travel_reports = $travel_reports->where('travel_reports.type_of_travel', $request->traveltype);
        }

        if (!empty($request->vectortype)) {
            $travel_reports = $travel_reports->whereRaw("FIND_IN_SET(?, vector_type) > 0", [$request->vectortype]);
        }


        if (!empty($request->typeaccommodation)) {
            $travel_reports = $travel_reports->where('travel_reports.type_of_accommodation', $request->typeaccommodation);
        }

        if (!empty($request->type_of_participants)) {
            $travel_reports = $travel_reports->where('travel_reports.type_of_participants', $request->type_of_participants);
        }

        if (!empty($request->preferred_type_formula)) {
            $travel_reports = $travel_reports->where('travel_reports.preferred_type', $request->preferred_type_formula);
        }


        if (!empty($request->preferred_travel_budget)) {
            $travel_reports = $travel_reports->where('travel_reports.preferred_travel_budget', $request->preferred_travel_budget);
        }

        //$travel_reports = $travel_reports->get();

        $travel_reports = $travel_reports->orderBy('id', 'desc')->get();
        /*$alert_reports = $travel_reports->orderBy('alerts_count', 'desc')->get();*/

        return view('frontend.home.search', compact('travel_categ','country_arr', 'travel_types', 'travel_ages', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'parameters', 'travel_reports'));

       
    }
    public function staticPage($pageslug=null)
    {
      $pages=Staticpage::where('url',$pageslug)->first();
      
      $slug=$pageslug;
      
       return view('frontend.pages.static_pages',compact('pages','slug'));
    } 
    public function staticPages(Request $request)
    {
      $pageslug = $request->path();
      $pages=Staticpage::where('url',$pageslug)->first();
      
      $slug=$pageslug;
      
       return view('frontend.pages.static_pages',compact('pages','slug'));
    } 


    public function cropImage(Request $request){

        $form_data = $request->all();
        // print_r($form_data);die; 
        $data = $form_data["image"];

        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $imageName = time().'.png';
        if(!file_exists(public_path().'/crop_images/')){
            mkdir(public_path().'/crop_images/');
        }
        $temp_directory = public_path().'/crop_images/';
        file_put_contents(public_path().'/crop_images/'.$imageName, $data);

        $response = [
            'status'        => 200,
            'image'         => $imageName,
            'folder_path'   => $temp_directory,
            'image_url'     => url('/crop_images/'.$imageName),
        ];
        /*echo '<img src="'.url('/crop_images/'.$imageName).'" class="img-thumbnail" />';*/
        echo json_encode($response); die;
    }



}


