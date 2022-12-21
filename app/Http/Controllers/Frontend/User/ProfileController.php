<?php

namespace App\Http\Controllers\Frontend\User;
use Auth;
use DB;
use Validator;
use Mail;

use App\Actions\StoreUserDetailsAction;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\Auth\Role;
use App\Models\Advertisement;
use App\Models\Country;
use App\Models\Travelcategory;
use App\Models\Category;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Repositories\Backend\AdvertisementRepository;
use App\Models\UserImages;
use App\Models\UserDetails;
use App\Models\TravelSituation;
use App\Models\Countries\Countries;
use App\Models\TravelReports\TravelReports;
use App\Models\TourReportSuper;
use App\Models\TourReportAlert;
use App\Models\TravelTypes;
use App\Models\TravelParticipate;
use App\Models\TravelAge;
use App\Models\TravelAction;
use App\Models\TravelVector;
use App\Models\Conversation;
use App\Models\TravelFavoriteMealsType;
use App\Models\TravelBudget;
use App\Models\TravelFormula;
use App\Models\TravelAccommodation;
use App\Models\TourReportFollowers;
use App\Models\CollaborationRequest;
use App\Models\SameTrip;
use App\Models\SocialSetting;
use App\Models\UserParticipate;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use SendinBlue;
use GuzzleHttp;
use SendinBlue\Client;
use App\Events\ChangeUserFollows;
use App\Events\ChangeLikeAndAlertTravelReport;
use App\Models\InviteFriend;
use Log;
use Carbon\Carbon;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;


use function PHPSTORM_META\type;

class ProfileController extends Controller
{

    protected $userRepository;
    protected $advertisementRepository;

    public function __construct(UserRepository $userRepository,AdvertisementRepository $advertisementRepository)
    {
        $this->userRepository = $userRepository;
        $this->advertisementRepository = $advertisementRepository;
    }


    public function index($role, $fullname, Request $request) {

        $user = Auth::user();
        $userdata= UserDetails::where('user_id',$user->id)->first();
        $travelreport_data = TravelReports::where('user_id',$user->id)->get();
        // print_r($travel_reports);
        // exit(0);


        return view('frontend.user.profile');

    }











    //***********************************************************************/
    //*************************** OLD FUNCTIONS *****************************/
    //***********************************************************************/

    public function loadmoredata1(Request $request){
    //dd('gg');

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

    public function updateCoverImage(Request $request, StoreUserDetailsAction $storeUserDetailsAction){
        $storeUserDetailsAction->updateCoverImage($request);
        return redirect(url('profile/'.Auth::user()->role_type.'/'.strtolower(Auth::user()->first_name.Auth::user()->last_name).'/'.Auth::user()->id));
    }

    public function updateProfileImage(Request $request, StoreUserDetailsAction $storeUserDetailsAction){
        $storeUserDetailsAction->updateProfileImage($request);
        return redirect(url('profile/'.Auth::user()->role_type.'/'.strtolower(Auth::user()->first_name.Auth::user()->last_name).'/'.Auth::user()->id));
    }

    public function update(UpdateProfileRequest $request, StoreUserDetailsAction $storeUserDetailsAction){

        // $validator=Validator::make($request->all(),[
        //     'userdetail_profile_image' =>'mimes:jpeg,jpg,png,gif|max:20000',
        //     //'userdetail_cover_image' =>'mimes:jpeg,jpg,png,gif|max:20000',
        //     'doc_upload' => 'mimes:doc,docx|max:10000',
        //     'agency_logo' => 'mimes:jpeg,jpg,png,gif|max:10000',
        //     'doc_agency_data' => 'mimes:pdf,xlx,csv|max:10000',
        //     'doc_agency_doc' => 'mimes:pdf,xlx,csv|max:10000',
        //     'signed_doc' => 'mimes:pdf,xlx,csv|max:10000',
        // ]);
        // if(Auth::user()->email != $request->email){
        //     $checkEmailExit = User::where('email', $request->email)->first();
        //     if(empty($checkEmailExit)){
        //         $USER = User::where('id', Auth::user()->id)->first();
        //         $USER->email = $request->email;
        //         $USER->save();


        //         require_once(base_path() . '/vendor/autoload.php');

        //         $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        //         $apiInstance = new SendinBlue\Client\Api\ContactsApi(
        //             new GuzzleHttp\Client(),
        //             $config
        //         );
        //         $listId = 38;
        //         $contactIdentifiers = new \SendinBlue\Client\Model\RemoveContactFromList();
        //         $contactIdentifiers['emails'] = array(Auth::user()->email);
        //         $contactIdentifiers['updateEnabled'] = true;
                        
        //         try {
        //             $result = $apiInstance->removeContactFromList($listId, $contactIdentifiers);
        //         } catch (\Exception  $e) {
        //             Log::info($e->getMessage());
        //         }



        //         $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        //         $apiInstance = new SendinBlue\Client\Api\ContactsApi(
        //             new GuzzleHttp\Client(),
        //             $config
        //         );
        //         $createContact = new \SendinBlue\Client\Model\CreateContact();
        //         $createContact['email'] = $request->email;
        //         $createContact['updateEnabled'] = true;
        //         $createContact['listIds'] = [38];
                
                        
        //         try {
        //             $result = $apiInstance->createContact($createContact);
        //         } catch (\Exception  $e) {
        //             Log::info($e->getMessage());
        //         }

        //         $storeUserDetailsAction->execute($request);
        //         // if(Auth::user()->role_type == 'travel_agency'){
        //         //     return redirect(url('/view-plans/'.Auth::user()->id));
        //         // }
        //         // return redirect(url('profile/'.Auth::user()->role_type.'/'.strtolower(Auth::user()->first_name.Auth::user()->last_name).'/'.Auth::user()->id))->withFlashSuccess(__('strings.frontend.user.profile_updated'));


        //         auth()->logout();
        //     }else{
        //         return redirect()->back()->withFlashWarning(__('Email already exists'));
        //     }
            
        // }
        $oldUser = Auth::user();
        $oldEmail = $oldUser->email;
        $storeUserDetailsAction->execute($request);
        $newUser = $oldUser->fresh();
        if($newUser->email != $oldEmail){
            require_once(base_path() . '/vendor/autoload.php');

            $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
            $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                new GuzzleHttp\Client(),
                $config
            );
            $createContact = new \SendinBlue\Client\Model\CreateContact();
            $createContact['email'] = $oldEmail;
            $createContact['updateEnabled'] = true;
            $createContact['listIds'] = [49];
            
                    
            try {
                $result = $apiInstance->createContact($createContact);
            } catch (\Exception  $e) {
                Log::info($e->getMessage());
            }

            $newUser->notify(new UserNeedsConfirmation($newUser->confirmation_code));
            auth()->logout($newUser);
            return redirect()->guest('main-register')->withFlashSuccess(
                config('access.users.requires_approval') ?
                    __('exceptions.frontend.auth.confirmation.created_pending') :
                    __('exceptions.frontend.auth.confirmation.created_confirm')
            );
        }

        // if(Auth::user()->role_type == 'travel_agency'){
        //     return redirect(url('/view-plans/'.Auth::user()->id));
        // }
        return redirect(url('profile/'.Auth::user()->role_type.'/'.strtolower(Auth::user()->first_name.Auth::user()->last_name).'/'.Auth::user()->id))->withFlashSuccess(__('strings.frontend.user.profile_updated'));

        if($request->role_type =='traveler'){

            $id = Auth::user()->id;
            $user=UserDetails::where('user_id',$id)->first();

            if(!empty($user))
            {
                $updateuser_data = new UserDetails();
                $updateuser_data->sex=isset($request->sex)?$request->sex:'';
                $updateuser_data->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';
                $updateuser_data->birth_place=isset($request->birth_place)?$request->birth_place:'';
                $updateuser_data->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $updateuser_data->preferred_type=isset($request->preferred_type)?$request->preferred_type:'';
                $updateuser_data->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $updateuser_data->type_of_travel=isset($request->type_of_travel)?$request->type_of_travel:'';

                $updateuser_data->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $updateuser_data->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';

                 $updateuser_data->sentimental_situation=isset($request->sentimental_situation)?$request->sentimental_situation:'';

                if(isset($request->preferred_travel_category) && !empty($request->preferred_travel_category))
                {
                    $preferred_travel_category_implode=implode(',',$request->preferred_travel_category);
                    $updateuser_data->preferred_travel_category=isset($preferred_travel_category_implode)?$preferred_travel_category_implode:'';
                }

                $updateuser_data->preferred_travel_budget=isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';

                $updateuser_data->travel_favoritemealtype=isset($request->travel_favoritemealtype)?$request->travel_favoritemealtype:'';

                if(isset($request->type_of_accommodation) && !empty($request->type_of_accommodation))
                {
                    $type_of_accommodation_implode=implode(',',$request->type_of_accommodation);
                    $updateuser_data->type_of_accommodation=isset($type_of_accommodation_implode)?$type_of_accommodation_implode:'';
                }


                if(isset($request->vector_type) && !empty($request->vector_type))
                {
                    $vector_type_implode=implode(',',$request->vector_type);
                    $updateuser_data->vector_type=isset($vector_type_implode)?$vector_type_implode:'';
                }


                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $updateuser_data->fav_nation=isset($fav_nation)?$fav_nation:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $updateuser_data->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }


                if(isset($request->type_of_participants) && !empty($request->type_of_participants))
                {
                    $type_of_participants_implode=implode(',',$request->type_of_participants);
                    $updateuser_data->type_of_participants=isset($type_of_participants_implode)?$type_of_participants_implode:'';
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $updateuser_data->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }


                if($request->File('userdetail_identity_document'))
                {
                    $doc_fileName = time().'.'.$request->file('userdetail_identity_document')->extension();
                    $request->file('userdetail_identity_document')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }else{
                    $doc_fileName = $updateuser_data->identity_document;
                }
                $updateuser_data->identity_document = isset($doc_fileName)?$doc_fileName:'';


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }else{
                    $cover_img_name = $updateuser_data->cover_image;
                }
                $updateuser_data->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                else{
                    $profile_img_name = $updateuser_data->profile_image;
                }
                $updateuser_data->profile_image = isset($profile_img_name)?$profile_img_name:'';
                $updateuser_data->save();
            }
            else{

                $add_userdata = new UserDetails;
                $add_userdata->role_type = 'traveler';
                $add_userdata->user_id = $id;

                //dd($add_userdata);
                if(isset($request->birth_place) && !empty($request->birth_place))
                {
                    $add_userdata->birth_place=isset($request->birth_place)?$request->birth_place:'';
                }


                if(isset($request->sex) && !empty($request->sex))
                {
                    $add_userdata->sex=isset($request->sex)?$request->sex:'';
                }


                $add_userdata->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';

                $add_userdata->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $add_userdata->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $add_userdata->preferred_type=isset($request->preferred_type)?$request->preferred_type:'0';

                $add_userdata->classification_travel_report=isset($request->classification_travel_report)?$request->classification_travel_report:'';


                 $add_userdata->sentimental_situation=isset($request->sentimental_situation)?$request->sentimental_situation:'';



                $add_userdata->type_of_travel=isset($request->type_of_travel)?$request->type_of_travel:'';

                $add_userdata->travel_favoritemealtype=isset($request->travel_favoritemealtype)?$request->travel_favoritemealtype:'';

                $add_userdata->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $add_userdata->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';


                if(isset($request->type_of_accommodation) && !empty($request->type_of_accommodation)){
                    $type_of_accommodation_implode=implode(',',$request->type_of_accommodation);
                    $add_userdata->type_of_accommodation=isset($type_of_accommodation_implode)?$type_of_accommodation_implode:'';
                }

                if(isset($request->preferred_travel_category) && !empty($request->preferred_travel_category)){
                    $preferred_travel_category_implode=implode(',',$request->preferred_travel_category);
                    $add_userdata->preferred_travel_category=isset($preferred_travel_category_implode)?$preferred_travel_category_implode:'';
                }



                if(isset($request->vector_type) && !empty($request->vector_type)){
                    $vector_type_implode=implode(',',$request->vector_type);
                    $add_userdata->vector_type=isset($vector_type_implode)?$vector_type_implode:'';
                }


                 if(isset($request->type_of_participants) && !empty($request->type_of_participants)){
                    $type_of_participants_implode=implode(',',$request->type_of_participants);
                    $add_userdata->type_of_participants=isset($type_of_participants_implode)?$type_of_participants_implode:'';
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals)){
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $add_userdata->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }

