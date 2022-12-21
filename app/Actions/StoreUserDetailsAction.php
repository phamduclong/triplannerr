<?php

namespace App\Actions;

use Auth;
use Illuminate\Http\Request;
use App\Models\UserDetails;
use App\Models\Auth\User;
use Carbon\Carbon;
use SendinBlue;
use GuzzleHttp;
use Log;
use SendinBlue\Client;

class StoreUserDetailsAction {

    public function execute(Request $request): void {
        
        $userId = Auth::user()->id;

        $USER = User::where('id', $userId)->first();
        $USER->first_name = $request->first_name;
        $USER->last_name = $request->last_name;
        $USER->user_name = $request->user_name;

        if($USER->role_type == 'travel_agency' && empty($USER->trial_date)) {
            require_once(base_path() . '/vendor/autoload.php');

            $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
            $apiInstance = new SendinBlue\Client\Api\ContactsApi(
                new GuzzleHttp\Client(),
                $config
            );
            $createContact = new \SendinBlue\Client\Model\CreateContact();
            $createContact['email'] = $USER->email;
            $createContact['updateEnabled'] = true;
            $createContact['listIds'] = [50];
                    
            try {
                $result = $apiInstance->createContact($createContact);
            } catch (\Exception  $e) {
                Log::info($e->getMessage());
            }

            $USER->trial_date = Carbon::now();
        }

        if($USER->email != $request->email){
            $USER->email = $request->email;
            $USER->confirmed = 0; 
        };

        $USER->save();

        // print_r($request->all());
        // exit(0);

        $user = UserDetails::updateOrCreate(
            ['user_id' => $userId],
            [
                'user_id' => $userId,
                'sex' => $request->sex,
                'phone_no' => $request->phone_no,
                'birth_place' => $request->birth_place,
                'place_of_residence' => $request->place_of_residence,
                'preferred_type' => $request->preferred_type,
                'term_condition' => $request->term_condition,
                'type_of_travel' => $request->type_of_travel,
                'describe_yourself' => $request->describe_yourself,
                'sentimental_situation' => $request->sentimental_situation,
                'vat_number' => $request->vat_number,
                'personal_website' => $request->personal_website,
                'fb_link' => $request->fb_link,
                'twitter_link' => $request->twitter_link,
                'insta_link' => $request->insta_link,
                'pinterest_link' => $request->pinterest_link,
                'tiktok_link' => $request->tiktok_link,
                'youtube_link' => $request->youtube_link,
                // 'other' => $request->other,
                'blogger_service' => isset($request->blogger_service) ? implode(',',$request->blogger_service) : '',
                'preferred_travel_budget' => $request->preferred_travel_budget,
                'type_of_accommodation' => isset($request->type_of_accommodation) ? implode(',',$request->type_of_accommodation) : '',
                'preferred_travel_category' => isset($request->preferred_travel_category) ? implode(',',$request->preferred_travel_category) : '',
                'vector_type' => isset($request->vector_type) ? implode(',',$request->vector_type) : '',
                'fav_nation' => isset($request->fav_nation) ? implode(',',$request->fav_nation) : '',
                'fav_nation_want' => isset($request->fav_nation_want) ? implode(',',$request->fav_nation_want) : '',
                'type_of_participants' => isset($request->type_of_participants) ? implode(',',$request->type_of_participants) : '',
                'travel_favoritemealtype' => isset($request->type_of_fav_meals) ? implode(',',$request->type_of_fav_meals) : '',
                'linkedin_link' => isset($request->linkedin_link) ? str_replace(' ', '', $request->linkedin_link) : '',
                'agency_name' => isset($request->agency_name) ? $request->agency_name : '',
                'agency_website' => isset($request->agency_website) ? $request->agency_website : '',
                'agency_address' => isset($request->agency_address) ? $request->agency_address : '',
                'license_detail' => isset($request->license_detail) ? $request->license_detail : '',
                'identification_option' => isset($request->identification_option) ? implode(',',$request->identification_option) : '',
                'local_operator' => isset($request->local_operator) ? implode(',',$request->local_operator) : '',
                'other' => isset($request->other) ? $request->other : '',
            ]);

        if(!empty($request->travel_commitment)){
            $user->travel_commitment = $request->travel_commitment;
            $user->save();
        }

        if(!empty($request->tour_leader_commitment)){
            $user->tour_leader_commitment = $request->tour_leader_commitment;
            $user->save();
        }

        if(!empty($request->accept_travel_maker)){
            $user->accept_travel_maker = $request->accept_travel_maker;
            $user->save();
        }

        if(!empty($request->profile_image_name)) {
            $user->updateProfilePicture($request->profile_image_name);
        }

        if(!empty($request->cover_image_name)) {
            $user->updateCoverPicture($request->cover_image_name);
        }

        if(!empty($request->userdetail_agency_logo_image)){
            $user->updateAgencyLogo($request->userdetail_agency_logo_image);
        }

        if(!empty($request->front_identity_doc && $request->file('front_identity_doc'))) {
            $doc_fileName = $request->file('front_identity_doc')->getClientOriginalName();
            $request->file('front_identity_doc')->move(public_path('img/frontend/user/'), $doc_fileName);
            $user->front_identity_doc = $doc_fileName;
            $user->save();
        }

        if(!empty($request->back_identity_doc && $request->file('back_identity_doc'))) {
            $doc_fileName = $request->file('back_identity_doc')->getClientOriginalName();
            $request->file('back_identity_doc')->move(public_path('img/frontend/user/'), $doc_fileName);
            $user->back_identity_doc = $doc_fileName;
            $user->save();
        }
    }

