<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Models\UserDetails;
use App\Models\Countries\Countries;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use App\Models\TravelSituation;
use App\Models\Travelcategory;
use App\Models\TravelTypes;
use App\Models\TravelAccommodation;
use App\Models\TravelVector;
use App\Models\TravelParticipate;
use App\Models\Conversation;
use App\Models\TravelFavoriteMealsType;
use App\Models\TravelBudget;
use App\Models\TravelFormula;
use App\Models\AgencyOption;
use App\Models\LocalOperator;
use App\Models\TouristFacility;
use App\Models\PublicCard;
use App\Models\BankDetails;
use App\Models\CollaborationRequest;
use App\Models\TourReportFollowers;
// use App\Models\TravelReports;
use SendinBlue;
use GuzzleHttp;
use SendinBlue\Client;
use App\Models\TravelReports\TravelReports;
use App\Models\Auth\Role;
use Log;
use Auth,DB;


/**
 * Class AccountController.
 */
class AccountController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    { 
        $id = Auth::user()->id;
        $user_role = Auth::user()->role_type;
        $countries = Countries::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_situation=TravelSituation::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_category=Travelcategory::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_type=TravelTypes::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_accommodation=TravelAccommodation::select('name', 'id')->pluck('name', 'id')->toArray();      
        $travel_vector=TravelVector::select('name', 'id')->where('parent_id',1)->pluck('name', 'id')->toArray();
        $travel_participate=TravelParticipate::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_favoritemealtype=TravelVector::select('name', 'id')->where('parent_id','!=','0')->where('vector_type','meals')->pluck('name', 'id')->toArray();
        $travel_budget=TravelBudget::select('name', 'id')->pluck('name', 'id')->toArray();
        $travel_formula=TravelFormula::select('name', 'id')->pluck('name', 'id')->toArray();
        $agency_option=AgencyOption::select('name', 'id')->pluck('name', 'id')->toArray();
        $local_operator=LocalOperator::select('name', 'id')->pluck('name', 'id')->toArray();
        $tourist_facility=TouristFacility::select('name', 'id')->pluck('name', 'id')->toArray();
        $user_data = User::with('userdetail', 'user_images')->where('id',$id)->first();

        $formFields = [];
        switch($user_role) {
            case 'traveler':
                $formFields = $this->getTravelerForm();
                break;
            case 'travel_maker':
                $formFields = $this->getTravelMakerForm();
                break;
            case 'travel_blogger':
                $formFields = $this->getTravelBloggerForm();
                break;
            case 'travel_agency':
                $formFields = $this->getTravelerAgencyForm();
                break;
        }