                $add_userdata->preferred_travel_budget=isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';


                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $add_userdata->fav_nation=isset($fav_nation)?$fav_nation:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $add_userdata->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }


                if ($request->File('userdetail_identity_document'))
                {

                    $doc_fileName = time().'.'.$request->file('userdetail_identity_document')->extension();
                    $request->file('userdetail_identity_document')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }
                $add_userdata->identity_document = isset($doc_fileName)?$doc_fileName:'';


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }
                $add_userdata->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                $add_userdata->profile_image = isset($profile_img_name)?$profile_img_name:'';

                $add_userdata->save();
            }
        }

        $output = $this->userRepository->update(
            $request->user()->id,
            $request->only('first_name', 'last_name', 'email', 'avatar_location'),
            $request->all(),
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        $this->userRepository->completeRegistration($request->user()->id);

        $id = Auth::user()->id;

        if($request->role_type =='travel_blogger'){
            $request->validate([
                'userdetail_vat_number' => 'required',
            ]);
        }

        if($request->role_type =='travel_agency'){
            $request->validate([
                'userdetail_describe_yourself' => 'max:500',
                 'userdetail_vat_number' => 'required',
            ]);

            if(empty($request->userdetail_doc_upload) && empty($request->doc_upload_hide)){

                $request->validate([
                    'doc_upload' => 'required|mimes:doc,docx|max:10000',
                ]);
            }

            $updateuser_data=UserDetails::where('user_id',$id)->where('role_type','travel_agency')->first();

            if(!empty($updateuser_data)){

                $updateuser_data->sex=isset($request->sex)?$request->sex:'';
                $updateuser_data->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';
                $updateuser_data->birth_place=isset($request->birth_place)?$request->birth_place:'';
                $updateuser_data->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $updateuser_data->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $updateuser_data->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';
                $updateuser_data->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $updateuser_data->fb_link=isset($request->userdetail_fb_link)?$request->userdetail_fb_link:'';
                $updateuser_data->twitter_link=isset($request->userdetail_twitter_link)?$request->userdetail_twitter_link:'';
                $updateuser_data->insta_link=isset($request->userdetail_insta_link)?$request->userdetail_insta_link:'';
                $updateuser_data->pinterest_link=isset($request->userdetail_pinterest_link)?$request->userdetail_pinterest_link:'';
                $updateuser_data->tiktok_link=isset($request->userdetail_tiktok_link)?$request->userdetail_tiktok_link:'';
                $updateuser_data->youtube_link=isset($request->userdetail_youtube_link)?$request->userdetail_youtube_link:'';
                $updateuser_data->vat_number=isset($request->userdetail_vat_number)?$request->userdetail_vat_number:'';
                $updateuser_data->agency_name=isset($request->userdetail_agency_name)?$request->userdetail_agency_name:'';
                $updateuser_data->agency_website=isset($request->userdetail_agency_website)?$request->userdetail_agency_website:'';
                $updateuser_data->agency_address=isset($request->userdetail_agency_address)?$request->userdetail_agency_address:'';
                $updateuser_data->license_detail=isset($request->userdetail_license_detail)?$request->userdetail_license_detail:'';
                $updateuser_data->other=isset($request->other)?$request->other:'';

                if(isset($request->identification_option) && !empty($request->identification_option))
                {
                    $identification_option_implode=implode(',',$request->identification_option);
                    $updateuser_data->identification_option=isset($identification_option_implode)?$identification_option_implode:'';
                }

                 if(isset($request->preferred_travel_category) && !empty($request->preferred_travel_category))
                {
                    $preferred_travel_category_implode=implode(',',$request->preferred_travel_category);
                    $updateuser_data->preferred_travel_category=isset($preferred_travel_category_implode)?$preferred_travel_category_implode:'';
                }

                if(isset($request->local_operator) && !empty($request->local_operator))
                {
                    $local_operator_implode=implode(',',$request->local_operator);
                    $updateuser_data->local_operator=isset($local_operator_implode)?$local_operator_implode:'';
                }


                if(isset($request->tourist_facility) && !empty($request->tourist_facility))
                {
                    $tourist_facility_implode=implode(',',$request->tourist_facility);
                    $updateuser_data->tourist_facility=isset($tourist_facility_implode)?$tourist_facility_implode:'';
                }


                if(isset($request->sentimental_situation) && !empty($request->sentimental_situation))
                {
                    $sentimental_situation_implode=implode(',',$request->sentimental_situation);
                    $updateuser_data->sentimental_situation=isset($sentimental_situation_implode)?$sentimental_situation_implode:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $updateuser_data->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }

                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $updateuser_data->fav_nation=isset($fav_nation)?$fav_nation:'';
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $updateuser_data->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }else{
                    $cover_img_name = $updateuser_data->cover_image;
                }
                $updateuser_data->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){

                            $profile_img_name = $request->userdetail_profile_image;

                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                else{
                    $profile_img_name = $updateuser_data->profile_image;
                }
                $updateuser_data->profile_image = isset($profile_img_name)?$profile_img_name:'';


                if($request->hasFile('userdetail_agency_logo'))
                {
                    $image = $request->file('userdetail_agency_logo'); //get the file
                    $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
                    $destinationPath = public_path('/img/frontend/user/agency_logo'); //public path
                    $image->move($destinationPath, $img_name);  //mve to destination you mentioned
                }
                else{
                    $img_name = $updateuser_data->agency_logo;
                }
                $updateuser_data->agency_logo = isset($img_name)?$img_name:'';


                if ($request->File('userdetail_doc_upload'))
                {
                    $doc_fileName = time().'.'.$request->file('userdetail_doc_upload')->extension();
                    $request->file('userdetail_doc_upload')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }
                else{
                    $doc_fileName = $updateuser_data->doc_upload;
                }
                $updateuser_data->doc_upload = isset($doc_fileName)?$doc_fileName:'';


                if($request->File('userdetail_doc_agency_data'))
                {

                    $pdf_fileName = time().'.'.$request->file('userdetail_doc_agency_data')->extension();
                    $request->File('userdetail_doc_agency_data')->move(public_path('uploads/frontend/pdf'), $pdf_fileName);
                }
                else{
                    $pdf_fileName = $updateuser_data->doc_agency_data;
                }
                $updateuser_data->doc_agency_data = isset($pdf_fileName)?$pdf_fileName:'';


                if ($request->File('userdetail_doc_agency_doc'))
                {

                  $pdf_fileName1 = time().'.'.$request->file('userdetail_doc_agency_doc')->extension();
                  $request->File('userdetail_doc_agency_doc')->move(public_path('uploads/frontend/pdf'), $pdf_fileName1);

                }
                else{
                    $pdf_fileName1 = $updateuser_data->doc_agency_doc;
                }
                $updateuser_data->doc_agency_doc = isset($pdf_fileName1)?$pdf_fileName1:'';


                if($request->File('userdetail_signed_doc'))
                {
                    $signed_pdf = time().'.'.$request->file('userdetail_signed_doc')->extension();
                    $request->File('userdetail_signed_doc')->move(public_path('uploads/frontend/pdf'), $signed_pdf);
                }
                else{
                    $signed_pdf = $updateuser_data->signed_doc;
                }
                $updateuser_data->signed_doc = isset($signed_pdf)?$signed_pdf:'';


                $updateuser_data->cover_image = isset($cover_img_name)?$cover_img_name:'';


                $updateuser_data->save();
            }
            else{
                $add_userdata = new UserDetails;

                $add_userdata->role_type = 'travel_agency';

                $add_userdata->user_id = $id;
                if(isset($request->birth_place) && !empty($request->birth_place))
                {
                    $add_userdata->birth_place=isset($request->birth_place)?$request->birth_place:'';
                }

                if(isset($request->sex) && !empty($request->sex))
                {
                    $add_userdata->sex=isset($request->sex)?$request->sex:'';
                }


                $add_userdata->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';
                $add_userdata->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $add_userdata->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $add_userdata->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $add_userdata->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';
                $add_userdata->fb_link=isset($request->userdetail_fb_link)?$request->userdetail_fb_link:'';
                $add_userdata->twitter_link=isset($request->userdetail_twitter_link)?$request->userdetail_twitter_link:'';
                $add_userdata->insta_link=isset($request->userdetail_insta_link)?$request->userdetail_insta_link:'';
                $add_userdata->pinterest_link=isset($request->userdetail_pinterest_link)?$request->userdetail_pinterest_link:'';
                $add_userdata->tiktok_link=isset($request->userdetail_tiktok_link)?$request->userdetail_tiktok_link:'';
                $add_userdata->youtube_link=isset($request->userdetail_youtube_link)?$request->userdetail_youtube_link:'';
                $add_userdata->vat_number=isset($request->userdetail_vat_number)?$request->userdetail_vat_number:'';
                $add_userdata->agency_name=isset($request->userdetail_agency_name)?$request->userdetail_agency_name:'';
                $add_userdata->agency_website=isset($request->userdetail_agency_website)?$request->userdetail_agency_website:'';
                $add_userdata->agency_address=isset($request->userdetail_agency_address)?$request->userdetail_agency_address:'';
                $add_userdata->license_detail=isset($request->userdetail_license_detail)?$request->userdetail_license_detail:'';
                $add_userdata->other=isset($request->other)?$request->other:'';

                if(isset($request->identification_option) && !empty($request->identification_option))
                {
                    $identification_option_implode=implode(',',$request->identification_option);
                    $add_userdata->identification_option=isset($identification_option_implode)?$identification_option_implode:'';
                }

                if(isset($request->local_operator) && !empty($request->local_operator))
                {
                    $local_operator_implode=implode(',',$request->local_operator);
                    $add_userdata->local_operator=isset($local_operator_implode)?$local_operator_implode:'';
                }


                if(isset($request->tourist_facility) && !empty($request->tourist_facility))
                {
                    $tourist_facility_implode=implode(',',$request->tourist_facility);
                    $add_userdata->tourist_facility=isset($tourist_facility_implode)?$tourist_facility_implode:'';
                }

                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $add_userdata->fav_nation=isset($fav_nation)?$fav_nation:'';
                }

                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $add_userdata->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }

                if(isset($request->sentimental_situation) && !empty($request->sentimental_situation))
                {
                    $sentimental_situation_implode=implode(',',$request->sentimental_situation);
                    $add_userdata->sentimental_situation=isset($sentimental_situation_implode)?$sentimental_situation_implode:'';
                }


                 if(isset($request->preferred_travel_category) && !empty($request->preferred_travel_category))
                {
                    $preferred_travel_category_implode=implode(',',$request->preferred_travel_category);

                    $add_userdata->preferred_travel_category=isset($preferred_travel_category_implode)?$preferred_travel_category_implode:'';
                }

                if ($request->hasFile('userdetail_agency_logo'))
                {
                    $image = $request->file('userdetail_agency_logo'); //get the file
                    $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
                    $destinationPath = public_path('/img/frontend/user/agency_logo'); //public path
                    $image->move($destinationPath, $img_name);  //mve to destination you mentioned
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $add_userdata->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }


                $add_userdata->agency_logo = isset($img_name)?$img_name:'';
                if ($request->File('userdetail_doc_upload'))
                {

                    $doc_fileName = time().'.'.$request->file('userdetail_doc_upload')->extension();
                    $request->file('userdetail_doc_upload')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }
                $add_userdata->doc_upload = isset($doc_fileName)?$doc_fileName:'';


                if($request->File('userdetail_doc_agency_data'))
                {

                    $pdf_fileName = time().'.'.$request->file('userdetail_doc_agency_data')->extension();
                    $request->File('userdetail_doc_agency_data')->move(public_path('uploads/frontend/pdf'), $pdf_fileName);
                }
                $add_userdata->doc_agency_data = isset($pdf_fileName)?$pdf_fileName:'';

                if ($request->File('userdetail_doc_agency_doc'))
                {

                    $pdf_fileName1 = time().'.'.$request->file('userdetail_doc_agency_doc')->extension();
                    $request->File('userdetail_doc_agency_doc')->move(public_path('uploads/frontend/pdf'), $pdf_fileName1);
                }
                $add_userdata->doc_agency_doc = isset($pdf_fileName1)?$pdf_fileName1:'';

                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }
                $add_userdata->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                $add_userdata->profile_image = isset($profile_img_name)?$profile_img_name:'';

                /*if ($request->hasFile('userdetail_profile_image'))
                {
                    $profile_image = $request->file('userdetail_profile_image'); //get the file
                    $profile_img_name = rand(11111, 99999) . '.' . $profile_image->getClientOriginalExtension(); //get
                    $destinationPath = public_path('/img/frontend/user/profile'); //public path
                    $profile_image->move($destinationPath, $profile_img_name);  //mve to destination you mentioned
                }

                $add_userdata->profile_image = isset($profile_img_name)?$profile_img_name:'';

                if ($request->hasFile('userdetail_cover_image'))
                {
                    $cover_image = $request->file('userdetail_cover_image'); //get the file
                    $cover_img_name = rand(11111, 99999) . '.' . $cover_image->getClientOriginalExtension(); //get
                    $destination = public_path('/img/frontend/user/cover'); //public path
                    $cover_image->move($destination, $cover_img_name);  //mve to destination you mentioned
                }
                $add_userdata->cover_image = isset($cover_img_name)?$cover_img_name:'';*/

                if($request->File('userdetail_signed_doc'))
                {
                    $signed_pdf = time().'.'.$request->file('userdetail_signed_doc')->extension();
                    $request->File('userdetail_signed_doc')->move(public_path('uploads/frontend/pdf'), $signed_pdf);
                }
                $add_userdata->signed_doc = isset($signed_pdf)?$signed_pdf:'';
                $add_userdata->save();
            }
        }


        if($request->role_type =='travel_maker'){

            $request->validate([
                'userdetail_describe_yourself' => 'max:250',
            ]);
            if(empty($request->userdetail_front_identity_doc) && empty($request->front_identity_doc_hide) || empty($request->userdetail_back_identity_doc) && empty($request->back_identity_doc_hide)){
                $request->validate([
                    'userdetail_front_identity_doc' => 'required|mimes:doc,docx|max:10000',
                    'userdetail_back_identity_doc' => 'required|mimes:doc,docx|max:10000',
                ]);
            }

            $updateuser_data=UserDetails::where('user_id',$id)->where('role_type','travel_maker')->first();

            if(!empty($updateuser_data)){

           // echo "<pre>"; print_r($request->all()); exit;

                $updateuser_data->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';
                $updateuser_data->birth_place=isset($request->birth_place)?$request->birth_place:'';
                $updateuser_data->sex=isset($request->sex)?$request->sex:'';

                $updateuser_data->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $updateuser_data->preferred_type=isset($request->preferred_type)?$request->preferred_type:'';
                $updateuser_data->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $updateuser_data->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $updateuser_data->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';
                $updateuser_data->classification_travel_report=isset($request->userdetail_classification_travel_report)?$request->userdetail_classification_travel_report:'';
                $updateuser_data->sign_organize=isset($request->sign_organize)?$request->sign_organize:'';
                $updateuser_data->sign_agreement_recognize=isset($request->sign_agreement_recognize)?$request->sign_agreement_recognize:'';
                $updateuser_data->sign_tour_leader=isset($request->sign_tour_leader)?$request->sign_tour_leader:'';

                $updateuser_data->preferred_travel_budget=isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';

                $updateuser_data->sentimental_situation=isset($request->sentimental_situation)?$request->sentimental_situation:'';

                $updateuser_data->preferred_travel_category=isset($request->preferred_travel_category)?implode(',',$request->preferred_travel_category):'';

                $updateuser_data->type_of_travel=isset($request->type_of_travel)?$request->type_of_travel:'';

                $updateuser_data->travel_favoritemealtype=isset($request->travel_favoritemealtype)?$request->travel_favoritemealtype:'';

                if(isset($request->type_of_accommodation) && !empty($request->type_of_accommodation))
                {
                    $type_of_accommodation_implode=implode(',',$request->type_of_accommodation);
                    $updateuser_data->type_of_accommodation=isset($type_of_accommodation_implode)?$type_of_accommodation_implode:'';
                }


                if(isset($request->vector_type) && !empty($request->vector_type))
                {
                    $vector_type_implode=implode(',',$request->vector_type);
                    $updateuser_data->vector_type=isset($vector_type_implode)?$vector_type_implode:'';
                }


                if(isset($request->type_of_participants) && !empty($request->type_of_participants))
                {
                    $type_of_participants_implode=implode(',',$request->type_of_participants);
                    $updateuser_data->type_of_participants=isset($type_of_participants_implode)?$type_of_participants_implode:'';
                }

                 if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $updateuser_data->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }

                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $updateuser_data->fav_nation=isset($fav_nation)?$fav_nation:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $updateuser_data->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }


                if ($request->File('userdetail_front_identity_doc'))
                {
                    $doc_fileName = time().'.'.$request->file('userdetail_front_identity_doc')->extension();
                    $request->file('userdetail_front_identity_doc')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }
                else{
                    $doc_fileName = $updateuser_data->front_identity_doc;
                }
                $updateuser_data->front_identity_doc = isset($doc_fileName)?$doc_fileName:'';


                if($request->File('userdetail_back_identity_doc'))
                {

                    $doc_file = time().'.'.$request->file('userdetail_back_identity_doc')->extension();
                    $request->File('userdetail_back_identity_doc')->move(public_path('uploads/frontend/doc'), $doc_file);
                }
                else{
                    $doc_file = $updateuser_data->back_identity_doc;
                }
                $updateuser_data->back_identity_doc = isset($doc_file)?$doc_file:'';


                if($request->File('userdetail_signed_doc'))
                {
                    $signed_pdf_maker = time().'.'.$request->file('userdetail_signed_doc')->extension();
                    $request->File('userdetail_signed_doc')->move(public_path('uploads/frontend/pdf'), $signed_pdf_maker);
                }
                else{
                    $signed_pdf_maker = $updateuser_data->signed_doc;
                }
                $updateuser_data->signed_doc = isset($signed_pdf_maker)?$signed_pdf_maker:'';


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }else{
                    $cover_img_name = $updateuser_data->cover_image;
                }
                $updateuser_data->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));

                        }


                    }
                }
                else{

                    $profile_img_name = $updateuser_data->profile_image;

                }

                $updateuser_data->profile_image = !empty($profile_img_name)?$profile_img_name:'';
                //dd($updateuser_data->profile_image);
                $updateuser_data->save();
            }
            else{

                $add_userdata = new UserDetails;
                $add_userdata->role_type = 'travel_maker';
                $add_userdata->user_id = $id;
                if(isset($request->birth_place) && !empty($request->birth_place))
                {
                $add_userdata->birth_place=isset($request->birth_place)?$request->birth_place:'';
                }
                if(isset($request->sex) && !empty($request->sex))
                {
                $add_userdata->sex=isset($request->sex)?$request->sex:'';
                }
                $add_userdata->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';
                $add_userdata->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $add_userdata->preferred_type=isset($request->preferred_type)?$request->preferred_type:'';
                $add_userdata->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $add_userdata->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $add_userdata->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';
                $add_userdata->classification_travel_report=isset($request->userdetail_classification_travel_report)?$request->userdetail_classification_travel_report:'';
                $add_userdata->sign_organize=isset($request->sign_organize)?$request->sign_organize:'';
                $add_userdata->sign_agreement_recognize=isset($request->sign_agreement_recognize)?$request->sign_agreement_recognize:'';
                $add_userdata->sign_tour_leader=isset($request->sign_tour_leader)?$request->sign_tour_leader:'';
                $add_userdata->signed_doc=isset($request->signed_doc)?$request->signed_doc:'';

                $add_userdata->preferred_travel_budget=isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';


                 $add_userdata->sentimental_situation=isset($request->sentimental_situation)?$request->sentimental_situation:'';

                $add_userdata->preferred_travel_category=isset($request->preferred_travel_category)?implode(',',$request->preferred_travel_category):'';
                $add_userdata->type_of_travel=isset($request->type_of_travel)?$request->type_of_travel:'';
                $add_userdata->travel_favoritemealtype=isset($request->travel_favoritemealtype)?$request->travel_favoritemealtype:'';


                if(isset($request->type_of_accommodation) && !empty($request->type_of_accommodation))
                {
                    $type_of_accommodation_implode=implode(',',$request->type_of_accommodation);
                    $add_userdata->type_of_accommodation=isset($type_of_accommodation_implode)?$type_of_accommodation_implode:'';
                }


                if(isset($request->vector_type) && !empty($request->vector_type))
                {
                    $vector_type_implode=implode(',',$request->vector_type);
                    $add_userdata->vector_type=isset($vector_type_implode)?$vector_type_implode:'';
                }


                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $add_userdata->fav_nation=isset($fav_nation)?$fav_nation:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $add_userdata->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }


                if(isset($request->type_of_participants) && !empty($request->type_of_participants))
                {
                    $type_of_participants_implode=implode(',',$request->type_of_participants);
                    $add_userdata->type_of_participants=isset($type_of_participants_implode)?$type_of_participants_implode:'';
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $add_userdata->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }



                if($request->File('userdetail_front_identity_doc'))
                {
                    $doc_fileName = time().'.'.$request->file('userdetail_front_identity_doc')->extension();
                    $request->file('userdetail_front_identity_doc')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }
                $add_userdata->front_identity_doc = isset($doc_fileName)?$doc_fileName:'';


                if($request->File('userdetail_back_identity_doc'))
                {
                    $doc_file = time().'.'.$request->file('userdetail_back_identity_doc')->extension();
                    $request->File('userdetail_back_identity_doc')->move(public_path('uploads/frontend/pdf'), $doc_file);
                }
                $add_userdata->back_identity_doc = isset($doc_file)?$doc_file:'';


                if ($request->File('userdetail_signed_doc'))
                {
                    $pdf_fileName = time().'.'.$request->file('userdetail_signed_doc')->extension();
                    $request->File('userdetail_signed_doc')->move(public_path('uploads/frontend/pdf'), $pdf_fileName);
                }
                $add_userdata->signed_doc = isset($pdf_fileName)?$pdf_fileName:'';


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }
                $add_userdata->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                $add_userdata->profile_image = isset($profile_img_name)?$profile_img_name:'';

                $add_userdata->save();
            }
        }

        if($request->role_type =='travel_blogger'){

            $updateuser_data=UserDetails::where('user_id',$id)->where('role_type','travel_blogger')->first();


            if(!empty($updateuser_data)){
                //echo "<pre>"; print_r($request->all()); exit;
                $updateuser_data->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';
                $updateuser_data->birth_place=isset($request->birth_place)?$request->birth_place:'';
                $updateuser_data->sex=isset($request->sex)?$request->sex:'';
                $updateuser_data->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $updateuser_data->preferred_type=isset($request->preferred_type)?$request->preferred_type:'';
                $updateuser_data->telephone_number=isset($request->userdetail_telephone_number)?$request->userdetail_telephone_number:'';
                $updateuser_data->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $updateuser_data->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';
                $updateuser_data->vat_number=isset($request->userdetail_vat_number)?$request->userdetail_vat_number:'';
                $updateuser_data->personal_website=isset($request->userdetail_personal_website)?$request->userdetail_personal_website:'';
                $updateuser_data->fb_link=isset($request->userdetail_fb_link)?$request->userdetail_fb_link:'';
                $updateuser_data->twitter_link=isset($request->userdetail_twitter_link)?$request->userdetail_twitter_link:'';
                $updateuser_data->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';
                $updateuser_data->insta_link=isset($request->userdetail_insta_link)?$request->userdetail_insta_link:'';
                $updateuser_data->pinterest_link=isset($request->userdetail_pinterest_link)?$request->userdetail_pinterest_link:'';
                $updateuser_data->tiktok_link=isset($request->userdetail_tiktok_link)?$request->userdetail_tiktok_link:'';
                $updateuser_data->youtube_link=isset($request->userdetail_youtube_link)?$request->userdetail_youtube_link:'';
                $updateuser_data->other=isset($request->other)?$request->other:'';
                $updateuser_data->preferred_travel_budget=isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';


                 if(isset($request->preferred_travel_category) && !empty($request->preferred_travel_category))
                {
                    $preferred_travel_category_implode=implode(',',$request->preferred_travel_category);
                    $updateuser_data->preferred_travel_category=isset($preferred_travel_category_implode)?$preferred_travel_category_implode:'';
                }

                $updateuser_data->type_of_travel=isset($request->type_of_travel)?$request->type_of_travel:'';

                $updateuser_data->travel_favoritemealtype=isset($request->travel_favoritemealtype)?$request->travel_favoritemealtype:'';

                if(isset($request->sentimental_situation) && !empty($request->sentimental_situation))
                {
                    $sentimental_situation_implode=implode(',',$request->sentimental_situation);
                    $updateuser_data->sentimental_situation=isset($sentimental_situation_implode)?$sentimental_situation_implode:'';
                }


                if(isset($request->blogger_service) && !empty($request->blogger_service))
                {
                    $blogger_service_implode=implode(',',$request->blogger_service);
                    $updateuser_data->blogger_service=isset($blogger_service_implode)?$blogger_service_implode:'';
                }


                if(isset($request->vector_type) && !empty($request->vector_type))
                {
                    $vector_type_implode=implode(',',$request->vector_type);
                    $updateuser_data->vector_type=isset($vector_type_implode)?$vector_type_implode:'';
                }


                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $updateuser_data->fav_nation=isset($fav_nation)?$fav_nation:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $updateuser_data->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }

                if(isset($request->type_of_accommodation) && !empty($request->type_of_accommodation))
                {
                    $type_of_accommodation_implode=implode(',',$request->type_of_accommodation);
                    $updateuser_data->type_of_accommodation=isset($type_of_accommodation_implode)?$type_of_accommodation_implode:'';
                }



                if(isset($request->type_of_participants) && !empty($request->type_of_participants))
                {
                    $type_of_participants_implode=implode(',',$request->type_of_participants);
                    $updateuser_data->type_of_participants=isset($type_of_participants_implode)?$type_of_participants_implode:'';
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $updateuser_data->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }


                if($request->File('userdetail_identity_document'))
                {
                    $doc_fileName = time().'.'.$request->file('userdetail_identity_document')->extension();
                    $request->file('userdetail_identity_document')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }else{
                    $doc_fileName = $updateuser_data->identity_document;
                }
                $updateuser_data->identity_document = isset($doc_fileName)?$doc_fileName:'';


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }else{
                    $cover_img_name = $updateuser_data->cover_image;
                }
                $updateuser_data->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                else{
                    $profile_img_name = $updateuser_data->profile_image;
                }
                $updateuser_data->profile_image = isset($profile_img_name)?$profile_img_name:'';


                if($request->File('userdetail_signed_doc'))
                {
                    $signed_pdf = time().'.'.$request->file('userdetail_signed_doc')->extension();
                    $request->File('userdetail_signed_doc')->move(public_path('uploads/frontend/pdf/signdoc/'), $signed_pdf);
                }
                else{
                    $signed_pdf = $updateuser_data->signed_doc;
                }
                $updateuser_data->signed_doc = isset($signed_pdf)?$signed_pdf:'';
                $updateuser_data->save();

            }
            else{

                $add_userdata = new UserDetails;
                $add_userdata->role_type = 'travel_blogger';
                //echo "<pre>"; print_r($add_userdata); exit;
                $add_userdata->user_id = $id;
                $add_userdata->phone_no=isset($request->userdetail_phone_no)?$request->userdetail_phone_no:'';


                if(isset($request->birth_place) && !empty($request->birth_place))
                {
                    $add_userdata->birth_place=isset($request->birth_place)?$request->birth_place:'';
                }


                if(isset($request->sex) && !empty($request->sex))
                {
                    $add_userdata->sex=isset($request->sex)?$request->sex:'';
                }


                $add_userdata->place_of_residence=isset($request->userdetail_place_of_residence)?$request->userdetail_place_of_residence:'';
                $add_userdata->term_condition=isset($request->userdetail_term_condition)?$request->userdetail_term_condition:'';

                $add_userdata->preferred_type=isset($request->preferred_type)?$request->preferred_type:'0';
                $add_userdata->telephone_number=isset($request->userdetail_telephone_number)?$request->userdetail_telephone_number:'';
                $add_userdata->describe_yourself=isset($request->userdetail_describe_yourself)?$request->userdetail_describe_yourself:'';
                $add_userdata->linkedin_link=isset($request->linkedin_link)?$request->linkedin_link:'';
                $add_userdata->vat_number=isset($request->userdetail_vat_number)?$request->userdetail_vat_number:'';
                $add_userdata->personal_website=isset($request->userdetail_personal_website)?$request->userdetail_personal_website:'';
                $add_userdata->fb_link=isset($request->userdetail_fb_link)?$request->userdetail_fb_link:'';
                $add_userdata->twitter_link=isset($request->userdetail_twitter_link)?$request->userdetail_twitter_link:'';
                $add_userdata->insta_link=isset($request->userdetail_insta_link)?$request->userdetail_insta_link:'';
                $add_userdata->pinterest_link=isset($request->userdetail_pinterest_link)?$request->userdetail_pinterest_link:'';
                $add_userdata->tiktok_link=isset($request->userdetail_tiktok_link)?$request->userdetail_tiktok_link:'';
                $add_userdata->youtube_link=isset($request->userdetail_youtube_link)?$request->userdetail_youtube_link:'';

                $add_userdata->preferred_travel_category=isset($request->preferred_travel_category)?implode(',',$request->preferred_travel_category):'';

                $add_userdata->type_of_travel=isset($request->type_of_travel)?$request->type_of_travel:'';
                $add_userdata->preferred_travel_budget=isset($request->preferred_travel_budget)?$request->preferred_travel_budget:'';
                $add_userdata->travel_favoritemealtype=isset($request->travel_favoritemealtype)?$request->travel_favoritemealtype:'';
                $add_userdata->other=isset($request->other)?$request->other:'';

                if(isset($request->blogger_service) && !empty($request->blogger_service))
                {
                    $blogger_service_implode=implode(',',$request->blogger_service);
                    $add_userdata->blogger_service=isset($blogger_service_implode)?$blogger_service_implode:'';
                }

                if(isset($request->sentimental_situation) && !empty($request->sentimental_situation))
                {
                    $sentimental_situation_implode=implode(',',$request->sentimental_situation);
                    $add_userdata->sentimental_situation=isset($sentimental_situation_implode)?$sentimental_situation_implode:'';
                }

                if(isset($request->type_of_accommodation) && !empty($request->type_of_accommodation))
                {
                    $type_of_accommodation_implode=implode(',',$request->type_of_accommodation);
                    $add_userdata->type_of_accommodation=isset($type_of_accommodation_implode)?$type_of_accommodation_implode:'';
                }


                if(isset($request->fav_nation) && !empty($request->fav_nation))
                {
                    $fav_nation=implode(',',$request->fav_nation);
                    $add_userdata->fav_nation=isset($fav_nation)?$fav_nation:'';
                }


                if(isset($request->fav_nation_want) && !empty($request->fav_nation_want))
                {
                    $fav_nation_want=implode(',',$request->fav_nation_want);
                    $add_userdata->fav_nation_want=isset($fav_nation_want)?$fav_nation_want:'';
                }


                if(isset($request->vector_type) && !empty($request->vector_type))
                {
                    $vector_type_implode=implode(',',$request->vector_type);
                    $add_userdata->vector_type=isset($vector_type_implode)?$vector_type_implode:'';
                }


                if(isset($request->type_of_participants) && !empty($request->type_of_participants))
                {
                    $type_of_participants_implode=implode(',',$request->type_of_participants);
                    $add_userdata->type_of_participants=isset($type_of_participants_implode)?$type_of_participants_implode:'';
                }

                if(isset($request->type_of_fav_meals) && !empty($request->type_of_fav_meals))
                {
                    $type_of_fav_meals_implode=implode(',',$request->type_of_fav_meals);
                    $add_userdata->travel_favoritemealtype=isset($type_of_fav_meals_implode)?$type_of_fav_meals_implode:'';
                }


                if ($request->File('userdetail_identity_document'))
                {

                    $doc_fileName = time().'.'.$request->file('userdetail_identity_document')->extension();
                    $request->file('userdetail_identity_document')->move(public_path('uploads/frontend/doc'), $doc_fileName);
                }
                $add_userdata->identity_document = isset($doc_fileName)?$doc_fileName:'';


                if (!empty($request->userdetail_cover_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_cover_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_cover_image), public_path('/img/frontend/user/cover/'.$request->userdetail_cover_image))){
                            $cover_img_name = $request->userdetail_cover_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_cover_image));
                        }

                    }
                }
                $add_userdata->cover_image = isset($cover_img_name)?$cover_img_name:'';

                if (!empty($request->userdetail_profile_image))
                {
                    if(file_exists(public_path('/crop_images/'.$request->userdetail_profile_image))){
                        if(copy(public_path('/crop_images/'.$request->userdetail_profile_image), public_path('/img/frontend/user/profile/'.$request->userdetail_profile_image))){
                            $profile_img_name = $request->userdetail_profile_image;
                            unlink(public_path('/crop_images/'.$request->userdetail_profile_image));
                        }

                    }
                }
                $add_userdata->profile_image = isset($profile_img_name)?$profile_img_name:'';


                if($request->File('userdetail_signed_doc'))
                {
                    $signed_pdf = time().'.'.$request->file('userdetail_signed_doc')->extension();
                    $request->File('userdetail_signed_doc')->move(public_path('uploads/frontend/pdf/signdoc/'), $signed_pdf);
                }


                $add_userdata->signed_doc = isset($signed_pdf)?$signed_pdf:'';
                $add_userdata->save();

            }
        }


        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            auth()->logout();
            return redirect()->route('frontend.auth.main_login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
        }
        return redirect(url('profile/'.Auth::user()->role_type.'/'.strtolower(Auth::user()->first_name.Auth::user()->last_name).'/'.Auth::user()->id))->withFlashSuccess(__('strings.frontend.user.profile_updated'));
    }


    public function imageResize($imageSrc,$imageWidth,$imageHeight){
        $newImageWidth =200; //set new image width
        $newImageHeight =200; //set new image height

        $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);


        imagecopyresampled($newImageLayer, $imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

        return $newImageLayer;
    }


    public function imageResizemiddle($imageSrc,$imageWidth,$imageHeight){
        $newImageWidth =600; //set new image width
        $newImageHeight =600; //set new image height

        $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
        imagecopyresampled($newImageLayer, $imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

        return $newImageLayer;
    }

    public function sendMessage(Request $request)
    {
        $first_name = !empty($request->firstNameNoAuth) ? $request->firstNameNoAuth : Auth::user()->first_name;
        $last_name = !empty($request->lastNameNoAuth) ? $request->lastNameNoAuth : Auth::user()->last_name;
        $role_type = !empty($request->roleTypeNoAuth) ? $request->roleTypeNoAuth : Auth::user()->role_type;
        $id_user = !empty($request->userIdNoAuth) ? $request->userIdNoAuth : Auth::user()->id;
        $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . $id_user;

        $checkFirstSendMail = Conversation::where([
            ['email_send', '=', Auth::user()->email],
            ['email_recieve', '=', $request->toEmail],
            ['first_send', '=', 1]
        ])->count();
        if($checkFirstSendMail > 0){
            return redirect()->to($link)->withFlashDanger("You have already sent a notice to this email address");
        }
        
        $checkRequestInMonth = Conversation::where([
            ['email_send', '=', Auth::user()->email],
            ['role_type', '=', 'travel_blogger'],
            ['month_send', '=', Carbon::parse(Carbon::now())->format('m')],
            ['year_send', '=', Carbon::parse(Carbon::now())->format('Y')]
        ])->count();
        if($checkRequestInMonth > 4){
            return redirect()->to($link)->withFlashDanger("You've run out of notifications");
        }

        $checkRequestInMonthTraveler = Conversation::where([
            ['email_send', '=', Auth::user()->email],
            ['role_type', '=', 'traveler'],
            ['month_send', '=', Carbon::parse(Carbon::now())->format('m')],
            ['year_send', '=', Carbon::parse(Carbon::now())->format('Y')]
        ])->count();
        if($checkRequestInMonthTraveler > 0){
            return redirect()->to($link)->withFlashDanger("You've run out of notifications");
        }

        $checkRequestInMonthTravelMaker = Conversation::where([
            ['email_send', '=', Auth::user()->email],
            ['role_type', '=', 'travel_maker'],
            ['month_send', '=', Carbon::parse(Carbon::now())->format('m')],
            ['year_send', '=', Carbon::parse(Carbon::now())->format('Y')]
        ])->count();
        if($checkRequestInMonthTravelMaker > 0){
            return redirect()->to($link)->withFlashDanger("You've run out of notifications");
        }
        $userId = Auth::user()->id;
        $userDetail = UserDetails::where('user_id', '=', $userId)->first();
        $conversation = new Conversation();
        $conversation->user_name = Auth::user()->user_name;
        $conversation->phone_number = $userDetail->phone_no;
        $conversation->role_type = Auth::user()->role_type;
        $conversation->first_send = 1;
        $conversation->email_send = Auth::user()->email;
        $conversation->email_recieve = !empty($request->toEmail) ? $request->toEmail : '';
        $conversation->message = !empty($request->messageSended) ? $request->messageSended : '';
        $conversation->date_send = date("d");
        $conversation->month_send = date("m");
        $conversation->year_send = date("Y");
        $conversation->role_type_recieve = $role_type;
        $conversation->save();

        return redirect()->to($link);
    }



    public function myProfile($role, $user_name, $id, Request $request)
    {
        if(Auth::check()){
            if(Auth::user()->id == $id){
                $user_id = encrypt_decrypt('encrypt',Auth::user()->id);
                $user_id=encrypt_decrypt('decrypt', $user_id);
                $travel_pro_name1 = Auth::user()->user_name;
            }else{
                $user_id = $id;
                $travel_pro_name1 = User::where('id', $user_id)->first()->user_name;
            }
            $checkRequestInMonth = Conversation::where([
                ['email_send', '=', Auth::user()->email],
                ['role_type', '=', 'travel_blogger'],
                ['month_send', '=', Carbon::parse(Carbon::now())->format('m')],
                ['year_send', '=', Carbon::parse(Carbon::now())->format('Y')]
            ])->count();

            $checkRequestInMonthTraveler = Conversation::where([
                ['email_send', '=', Auth::user()->email],
                ['role_type', '=', 'traveler'],
                ['month_send', '=', Carbon::parse(Carbon::now())->format('m')],
                ['year_send', '=', Carbon::parse(Carbon::now())->format('Y')]
            ])->count();

            $checkRequestInMonthTravelMaker = Conversation::where([
                ['email_send', '=', Auth::user()->email],
                ['role_type', '=', 'travel_maker'],
                ['month_send', '=', Carbon::parse(Carbon::now())->format('m')],
                ['year_send', '=', Carbon::parse(Carbon::now())->format('Y')]
            ])->count();
            
        }else{
            // preg_match_all('!\d+!', $id, $user_id);
            // $user_id = $user_id[0][0];
            $user_id = $id;
            $travel_pro_name1 = User::where('id', $user_id)->first()->user_name;
            $checkRequestInMonth = 0;
            $checkRequestInMonthTraveler = 0;
            $checkRequestInMonthTravelMaker = 0;
        }

        $userStatus = User::where('id', $user_id)->first()->security_user;
        if($userStatus == 'cancel' || $userStatus == 'pending'){
            return "Page Not Found";
        }

         if(isset($request->search) && !empty($request->search))
         {
           $travel_pro_name = TravelReports::join('users', 'travel_reports.user_id', '=', 'users.id')->where('travel_reports.travel_pro', $travel_pro_name1)->Where('users.user_name', 'like', '%' .$request->search. '%')->pluck('users.user_name', 'users.id')->toArray();
         }
         else
         {
            $travel_pro_name = TravelReports::join('users', 'travel_reports.user_id', '=', 'users.id')->where('travel_reports.travel_pro', $travel_pro_name1)->pluck('users.user_name', 'users.id')->toArray();
         }


      
        if(Auth::user()){
            if(Auth::user()->id == $id){
                $auth_id=Auth::user()->id;
                $travelreport_data = TravelReports::where('user_id',$auth_id)->get();
            }else{
                $travelreport_data = TravelReports::where('user_id',$user_id)->get();
            }
        }
        else{
            $travelreport_data = TravelReports::where('user_id',$user_id)->get();
            // $travelreport_data='';
        }

        $user=User::where('id',$user_id)->first();
        $userdata= UserDetails::where('user_id',$user_id)->first();

        $role_type=$user->role_type;
        $actiondata=TravelAction::where('user_id',$user_id)->first();
        $followcount=TourReportFollowers::where('user_id',$user_id)->where('status','1')->count();
        $followdata=TourReportFollowers::where('user_id',$user_id)->first();

        if(Auth::user()){
            // if(Auth::user()->id == $id){
            $followdata=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',Auth::user()->id)->first();
            // }else{
            //     $followdata=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',$user_id)->first();
            // }
        }else{
            // $followdata=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',$user_id)->first();
            $followdata='';
        }

        $condition = ['status' => 1];
        if($request->get('travel_categ')){

           $condition['category_id'] = $request->get('travel_categ');

        }

        $ads_data = Advertisement::orderByRaw('RAND()')->take(5)->where($condition)->where('view','profile')->where('location','top')->orwhere('location','middle')->get();
        $ads_data_bottom = Advertisement::orderByRaw('RAND()')->take(3)->where($condition)->where('view','profile')->where('location','footer')->orwhere('location','bottom')->get();


        $alert_super_data = TravelReports::withCount('supers')->withCount('alerts')->where('user_id',$user_id)->where('status','1')->take(9)->orderBy('supers_count', 'desc')->orderBy('created_at', 'desc')->get();

        $alert_data = TravelReports::withCount('alerts')->where('user_id',$user_id)->where('status','1')->count();

        $super_data = TravelReports::withCount('supers')->where('user_id',$user_id)->where('status','1')->count();

        $roledata=Role::where('name',$role_type)->first();
        $social_link = SocialSetting::first();

        if(Auth::check() && Auth::user()->id == $id){
            $this->configcontact1();
        }

        $countriesOptions = json_encode(Countries::select('name')->pluck('name')->toArray());

        $listIdUserFollows = TourReportFollowers::select('tour_report_id')->where('user_id',$user_id)->where('status','1')->pluck('tour_report_id')->toArray();
        $listUserFollows = User::select('user_name')->whereIn('id', $listIdUserFollows)->get();

        $emailSend = User::where('id', '=' , $user_id)->first();
        $emailToSend = $emailSend->email;

        return view('frontend.user.profile',compact('user_id','role_type','userdata','roledata','followdata','actiondata','alert_super_data','travelreport_data','followcount','ads_data', 'social_link', 'condition', 'alert_data', 'super_data', 'travel_pro_name','ads_data_bottom', 'countriesOptions', 'listUserFollows', 'checkRequestInMonth', 'emailToSend', 'checkRequestInMonthTraveler', 'checkRequestInMonthTravelMaker'));
    }

    public function getMoreTravelReport(Request $request) {
        $page = $request->page;
        $user_id = $request->user_id;

        $user=User::where('id',$user_id)->first();
        $role_type=$user->role_type;
        $roledata=Role::where('name',$role_type)->first();
        $userdata= UserDetails::where('user_id',$user_id)->first();

        $alert_super_data = TravelReports::withCount('supers')->withCount('alerts')->where('user_id',$user_id)->where('status','1')->take(9*$page)->orderBy('supers_count', 'desc')->orderBy('created_at', 'desc')->get();
        return view('frontend.traveler.profile.list_travel_report', compact('user_id', 'alert_super_data', 'roledata', 'userdata'));
    }

    public function search($id) {

        $searchname = TravelReports::find($id);

        if (empty($article)) {
            abort(404);
        }

        return view('frontend.user.profile', compact('searchname'));

    }
    /**
     * Display number of shares using PHP cURL library
     *
     * @param string $url ID We want to get number of shares of this URL
     */

    public function Deletebloggerimg($id,Request $request)
    {
        $user_id= $request->user_id;
        UserImages::where('user_id',$user_id)->where('id', '=', $id)->delete();
    }


    public function controlpanel(){

        if(Auth::user()->id != '1'){

            $user_id=Auth::user()->id;
            $user_email=Auth::user()->email;
            $role_type=Auth::user()->role_type;

            $roledata=Role::where('name',$role_type)->first();
            $userdata= UserDetails::where('user_id',$user_id)->first();

            $report_data = TravelReports::withCount('supers')->withCount('alerts')->where('user_id',$user_id)->paginate(10);
            //dd($report_data);
            $travel_types = TravelTypes::pluck('name', 'name')->toArray();
            $travel_ages = TravelAge::pluck('name', 'id')->toArray();
            $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
            $travel_accommodations = TravelAccommodation::pluck('name', 'name')->toArray();
            $travel_participates = TravelParticipate::pluck('name', 'name')->toArray();
            $travel_categ = Travelcategory::orderby('id','desc')->pluck('name', 'id')->toArray();
            $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();
            $travel_formula = TravelFormula::orderby('name','asc')->pluck('name', 'name')->toArray();
            $travel_budget = TravelBudget::orderby('id','asc')->pluck('name', 'name')->toArray();
            $travel_mealtype = DB::table('travel_vectors')->orderby('id','desc')->where(['vector_type' => 'meals'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();

            $report_only=TravelReports::withCount('supers')->withCount('alerts')->
              where('user_id',$user_id)->where('report_option','report')->paginate(10);

            $report_offer=TravelReports::withCount('supers')->withCount('alerts')->
              where('user_id',$user_id)->where('report_option','offer')->paginate(10);

            $report_diary=TravelReports::withCount('supers')->withCount('alerts')->
              where('user_id',$user_id)->where('report_option','diary')->paginate(10);

            $request_send=CollaborationRequest::where('request_id',$user_id)->where('role_type',$role_type)->with('userdata','user')->get();
            $request_receive=CollaborationRequest::where('user_id',$user_id)->where('role_type',$role_type)->with('userdata','user')->get();

            $followcount=TourReportFollowers::where('user_id',$user_id)->where('status','1')->count();
            $followdata=TourReportFollowers::where('user_id',$user_id)->first();
            $listParticipate = UserParticipate::with('travel_report', 'travel_report.userdata')->where('user_email', $user_email)->get()->unique('report_id');
            
            $condition = ['status' => 1];

             $ads_data_bottom = Advertisement::orderByRaw('RAND()')->take(3)->where($condition)->where('view','travel_report')->where('location','footer')->orwhere('location','bottom')->get();


            if(Auth::user()){
                $followdata=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',Auth::user()->id)->first();
            }

            else{
                $followdata='';
            }

            $countData = [];
            foreach ($report_data as $key => $value) {

                $url = url('view/travel_report/'.encrypt_decrypt('encrypt',$value->user_id));
                //dd($url);die;
                $res = $this->curlGetFbShares($url);
                $countData[$value->id]['fb_count'] =  $res;

            }

            foreach ($report_only as $key => $value) {

                $url = url('view/travel_report/'.encrypt_decrypt('encrypt',$value->user_id));
                //dd($url);die;
                $res = $this->curlGetFbShares($url);
                $countData[$value->id]['fb_count'] =  $res;

            }

             foreach ($report_diary as $key => $value) {

                $url = url('view/travel_report/'.encrypt_decrypt('encrypt',$value->user_id));
                //dd($url);die;
                $res = $this->curlGetFbShares($url);
                $countData[$value->id]['fb_count'] =  $res;

            }

            $invitations = InviteFriend::where('user_id', Auth::user()->id)->get();
            $registerUrl = url('/') . '/main-register';
            $countriesOptions = json_encode(Countries::select('name')->pluck('name')->toArray());

            foreach($report_data as $report){
                $userParticipate = UserParticipate::where('report_id', $report->id)->get();
                $report->userParticipate = $userParticipate;
            }

            return view('frontend.user.control_panel',compact('ads_data_bottom','roledata','report_data','userdata','travel_types', 'travel_ages','travel_vectors','travel_accommodations','travel_participates','travel_categ', 'country_arr','travel_formula','travel_budget','report_only','report_offer','report_diary','request_send', 'request_receive','travel_mealtype', 'followcount', 'followdata','countData', 'invitations', 'registerUrl', 'countriesOptions', 'listParticipate'));
        }
        else{
            return redirect()->to('/');
        }

    }


    public function curlGetFbShares( $url = 'http://design.wdptechnologies.com/travelmaker/public/profile/c2NpYjRJUjRhWThOWS9YMFYzSmdCQT09' ){
        $access_token = '384766599316436|e4f00a4bd266d55a5b1732c95545685d';
        $api_url = 'https://graph.facebook.com/v3.0/?id=' . urlencode( $url ) . '&fields=engagement&access_token=' . $access_token;
        $fb_connect = curl_init(); // initializing
        curl_setopt( $fb_connect, CURLOPT_URL, $api_url );
        curl_setopt( $fb_connect, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
        curl_setopt( $fb_connect, CURLOPT_TIMEOUT, 20 );
        $json_return = curl_exec( $fb_connect ); // connect and get json data
        curl_close( $fb_connect ); // close connection

        $body = json_decode( $json_return, true);
        //dd($body);
        return !empty($body['engagement']['share_count'])?$body['engagement']['share_count']:0;
    }



    public function reportsearchfilter(Request $request)
    {

        $parameters = $request->all();
        //dd($parameters);
        /*
        "country" => "101"
          "age" => null
          "travel_categ" => null
          "travel_type" => null
          "vector_type" => null
          "type_of_participants" => null
          "type_of_accommodation" => null
          "preferred_type_formula" => null
          "preferred_travel_budget" => null
          "preferred_travel_mealtype" => null
        */

        $user_id = Auth::user()->id;
        $role_type=Auth::user()->role_type;
        $roledata=Role::where('name',$role_type)->first();
        $travel_types = DB::table('travel_types')->pluck('name', 'name')->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'id')->toArray();
        $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_accommodations = DB::table('travel_accommodations')->pluck('name', 'name')->toArray();
        $travel_participates = DB::table('travel_participates')->pluck('name', 'name')->toArray();
        $travel_categ = Travelcategory::orderby('id','desc')->pluck('name', 'id')->toArray();
        $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();
        $travel_formula = TravelFormula::orderby('name','asc')->pluck('name', 'name')->toArray();
        $travel_budget = TravelBudget::orderby('name','desc')->pluck('name', 'name')->toArray();
        $report_data1 = TravelReports::withCount('supers')->withCount('alerts')->where('user_id',$user_id)->paginate(10);

        $travel_mealtype = DB::table('travel_vectors')->orderby('name','desc')->where(['vector_type' => 'meals'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();

        $travel_reports = TravelReports::with('userdata', 'category')->withCount('supers')->withCount('alerts')->join('user_details', 'travel_reports.user_id', '=', 'user_details.user_id')->where('user_details.user_id',$user_id);

        $followcount=TourReportFollowers::where('user_id',$user_id)->where('status','1')->count();
        $followdata=TourReportFollowers::where('user_id',$user_id)->first();

        if(Auth::user()){
            $followdata=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',Auth::user()->id)->first();
        }

        else{
            $followdata='';
        }


        if(!empty($request->age)){
            $age_ratio = getAgeRatio($request->age);
            $birth_date = $this->getdatediff($age_ratio);
            $explode_birth_string = explode('-', $birth_date);
            $start_date = date($explode_birth_string[1].'-01-01');
            $end_date = date($explode_birth_string[0].'-12-30');
            $travel_reports = $travel_reports->whereBetween('travel_reports.birth_place', [$start_date,$end_date]);
        }

        if (!empty($request->travel_categ)) {
           $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.category_id)", [$request->travel_categ]);
        }

        if (!empty($request->country)) {
            $country_id = $request->country;
            $travel_reports->where(function($q) use ($country_id){
                $q->whereRaw("FIND_IN_SET(?, travel_reports.country_destination)", [$country_id])->orWhere('travel_reports.country_departure', $country_id);
            });
        }


        if (!empty($request->travel_type)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.type_of_travel)", [$request->travel_type]);
            //$travel_reports->where('user_details.type_of_travel', $request->travel_type);
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
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.preferred_travel_budget)", [$request->preferred_travel_budget]);
            //$travel_reports->where('user_details.preferred_travel_budget', $request->preferred_travel_budget);
        }

        if (!empty($request->preferred_travel_mealtype)) {
            $travel_reports->whereRaw("FIND_IN_SET(?, travel_reports.travel_favoritemealtype)", [$request->preferred_travel_mealtype]);
            //$travel_reports->where('user_details.travel_favoritemealtype', $request->preferred_travel_mealtype);
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

        $ads_data = Advertisement::orderby('id','desc')->where($condition)->get();
        // preferred_travel_mealtype

        $travel_reports = $travel_reports->orderBy('supers_count', 'desc')->get();

        $report_only=TravelReports::withCount('supers')->withCount('alerts')->
              where('user_id',$user_id)->where('report_option','report')->get();

        $request_send=CollaborationRequest::where('request_id',$user_id)->where('role_type',$role_type)->with('userdata','user')->get();
        $request_receive=CollaborationRequest::where('user_id',$user_id)->where('role_type',$role_type)->with('userdata','user')->get();
        $report_offer=TravelReports::withCount('supers')->withCount('alerts')->
              where('user_id',$user_id)->where('report_option','offer')->get();
        $report_diary=TravelReports::withCount('supers')->withCount('alerts')->
              where('user_id',$user_id)->where('report_option','diary')->get();

        return view('frontend.control_panel.search', compact('roledata','travel_categ','country_arr', 'travel_types', 'travel_ages', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'parameters', 'travel_reports','report_only','report_offer','report_diary','request_send','request_receive','travel_formula','travel_budget', 'travel_mealtype', 'ads_data', 'condition', 'report_data1', 'followcount', 'followdata'));
    }



    public function getdatediff($birth_date){
        $cureent_date = date('Y');
        $explode_birth_arr = explode('-',$birth_date);
        $firstrange = !empty($explode_birth_arr[0])?date('Y', strtotime('- '.$explode_birth_arr[0].' Years')):date('Y');
        $second_range = !empty($explode_birth_arr[1])?date('Y', strtotime('- '.$explode_birth_arr[1].' Years')):date('Y');
        $combine_string = $firstrange.'-'.$second_range;
        return ($combine_string)?$combine_string:'';
    }


    public function follow(Request $request){
        $user_id=$request->user_id;
        $follower_id = Auth::user()->id;

        $updateuser_follow=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',$follower_id)->first();

        if(!empty($updateuser_follow)){
            $follow_status=TourReportFollowers::where('tour_report_id',$follower_id)->where('user_id',$user_id)->update([
                             'status' => $request->follow_status,
                           ]);
        }
        else{
            $adduser_follow = new TourReportFollowers;
            $adduser_follow->user_id = $user_id;
            $adduser_follow->tour_report_id = $follower_id;
            $adduser_follow->status = '1';
            $adduser_follow->save();
        }
        $followdata=TourReportFollowers::where('user_id',$user_id)->where('status','1')->count();
        $status=($request->follow_status == 0 ) ? 1 : 0;
        $data=array('follow_status'=>$status,'followcount'=>$followdata);

        //handle event change user follow
        $listIdUserFollows = TourReportFollowers::select('tour_report_id')->where('user_id',$user_id)->where('status','1')->pluck('tour_report_id')->toArray();
        $listUserFollows = User::select('user_name')->whereIn('id', $listIdUserFollows)->pluck('user_name')->toArray();
        
        event(new ChangeUserFollows($user_id, $followdata, $listUserFollows));
        //end handle event change user follow

        return $data;
    }

    public function collaboration($id, Request $request){
        $user_id=$id;
        $user_id=encrypt_decrypt('decrypt', $user_id);
        $role_type=Auth::user()->role_type;

        $followdata= $followdata=TourReportFollowers::where('user_id',$user_id)->where('tour_report_id',Auth::user()->id)->first();

        $userdata= UserDetails::where('user_id',$user_id)->first();

        $alert_super_data = TravelReports::withCount('supers')->withCount('alerts')->where('user_id',$user_id)->where('status','1')->get();

        $followcount=TourReportFollowers::where('user_id',$user_id)->where('status','1')->count();

        $roledata=Role::where('name',$role_type)->first();

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

        $ads_data = Advertisement::orderby('id','desc')->where($condition)->get();

        return view('frontend.user.collaboration',compact('roledata','userdata','followdata','alert_super_data','followcount', 'ads_data'));
    }


    public function collaboration_request(Request $request){
        $requestdata = new CollaborationRequest;
        $requestdata->role_type = $request->role_type;
        $requestdata->user_id = $request->user_id;
        $requestdata->request_id = $request->request_id;

        if($request->role_type=='travel_blogger'){
            if(isset($request->blog_service) && !empty($request->blog_service))
            {
                $blog_service_implode=implode(',',$request->blog_service);
                $requestdata->blog_service=isset($blog_service_implode)?$blog_service_implode:'';
            }
        }
        else{
            $requestdata->blog_service=isset($request->blog_service)?$request->blog_service:'';
        }

        $requestdata->message=isset($request->message)?$request->message:'';

        $requestdata->save();
        $user_email=User::select('id','email','user_name')->where('id',$requestdata->user_id)->first();
        $report_owner_email=User::select('id','email','user_name')->where('id',$requestdata->request_id)->first();

        $data['name'] = $report_owner_email->user_name;
        $data['email'] = $report_owner_email->email;
        $data['blog_service'] = $requestdata->blog_service;
        $data['request_message'] = $requestdata->message;

        $email_address = array('admin_email'=>$user_email->email);
        Mail::send('frontend.mail', $data, function($message) use($email_address){
            $message->to($email_address['admin_email'], 'Traveler Maker')->subject('Request Collaboration');
        });

        if(Mail::failures()) {
             return response()->Fail('Sorry! Please try again latter');
        }
        else{
            return redirect()->back()->withFlashSuccess(__('alerts.frontend.collaboration.request'));
        }
    }


    public function travel_action(Request $request)
       {
          $user_id= $request->userid;
          $report_id= $request->report_id;
          $action= $request->action;

          $updateaction=TravelAction::where('user_id',$user_id)->where('report_id',$report_id)->where('action',$action)->first();
          if(!empty($updateaction)){
             if($updateaction->action_status=='1'){

            $action_status=TravelAction::where('report_id',$report_id)->where('user_id',$user_id)->where('action',$action)->update([
              'action_status' => '0',
            ]);

             }else{

              $action_status=TravelAction::where('report_id',$report_id)->where('user_id',$user_id)->where('action',$action)->update([
                'action_status' => '1',
              ]);

             }
          }
          else{
               $adduser_action = new TravelAction;
               $adduser_action->user_id = $user_id;
               $adduser_action->report_id = $report_id;
               $adduser_action->action = $action;
               $adduser_action->action_status = '1';
               $adduser_action->save();
          }
          $actiondata=TravelAction::where('user_id',$user_id)->where('report_id',$report_id)->where('action',$action)->first();

          //event change like and alert
          $user_of_report = TravelReports::where('id', '=', $actiondata->report_id)->first();
          $userIdOfReport = $user_of_report->user_id;
          $alert_super_data = TravelReports::withCount('supers')->withCount('alerts')->where('user_id',$userIdOfReport)->where('status','1')->get();
          $numberOfAlert = 0;
          foreach ($alert_super_data as  $alert) {
            $numberOfAlert += $alert->alerts_count;
          }
          $numberOfLike = 0;
          foreach ($alert_super_data as  $super) {
            $numberOfLike += $super->supers_count;
          }
          event(new ChangeLikeAndAlertTravelReport($userIdOfReport, $numberOfLike, $numberOfAlert));
          //and event change like and alert

          //send email to sendInBlue
          if($action= 'alert'){
            $listCategoryIds = TravelReports::where('id', '=', $actiondata->report_id)->first();
            $list_category_ids = explode(",",$listCategoryIds->category_id);
            
            require_once(base_path() . '/vendor/autoload.php');

            foreach($list_category_ids as $categoryId){
                $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
                $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                    new GuzzleHttp\Client(),
                    $config
                );
                $createContact = new \SendinBlue\Client\Model\CreateContact();
                $createContact['email'] = Auth::user()->email;
                $createContact['updateEnabled'] = true;
                if($categoryId == 41){
                    $createContact['listIds'] = [10];
                }
                if($categoryId == 42){
                    $createContact['listIds'] = [12];
                }
                if($categoryId == 43){
                    $createContact['listIds'] = [11];
                }
                if($categoryId == 44){
                    $createContact['listIds'] = [14];
                }
                if($categoryId == 45){
                    $createContact['listIds'] = [15];
                }
                if($categoryId == 46){
                    $createContact['listIds'] = [20];
                }
                if($categoryId == 47){
                    $createContact['listIds'] = [21];
                }
                if($categoryId == 48){
                    $createContact['listIds'] = [16];
                }
                if($categoryId == 49){
                    $createContact['listIds'] = [19];
                }
                if($categoryId == 50){
                    $createContact['listIds'] = [17];
                }
                if($categoryId == 51){
                    $createContact['listIds'] = [22];
                }
                if($categoryId == 52){
                    $createContact['listIds'] = [23];
                }
                if($categoryId == 53){
                    $createContact['listIds'] = [13];
                }
                if($categoryId == 54){
                    $createContact['listIds'] = [18];
                }
                if($categoryId == 56){
                    $createContact['listIds'] = [39];
                }
                if($categoryId == 57){
                    $createContact['listIds'] = [40];
                }

                try {
                    $result = $apiInstance->createContact($createContact);
                } catch (\Exception  $e) {
                    Log::info($e->getMessage());
                }
            }
          }

          
          //end send email to sendInBlue
         return $actiondata->action_status;
       }

    public function tripreport(Request $request){
        $reportdata=TravelReports::where('user_id',$request->userid)->select('id','title')->get();
         // response()->json(['data'=>$reportdata]);

        if($reportdata->count()!==0){
            echo json_encode($reportdata);
        }else{
            return 0;
        }
    }

    public function same_trip_data(Request $request){
        $user_id= $request->user_id;
        $report_id= $request->report_id;
        $sametrip_id= $request->same_trip_id;
        $updatedata=SameTrip::where('user_id',$user_id)->where('report_id',$report_id)->where('same_trip_id',$sametrip_id)->first();
        if(!empty($updatedata)){
            $action_status=SameTrip::where('user_id',$user_id)->where('report_id',$report_id)->where('same_trip_id',$sametrip_id)->update([
              'user_id' => $user_id,
              'report_id' => $report_id,
              'same_trip_id' => $sametrip_id,
            ]);
        }else{

            $addsametrip= new SameTrip;
            $addsametrip->user_id = $user_id;
            $addsametrip->report_id = $report_id;
            $addsametrip->same_trip_id = $sametrip_id;
            $addsametrip->save();
        }
        return redirect()->back();
    }

    public function same_trip_delete(Request $request){
        $updatedata=SameTrip::where('user_id',$request->userid)->where('report_id',$request->report_id)->delete();
        return 1;
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
    public function advertisement()
    {
        $advertisement = Advertisement::get();
        $country_arr = Country::orderby('name','asc')->pluck('name', 'id')->toArray();
        $categories = Category::orderBy('id', 'asc')->pluck('name', 'id')->toArray();
        $travel_ages = DB::table('travel_ages')->pluck('name', 'id')->toArray();
        $travel_types = DB::table('travel_types')->pluck('name', 'name')->toArray();
        $travel_vectors = DB::table('travel_vectors')->where(['vector_type' => 'travel'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_accommodations = DB::table('travel_vectors')->where(['vector_type' => 'overnight_stays'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_participates = DB::table('travel_participates')->pluck('name', 'name')->toArray();
        $travel_formula = TravelFormula::orderby('name','asc')->pluck('name', 'name')->toArray();
        $travel_mealtype = DB::table('travel_vectors')->orderby('id','desc')->where(['vector_type' => 'meals'])->where('parent_id', '!=', 0)->pluck('name', 'name')->toArray();
        $travel_budget = TravelBudget::orderby('id','desc')->pluck('name', 'name')->toArray();
        return view('frontend.travelpro.control_panel.advertisement', compact('advertisement', 'categories', 'travel_ages', 'travel_types', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'travel_formula', 'travel_mealtype', 'travel_budget','country_arr'));
    }

    public function advertisementStore(Request $request)
    {
            $this->advertisementRepository->create($request->only(
            'type_file',
            'type',
            'ad_url',
            'description1',
            'title',
            'location',
            'embedded_link',
            'view',
            'category_id',
            'country',
            'age',
            'travel_types',
            'vector_type',
            'travel_accommodations',
            'travel_participates',
            'travel_formula',
            'travel_mealtype',
            'travel_budget',
            'ads_type',
            'status'
        ));

        return redirect()->route('frontend.user.advertisement')->withFlashSuccess(__('alerts.backend.advertisements.created'));
    }

 }