    public function updateCoverImage(Request $request){
        $userId = Auth::user()->id;
        $user_detail = UserDetails::where('user_id', $userId)->first();
        if(!empty($request->cover_image_name)) {
            $user_detail->updateCoverPicture($request->cover_image_name);
        }
        // if(empty($user_detail->cover_image)){
        //     if($request->hasFile('cover_image')){
        //         $image = $request->file('cover_image');
        //         $image->move('img/frontend/user', $image->getClientOriginalName());

        //         $originalLink = 'img/frontend/user/' . $image->getClientOriginalName();
        //         $customLink = 'img/frontend/user/' . date("h_i_s") . '_' . $image->getClientOriginalName();
        //         copy($originalLink, $customLink);
        //         unlink(public_path($originalLink));
        //         $user_detail->cover_image = date("h_i_s") . '_' . $image->getClientOriginalName();
        //         $user_detail->save();
        //     }
        // }else{
        //     if(!empty($request->cover_image)) {
        //         $coverImageName = $user_detail->cover_image;
        //         if($request->hasFile('cover_image')){
        //             $image = $request->file('cover_image');
        //             $image->move('img/frontend/user', $image->getClientOriginalName());


        //             $originalLink = 'img/frontend/user/' . $image->getClientOriginalName();
        //             $customLink = 'img/frontend/user/' . date("h_i_s") . '_' . $image->getClientOriginalName();
        //             copy($originalLink, $customLink);
        //             unlink(public_path($originalLink));
        //             $user_detail->cover_image = date("h_i_s") . '_' . $image->getClientOriginalName();
        //             $user_detail->save();
        //             if(file_exists(public_path('img/frontend/user/'.$coverImageName))){
        //                 unlink(public_path('img/frontend/user/'.$coverImageName));
        //             }
                    
        //         }
        //     }
        // }
    }

    public function updateProfileImage(Request $request){
        $userId = Auth::user()->id;
        $user_detail = UserDetails::where('user_id', $userId)->first();
        if(!empty($request->profile_image_name)) {
            $user_detail->updateProfilePicture($request->profile_image_name);
        }
        // if(empty($user_detail->profile_image)){
        //     if($request->hasFile('profile_image')){
        //         $image = $request->file('profile_image');
        //         $image->move('img/frontend/user', $image->getClientOriginalName());

        //         $originalLink = 'img/frontend/user/' . $image->getClientOriginalName();
        //         $customLink = 'img/frontend/user/' . date("h_i_s") . '_' . $image->getClientOriginalName();
        //         copy($originalLink, $customLink);
        //         unlink(public_path($originalLink));
        //         $user_detail->profile_image = date("h_i_s") . '_' .$image->getClientOriginalName();
        //         $user_detail->save();
        //     }
        // }else{
        //     if(!empty($request->profile_image)) {
        //         $profileImageName = $user_detail->profile_image;
        //         if($request->hasFile('profile_image')){
        //             $image = $request->file('profile_image');
        //             $image->move('img/frontend/user', $image->getClientOriginalName());


        //             $originalLink = 'img/frontend/user/' . $image->getClientOriginalName();
        //             $customLink = 'img/frontend/user/' . date("h_i_s") . '_' . $image->getClientOriginalName();
        //             copy($originalLink, $customLink);
        //             unlink(public_path($originalLink));
        //             $user_detail->profile_image = date("h_i_s") . '_' .$image->getClientOriginalName();
        //             $user_detail->save();
        //             if(file_exists(public_path('img/frontend/user/'.$profileImageName))){
        //                 unlink(public_path('img/frontend/user/'.$profileImageName));
        //             }
                    
        //         }
        //     }
        // }
    }

}