        return view('frontend.user.account',compact('user_data', 'countries','travel_situation',
          'travel_category','travel_type','travel_accommodation','travel_vector','travel_participate',
          'travel_budget','travel_formula','agency_option','local_operator','tourist_facility','travel_favoritemealtype', 'formFields'));
    }

    public function deleteAccount(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $user->security_user = $request->account;
        $user->save();

        $reports = TravelReports::where('user_id', Auth::user()->id)->get();
        foreach($reports as $report){
            $report->account_status = $request->account;
            $report->save();
        }

            
        require_once(base_path() . '/vendor/autoload.php');

        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new SendinBlue\Client\Api\ContactsApi(
            new GuzzleHttp\Client(),
            $config
        );
        $createContact = new \SendinBlue\Client\Model\CreateContact();
        $createContact['email'] = Auth::user()->email;
        $createContact['updateEnabled'] = true;
        if($request->account == 'cancel'){
            $createContact['listIds'] = [47];
        }else{
            $createContact['listIds'] = [48];
        }
        
                
        try {
            $result = $apiInstance->createContact($createContact);
        } catch (\Exception  $e) {
            Log::info($e->getMessage());
        }

        if($request->account == 'cancel'){
            return redirect(route('frontend.auth.logout'));
        }
        return redirect()->back()->withFlashSuccess("Change Successfully!");
    }

    public function reactiveAccount() {
        $user = User::where('id', Auth::user()->id)->first();
        $user->security_user = null;
        $user->save();

        $reports = TravelReports::where('user_id', Auth::user()->id)->get();
        foreach($reports as $report){
            $report->account_status = 'normally';
            $report->save();
        }

        require_once(base_path() . '/vendor/autoload.php');

        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new SendinBlue\Client\Api\ContactsApi(
            new GuzzleHttp\Client(),
            $config
        );
        $listId = 48;
        $contactIdentifiers = new \SendinBlue\Client\Model\RemoveContactFromList();
        $contactIdentifiers['emails'] = array(Auth::user()->email);
        $contactIdentifiers['updateEnabled'] = true;
                
        try {
            $result = $apiInstance->removeContactFromList($listId, $contactIdentifiers);
        } catch (\Exception  $e) {
            Log::info($e->getMessage());
        }

        return redirect()->back()->withFlashSuccess("Change Successfully!");
    }


    protected function getFirstStepForm() {
        return [
            'describe_yourself' => [
                'id' => 'describe_yourself',
                'parent' => 'userdetail',
                'type' => 'textarea',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.describe_yourself'),
                'placeholder' => 'Extended descriptive text',
            ],
            'cover_image' => [
                'id' => 'cover',
                'parent' => 'userdetail',
                'name' => 'cover_image',
                'type' => 'file',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'col-12 col-md-6 form-group',
                'label' => __('validation.attributes.frontend.cover_image'),
                'dimensionTemplate' => 'cover',
                'height' => 400,
                'width' => 1380,
                'preview' => true,
                'to_crop' => true,
                'validate' => true
            ],
            'profile_image' => [
                'id' => 'profile',
                'parent' => 'userdetail',
                'name' => 'profile_image',
                'type' => 'file',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'col-12 col-md-6 form-group',
                'label' => __('validation.attributes.frontend.profile_image'),
                'dimensionTemplate' => 'profile',
                'height' => 200,
                'width' => 200,
                'preview' => true,
                'to_crop' => true,
                'validate' => true
            ]
        ];
    }

    protected function getSecondStepForm() {
        $countriesOptions = Countries::getFormOptions();

        if(Auth::user()->role_type == 'traveler'){
            return [
                'first_name' => [
                    'id' => 'first_name',
                    'name' => 'first_name',
                    'type' => 'text',
                    'wrapper_classes' => 'col-md-6 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.first_name'),
                    'placeholder' => 'Insert your first name',
                    'required' => true,
                ],
                'last_name' => [
                    'id' => 'last_name',
                    'name' => 'last_name',
                    'type' => 'text',
                    'wrapper_classes' => 'col-md-6 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.last_name'),
                    'placeholder' => 'Insert your last name',
                    'required' => true,
                ],
                'user_name' => [
                    'id' => 'user_name',
                    'name' => 'user_name',
                    'type' => 'text',
                    'wrapper_classes' => 'col-md-6 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.user_name'),
                    'placeholder' => 'Insert your user name',
                    'required' => true,
                ],
                'phone_no' => [
                    'id' => 'phone_no',
                    'name' => 'phone_no',
                    'parent' => 'userdetail',
                    'type' => 'text',
                    'wrapper_classes' => 'col-md-3 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.phone_no'),
                    'placeholder' => 'Insert your phone number',
                    'required' => true,
                ],
                'email' => [
                    'id' => 'email',
                    'name' => 'email',
                    'type' => 'text',
                    'wrapper_classes' => 'col-md-3 form-group',
                    'classes' => 'form-control',
                    'label' => 'Email',
                    'placeholder' => 'Insert your email',
                    'required' => true,
                ],
                'birth_place' => [
                    'id' => 'birth_place',
                    'name' => 'birth_place',
                    'type' => 'date',
                    'wrapper_classes' => 'col-md-6 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.birth_place'),
                    'placeholder' => 'Insert your birth date',
                    'required' => true,
                ],
                'sex' => [
                    'id' => 'sex',
                    'name' => 'sex',
                    'parent' => 'userdetail',
                    'type' => 'select',
                    'wrapper_classes' => 'col-md-6 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.sex'),
                    'placeholder' => '',
                    'options' => [
                        1 => [
                            'label' => 'Male',
                            'value' => 'Male'
                        ],
                        2 => [
                            'label' => 'Female',
                            'value' => 'Female'
                        ],
                        3 => [
                            'label' => 'I don\'t want to say',
                            'value' => 'I don\'t want to say'
                        ]
                    ]
                ],
                'place_of_residence' => [
                    'id' => 'place_of_residence',
                    'parent' => 'userdetail',
                    'name' => 'place_of_residence',
                    'type' => 'text_auto_search',
                    'wrapper_classes' => 'col-12 form-group',
                    'classes' => 'form-control',
                    'label' => __('validation.attributes.frontend.place_of_residence'),
                    'placeholder' => '',
                    'options' => $countriesOptions
                ],
                'fav_nation' => [
                    'id' => 'search_data',
                    'name' => 'fav_nation[]',
                    'parent' => 'userdetail',
                    'type' => 'text',
                    'wrapper_classes' => 'col-12 form-group',
                    'classes' => 'form-control input-lg',
                    'label' => __('validation.attributes.frontend.favorite_nations'),
                    'placeholder' => ''
                ],
                'fav_nation_want' => [
                    'id' => 'search_data1',
                    'name' => 'fav_nation_want[]',
                    'parent' => 'userdetail',
                    'type' => 'text',
                    'wrapper_classes' => 'col-12 form-group',
                    'classes' => 'form-control input-lg',
                    'label' => __('validation.attributes.frontend.favorite_nations_want'),
                    'placeholder' => ''
                ],
                'front_identity_doc' => [
                    'id' => 'front_identity_doc',
                    'parent' => 'userdetail',
                    'name' => 'front_identity_doc',
                    'type' => 'file',
                    'wrapper_classes' => 'col-12 col-md-6 form-group',
                    'classes' => 'col-12 form-group',
                    'label' => __('validation.attributes.frontend.front_identity_doc'),
                    'validate' => false,
                    'preview' => true,
                ],
                'back_identity_doc' => [
                    'id' => 'back_identity_doc',
                    'parent' => 'userdetail',
                    'name' => 'back_identity_doc',
                    'type' => 'file',
                    'wrapper_classes' => 'col-12 col-md-6 form-group',
                    'classes' => 'col-12 form-group',
                    'label' => __('validation.attributes.frontend.back_identity_doc'),
                    'validate' => false,
                    'preview' => true,
                ],
            ];
        }

        return [
            'first_name' => [
                'id' => 'first_name',
                'name' => 'first_name',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.first_name'),
                'placeholder' => 'Insert your first name',
                'required' => true,
            ],
            'last_name' => [
                'id' => 'last_name',
                'name' => 'last_name',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.last_name'),
                'placeholder' => 'Insert your last name',
                'required' => true,
            ],
            'user_name' => [
                'id' => 'user_name',
                'name' => 'user_name',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.user_name'),
                'placeholder' => 'Insert your user name',
                'required' => true,
            ],
            'phone_no' => [
                'id' => 'phone_no',
                'name' => 'phone_no',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.phone_no'),
                'placeholder' => 'Insert your phone number',
                'required' => true,
            ],
            'email' => [
                'id' => 'email',
                'name' => 'email',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Email',
                'placeholder' => 'Insert your email',
                'required' => true,
            ],
            'birth_place' => [
                'id' => 'birth_place',
                'name' => 'birth_place',
                'type' => 'date',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.birth_place'),
                'placeholder' => 'Insert your birth date',
                'required' => true,
            ],
            'sex' => [
                'id' => 'sex',
                'name' => 'sex',
                'parent' => 'userdetail',
                'type' => 'select',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.sex'),
                'placeholder' => '',
                'options' => [
                    1 => [
                        'label' => 'Male',
                        'value' => 'Male'
                    ],
                    2 => [
                        'label' => 'Female',
                        'value' => 'Female'
                    ],
                    3 => [
                        'label' => 'I don\'t want to say',
                        'value' => 'I don\'t want to say'
                    ]
                ]
            ],
            'place_of_residence' => [
                'id' => 'place_of_residence',
                'parent' => 'userdetail',
                'name' => 'place_of_residence',
                'type' => 'text_auto_search',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.place_of_residence'),
                'placeholder' => '',
                'options' => $countriesOptions
            ],
            'fav_nation' => [
                'id' => 'search_data',
                'name' => 'fav_nation[]',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control input-lg',
                'label' => __('validation.attributes.frontend.favorite_nations'),
                'placeholder' => ''
            ],
            'fav_nation_want' => [
                'id' => 'search_data1',
                'name' => 'fav_nation_want[]',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control input-lg',
                'label' => __('validation.attributes.frontend.favorite_nations_want'),
                'placeholder' => ''
            ],
            'front_identity_doc' => [
                'id' => 'front_identity_doc',
                'parent' => 'userdetail',
                'name' => 'front_identity_doc',
                'type' => 'file',
                'wrapper_classes' => 'col-12 col-md-6 form-group',
                'classes' => 'col-12 form-group',
                'label' => __('validation.attributes.frontend.front_identity_doc'),
                'validate' => false,
                'preview' => true,
                'required' => true
            ],
            'back_identity_doc' => [
                'id' => 'back_identity_doc',
                'parent' => 'userdetail',
                'name' => 'back_identity_doc',
                'type' => 'file',
                'wrapper_classes' => 'col-12 col-md-6 form-group',
                'classes' => 'col-12 form-group',
                'label' => __('validation.attributes.frontend.back_identity_doc'),
                'validate' => false,
                'preview' => true,
                'required' => true
            ],
        ];
    }

    private function getThirdStepForm() {
        $travelCategoriesOptions = Travelcategory::getFormOptions();
        $travelTypesOptions = TravelTypes::getFormOptions();
        $travelAccomodationOptions = TravelAccommodation::getFormOptions();
        $travelVectorOptions = TravelVector::getTravelVectorFormOptions();
        $travelParticipateOptions = TravelParticipate::getFormOptions();
        $travelFormulaOptions = TravelFormula::getFormOptions();
        $travelBudgetOptions = TravelBudget::getFormOptions();
        $travelFavouriteMealsOptions = TravelVector::getFavouriteMealsFormOptions();

        return [
            'preferred_travel_category' => [
                'id' => 'preferred_travel_category',
                'name' => 'preferred_travel_category[]',
                'type' => 'multicheckbox',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.preferred_travel_category'),
                'options' => $travelCategoriesOptions
            ],
            'type_of_travel' => [
                'id' => 'type_of_travel',
                'name' => 'type_of_travel',
                'type' => 'radio',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.preferred_type_of_travel'),
                'options' => $travelTypesOptions
            ],
            'type_of_accommodation' => [
                'id' => 'type_of_accommodation',
                'name' => 'type_of_accommodation[]',
                'type' => 'multicheckbox',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.preferred_type_of_accommodation'),
                'options' => $travelAccomodationOptions
            ],
            'vector_type' => [
                'id' => 'vector_type',
                'name' => 'vector_type[]',
                'type' => 'multicheckbox',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.vector_type'),
                'options' => $travelVectorOptions
            ],
            'type_of_participants' => [
                'id' => 'type_of_participants',
                'name' => 'type_of_participants[]',
                'type' => 'multicheckbox',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.type_of_participants'),
                'options' => $travelParticipateOptions
            ],
            'preferred_travel_budget' => [
                'id' => 'preferred_travel_budget',
                'name' => 'preferred_travel_budget',
                'type' => 'radio',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.preferred_travel_budget'),
                'options' => $travelBudgetOptions
            ],
            'preferred_type' => [
                'id' => 'preferred_type',
                'name' => 'preferred_type',
                'type' => 'radio',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.preferred_type'),
                'options' => $travelFormulaOptions
            ],
            'travel_favoritemealtype' => [
                'id' => 'type_of_fav_meals',
                'name' => 'type_of_fav_meals[]',
                'type' => 'multicheckbox',
                'wrapper_classes' => 'col-12 form-group senti-list',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.type_of_fav_meals'),
                'options' => $travelFavouriteMealsOptions
            ],
        ];
    }

    protected function getTravelerForm() {

        $firstStepForm = $this->getFirstStepForm();
        $secondStepForm = $this->getSecondStepForm();
        $thirdStepForm = $this->getThirdStepForm();

        return $form = [
            'first_step' => $firstStepForm,
            'second_step' => $secondStepForm,
            'third_step' => $thirdStepForm
        ];
    }

    protected function getTravelerAgencyForm() {

        $firstStepForm = $this->getFirstStepForm();
        $secondStepForm = $this->getSecondStepForm();

        $travelAgencySecondStepForm = [
            'agency_name' => [
                'id' => 'agency_name',
                'name' => 'agency_name',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.agency_name'),
                'placeholder' => '',
            ],
            'agency_website' => [
                'id' => 'agency_website',
                'name' => 'agency_website',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.agency_website'),
                'placeholder' => '',
            ],
            'agency_address' => [
                'id' => 'agency_address',
                'name' => 'agency_address',
                'parent' => 'userdetail',
                'type' => 'textarea',
                'wrapper_classes' => 'col-md-12 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.agency_address'),
                'placeholder' => __('validation.attributes.frontend.agency_address'),
            ],
            'license_detail' => [
                'id' => 'license_detail',
                'name' => 'license_detail',
                'parent' => 'userdetail',
                'type' => 'textarea',
                'wrapper_classes' => 'col-md-12 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.license_detail'),
                'placeholder' => __('validation.attributes.frontend.license_detail'),
            ],
            'fb_link' => [
                'id' => 'fb_link',
                'name' => 'fb_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Facebook',
                'placeholder' => '',
            ],
            'twitter_link' => [
                'id' => 'twitter_link',
                'name' => 'twitter_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Twitter',
                'placeholder' => '',
            ],
            'insta_link' => [
                'id' => 'insta_link',
                'name' => 'insta_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Instagram',
                'placeholder' => '',
            ],
            'pinterest_link' => [
                'id' => 'pinterest_link',
                'name' => 'pinterest_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Pinterest',
                'placeholder' => '',
            ],
            'tiktok_link' => [
                'id' => 'tiktok_link',
                'name' => 'tiktok_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Tiktok',
                'placeholder' => '',
            ],
            'youtube_link' => [
                'id' => 'youtube_link',
                'name' => 'youtube_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Youtube',
                'placeholder' => '',
            ],
            'linkedin_link' => [
                'id' => 'linkedin_link',
                'name' => 'linkedin_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.linkedin_link'),
                'placeholder' => '',
            ],
            'travel_commitment' => [
                'id' => 'travel_commitment',
                'name' => 'travel_commitment',
                'parent' => 'userdetail',
                'type' => 'checkbox',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control',
                'label' => 'Signing of Commitment to organize travel only to share expenses with other travelers',
                'required' => true,
            ],
            'tour_leader_commitment' => [
                'id' => 'tour_leader_commitment',
                'name' => 'tour_leader_commitment',
                'parent' => 'userdetail',
                'type' => 'checkbox',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control',
                'label' => 'Signing of Commitment to be the groups tour leader during the trip',
                'required' => true,
            ],
        ];
        $thirdStepForm = $this->getThirdStepForm();

        return $form = [
            'first_step' => $firstStepForm,
            'second_step' => array_merge($secondStepForm, $travelAgencySecondStepForm),
            'third_step' => $thirdStepForm
        ];
    }

    protected function getTravelMakerForm() {

        $firstStepForm = $this->getFirstStepForm();
        $secondStepForm = $this->getSecondStepForm();

        $travelMakerSecondStepForm = [
            'accept_travel_maker' => [
                'id' => 'accept_travel_maker',
                'name' => 'accept_travel_maker',
                'parent' => 'userdetail',
                'type' => 'checkbox',
                'wrapper_classes' => 'col-12 form-group',
                'classes' => 'form-control',
                'label' => 'I accept the Terms and Conditions of use of the "Travel Maker" account',
            ],
        ];

        $thirdStepForm = $this->getThirdStepForm();

        return $form = [
            'first_step' => $firstStepForm,
            'second_step' => array_merge($secondStepForm, $travelMakerSecondStepForm),
            'third_step' => $thirdStepForm
        ];
    }

    protected function getTravelBloggerForm() {

        $firstStepForm = $this->getFirstStepForm();
        $secondStepForm = $this->getSecondStepForm();
        $thirdStepForm = $this->getThirdStepForm();

        $travelBloggerSecondStepForm = [
            'vat_number' => [
                'id' => 'vat_number',
                'name' => 'vat_number',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.vat_number'),
                'placeholder' => 'Insert your VAT number',
                'required' => true,
            ],
            'personal_website' => [
                'id' => 'personal_website',
                'name' => 'personal_website',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-6 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.personal_website'),
                'placeholder' => 'Insert your personal website',
                'required' => true,
            ],
            // 'other' => [
            //     'id' => 'other',
            //     'parent' => 'userdetail',
            //     'type' => 'textarea',
            //     'wrapper_classes' => 'col-12 form-group',
            //     'classes' => 'form-control',
            //     'label' => __('validation.attributes.frontend.other'),
            //     'placeholder' => 'Extended descriptive text',
            // ],
            'fb_link' => [
                'id' => 'fb_link',
                'name' => 'fb_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Facebook',
                'placeholder' => '',
            ],
            'twitter_link' => [
                'id' => 'twitter_link',
                'name' => 'twitter_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Twitter',
                'placeholder' => '',
            ],
            'insta_link' => [
                'id' => 'insta_link',
                'name' => 'insta_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Instagram',
                'placeholder' => '',
            ],
            'pinterest_link' => [
                'id' => 'pinterest_link',
                'name' => 'pinterest_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Pinterest',
                'placeholder' => '',
            ],
            'tiktok_link' => [
                'id' => 'tiktok_link',
                'name' => 'tiktok_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Tiktok',
                'placeholder' => '',
            ],
            'youtube_link' => [
                'id' => 'youtube_link',
                'name' => 'youtube_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => 'Youtube',
                'placeholder' => '',
            ],
            'linkedin_link' => [
                'id' => 'linkedin_link',
                'name' => 'linkedin_link',
                'parent' => 'userdetail',
                'type' => 'text',
                'wrapper_classes' => 'col-md-3 form-group',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.linkedin_link'),
                'placeholder' => '',
            ],
            'blogger_service' => [
                'id' => 'blogger_service',
                'name' => 'blogger_service[]',
                'type' => 'multicheckbox',
                'wrapper_classes' => 'col-12 form-group tb-services',
                'classes' => 'form-control',
                'label' => __('validation.attributes.frontend.service_term'),
                'options' => [
                    0 => [
                        'label' => 'Writing SEO articles with back-links Editing for your blog of an article that advertises "Travel Pro", which refers to his site, written in such a way as to implement Google s positioning of the "Travel Pro"',
                        'value' => '0',
                    ],
                    1 => [
                        'label' => 'Promotion on their social channels Speak genuinely about your experience with the "Travel Pro", adding tags and mentions to the social channels of the "Travel Pro"',
                        'value' => '1',
                    ],
                    2 => [
                        'label' => 'The blogger accesses the "Travel Pro" Instagram channel for a few hours to make stories, inviting his followers to follow this channel',
                        'value' => '2',
                    ],
                    3 => [
                        'label' => 'Creation of an ad hoc format Possibility to propose a specific web marketing project, agreeing it with the "Travel Pro"',
                        'value' => '3',
                    ],
                    4 => [
                        'label' => 'Creation of a promotional video available for the "Travel Pro"',
                        'value' => '4',
                    ],
                    5 => [
                        'label' => 'Creation of a package of at least 5 professional photos available for the "Travel Pro',
                        'value' => '5',
                    ],
                ]
            ],
        ];

        return $form = [
            'first_step' => $firstStepForm,
            'second_step' => array_merge($secondStepForm, $travelBloggerSecondStepForm),
            'third_step' => $thirdStepForm
        ];
    }














    //***********************************************************************/
    //*************************** OLD FUNCTIONS *****************************/
    //***********************************************************************/
    
    public function public_card(){

        return view('frontend.user.public_card');
    }

    public function public_card_save(Request $request){
    
      $add_card = new PublicCard;
      $add_card->departure_from_date = $request->departure_from_date;
      $add_card->departure_to_date = $request->departure_to_date;
      $add_card->price = $request->price;
      $add_card->payment_percentage = $request->payment_percentage;
      $add_card->min_participants = $request->min_participants;
      $add_card->max_participants = isset($request->max_participants)?$request->max_participants:'';
      $add_card->paypal_id = isset($request->paypal_id)?$request->paypal_id:'';
      $add_card->save();
      if($request->name_on_card){
          $add_bank=new BankDetails;
          $add_bank->user_id=Auth::user()->id;
          $add_bank->name_on_card=$request->name_on_card;
          $add_bank->card_number=$request->card_number;
          $add_bank->expiry_year=$request->expiry_year;
          $add_bank->expiry_month=$request->expiry_month;
          $add_bank->save();
      }
       return redirect()->route('frontend.user.public_card')->withFlashSuccess(__('alerts.backend.public_card.created'));
    }

    public function conversations()
    {
        $id = Auth::user()->id;
        $user_id=$id;
        
        $role_type=Auth::user()->role_type;
        $arr=$userdata=array();
        $request_send=CollaborationRequest::where('request_id',$user_id)->where('role_type',$role_type)->with('userdata','user')->get();
        $request_receive=CollaborationRequest::where('user_id',$user_id)->where('role_type',$role_type)->with('userdata','user')->get();

        $listSendConversations = Conversation::where('email_send', '=', Auth::user()->email)->get();
        $listRecieveConversations = Conversation::where('email_recieve', '=', Auth::user()->email)->get();
        
       
        $request_get=CollaborationRequest::where('user_id',$user_id)->get();
            foreach($request_get as $user)
            {
                $arr[]=$user->request_id;
            }
            if(!empty($arr)){
                array_unique($arr);
                $userdata = UserDetails::select('*')->whereIN('user_id',$arr)->with('user')->distinct()->get();
            }
            
          return view('frontend.user.conversations',compact('userdata','request_send','request_receive', 'listSendConversations', 'listRecieveConversations'));
    }

    public function getConversation(Request $request)
    {
        $user_id = $request->id;
        $request_send = CollaborationRequest::where('request_id',$user_id)->whereOr('user_id',$user_id)->with('userdata','user')->get();
    
        if(!empty($request_send))
        { 
            $html='<tr class="class-user"><th></th><th collspan="3"><u>Conversation</u></th></tr><tr class="class-user"><th></th><th>From</th><th>To</th><th>Message</th></tr>';
            foreach($request_send as $val)
            {
                
              $html.='<tr class="class-user"><td></td><td>'.$this->getUsername($val->request_id).'</td><td>'.$this->getUsername($val->user_id).'</td><td>'.$val->message.'</td></tr>';
            }
            return $html;
        }
    }

    public function getUsername($user)
    {
        $record=User::where('id',$user)->first();
        return $record->first_name.' '.$record->last_name;
    }

}
