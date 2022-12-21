<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\User;
use App\Models\UserImages;


/**
 * Class User.
 */
class UserDetails extends Model
{
   protected $table = 'user_details';

   protected $fillable = [
      'user_id',
      'sex',
      'phone_no',
      'place_of_residence',
      'birth_place',
      'term_condition',
      'preferred_type',
      'telephone_number',
      'describe_yourself',
      'vat_number',
      'personal_website',
      'fb_link',
      'twitter_link',
      'insta_link',
      'pinterest_link',
      'tiktok_link',
      'youtube_link',
      'preferred_travel_category',
      'type_of_travel',
      'preferred_travel_budget',
      'agency_name',
      'agency_website',
      'agency_address',
      'license_detail',
      'identification_option',
      'local_operator',
      'agency_logo',
      'other',
      'fav_nation',
      'fav_nation_want',
      'identity_document',
      'profile_image',
      'cover_image',
      'signed_doc',
      'travel_favoritemealtype',
      'vector_type',
      'type_of_accommodation',
      'type_of_participants',
      'blogger_service',
      'created_at',
      'updated_at',
      'deleted_at',
      'linkedin_link',
   ];

   public function user() {
      return $this->belongsTo(User::class, 'user_id');
   }

   public function TravelReport() {
      return $this->belongsTo(TravelReport::class,'id');
   }

   public function updateProfilePicture($img_name) {
      if(file_exists(public_path('/crop_images/'.$img_name)) && 
         copy(public_path('/crop_images/'.$img_name), public_path('/img/frontend/user/'.$img_name))
      ){
         unlink(public_path('/crop_images/'.$img_name));
         $this->profile_image = $img_name;
         $this->save();
      }
   }

   public function updateCoverPicture($img_name) {
      if(file_exists(public_path('/crop_images/'.$img_name)) && 
         copy(public_path('/crop_images/'.$img_name), public_path('/img/frontend/user/'.$img_name))
      ){
         unlink(public_path('/crop_images/'.$img_name));
         $this->cover_image = $img_name;
         $this->save();
      }
   }

   public function updateAgencyLogo($img_name) {
      if(file_exists(public_path('/crop_images/'.$img_name)) && 
         copy(public_path('/crop_images/'.$img_name), public_path('/img/frontend/user/'.$img_name))
      ){
         unlink(public_path('/crop_images/'.$img_name));
         $this->agency_logo = $img_name;
         $this->save();
      }
   }

}
