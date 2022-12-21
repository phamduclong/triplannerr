<?php

use App\Helpers\General\HtmlHelper;
use App\Models\Countries\Countries;
use App\Models\TravelAction;
use App\Models\TravelReports\TravelReports;
use App\Models\Travelcategory;
use App\Models\Country;
use App\Models\SameTrip;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Models\AdsData;
use App\Models\Staticpage;
use App\Models\SocialSetting;
use App\Models\Currency;
use Illuminate\Support\Facades\DB;
use App\Models\TravelVector;


if (! function_exists('style')) {
    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function style($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->style($url, $attributes, $secure);
    }
}

if (! function_exists('script')) {
    /**
     * @param       $url
     * @param array $attributes
     * @param null  $secure
     *
     * @return mixed
     */
    function script($url, $attributes = [], $secure = null)
    {
        return resolve(HtmlHelper::class)->script($url, $attributes, $secure);
    }
}

if (! function_exists('form_cancel')) {
    /**
     * @param        $cancel_to
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_cancel($cancel_to, $title, $classes = 'btn btn-danger btn-sm')
    {
        return resolve(HtmlHelper::class)->formCancel($cancel_to, $title, $classes);
    }
}

if (! function_exists('form_submit')) {
    /**
     * @param        $title
     * @param string $classes
     *
     * @return mixed
     */
    function form_submit($title, $classes = 'btn btn-success btn-sm pull-right')
    {
        return resolve(HtmlHelper::class)->formSubmit($title, $classes);
    }
}

if (! function_exists('active_class')) {
    /**
     * Get the active class if the condition is not falsy.
     *
     * @param        $condition
     * @param string $activeClass
     * @param string $inactiveClass
     *
     * @return string
     */
    function active_class($condition, $activeClass = 'active', $inactiveClass = '')
    {
        return $condition ? $activeClass : $inactiveClass;
    }
}

if(!function_exists('displayDate'))
{
    function displayDate($date = null, $format= 'M d, Y')
    {
        $disp_date='';
        if(is_string($date)){
            $disp_date=date($format,strtotime($date));
        }
        else if(!empty($date) && $date!='0000-00-00' && $date!='0000-00-00 00:00:00') {
            $disp_date=$date->format($format);
        }
        return $disp_date;
    }
}

if(!function_exists('getCountryName'))
{
    function getCountryName($country_id=null)
    {
        $country = Countries::where('id', $country_id)->first();
        if(!empty($country))
        {
            return $country->name;
        }
        return '';
    }
}

if(!function_exists('check_super_from_user'))
{
    function check_super_from_user($report_id=null, $user_id = null)
    {
        $super = TravelAction::where(['user_id' => $user_id, 'report_id'=> $report_id, 
        'action' => 'super'])->first();
        
        if(!empty($super))
        {
            $checkstatus=$super->action_status;
            return $checkstatus;
        }
        return false;
    }
}

if(!function_exists('check_alert_from_user'))
{
    function check_alert_from_user($report_id=null, $user_id = null)
    {
        $alert = TravelAction::where(['user_id' => $user_id, 'report_id'=> $report_id, 
        'action' => 'alert'])->first();
        
        if(!empty($alert))
        {
            $checkstatus=$alert->action_status;
            return $checkstatus;
        }
        return false;
    }
}

if(!function_exists('check_sametrip_page_from_user'))
{
    function check_sametrip_page_from_user($report_id=null, $user_id = null)
    {

        $same_trip_page = TravelAction::where(['user_id' => $user_id, 'report_id'=> $report_id, 
        'action' => 'same trip page'])->first();
        
        if(!empty($same_trip_page))
        {
            $checkstatus=$same_trip_page->action_status;
           
            return $checkstatus;
        }
        return false;
    }
}

if(!function_exists('check_sametrip_from_user'))
{
    function check_sametrip_from_user($report_id=null, $user_id = null)
    {
        // DB::enableQueryLog();
        $same_trip = SameTrip::where(['user_id' => $user_id, 'report_id'=> $report_id ])->first();
        // dd(DB::getQueryLog());
        if(!empty($same_trip))
        {
            $checkstatus=$same_trip->status;
           
            return $checkstatus;
        }
        return false;
    }
}

if(!function_exists('getAgeRatio'))
{
    function getAgeRatio($age_id=null)
    {
        $age_ratio = DB::table('travel_ages')->where('id', $age_id)->first();
        if(!empty($age_ratio))
        {
            return $age_ratio->name;
        }
        return '';
    }

    
}

if (!function_exists('encrypt_decrypt')) {
    /**
     * checks if current URL is of current menu/sub-menu.
     */
    function encrypt_decrypt($action, $string) {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        //This is my secret key
        $secret_key = '5b7cfd2937f2681f1d9139e5963312a39266ce52df93ded48f93d0f10b3c35ba';
        //This is my secret iv
        $secret_iv = '566ce52df93ded48f93d0f10b3c35bab7cfd2937f2681f1d9139e5963312a392';
        // hash
        $key = hash('sha256', $secret_key);
        
        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }
}

if(!function_exists('slugify'))
{
    function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }
}
if(!function_exists('getcountrydeparture'))
{
    function getcountrydeparture($dep_id=null)
    {
        $dep_data = Country::where('id', $dep_id)->first();
        if(!empty($dep_data))
        {
            return $dep_data->name;
        }
        return '';
    }

}
if(!function_exists('getcountrydestination'))
{
    function getcountrydestination($des_id=null)
    {
        $des_data = Country::where('id', $des_id)->first();
        if(!empty($des_data))
        {
            return $des_data->name;
        }
        return '';
    }

}
if(!function_exists('getrole_data'))
{
    function getrole_data($user_id=null)
    {
        $user_data = User::where('id', $user_id)->first();
        $roledata=Role::where('name',$user_data->role_type)->first();
        
        if(!empty($roledata))
        {
            return $roledata->image;
        }
        return '';
    }
}

if(!function_exists('getuser_data'))
{
    function getuser_data($user_id=null)
    {
        $user_data = User::where('id', $user_id)->select('user_name','email')->first();
        
        if(!empty($user_data))
        {
            return $user_data;
        }
        return '';
    }
}

if(!function_exists('getreport_data'))
{
    function getreport_data($user_id=null)
    {
        $report_data = TravelReports::where('id', $user_id)->first();
        //dd($report_data);
        
        if(!empty($report_data))
        {

            return $report_data;
        }
        return '';
    }
}
    
if(!function_exists('get_sametrip'))
{
    function get_sametrip($report_id=null)
    {
        $sametrip_data = SameTrip::where('report_id', $report_id)->orwhere('same_trip_id',$report_id)->get();
      
        if(!empty($sametrip_data))
        {

            return count($sametrip_data);
        }
        return '';
    }
}

if(!function_exists('get_superdata'))
{
    function get_superdata($report_id=null)
    {

        $super_data = TravelAction::where('report_id', $report_id)->where('action','super')->get();
         
        if(!empty($super_data))
        {

            return count($super_data);
        }
        return '';
    }
}
  

if(!function_exists('get_alertdata'))
{
    function get_alertdata($report_id=null)
    {
        $alert_data = TravelAction::where('report_id', $report_id)->where('action','alert')->get();
         
        if(!empty($alert_data))
        {

            return count($alert_data);
        }
        return '';
    }
}


if(!function_exists('get_click_count'))
{
    function get_click_count($ads_id=null)
    {
        $click_data = AdsData::where('ad_id', $ads_id)->get();
         
        if(!empty($click_data))
        {

            return count($click_data);
        }
        return '';
    }
} 

if(!function_exists('get_social_data'))
{
    function get_social_data()
    {
        $social_data = SocialSetting::first();
         
        if(!empty($social_data))
        {

            return $social_data;
        }
        return '';
    }
}  

if(!function_exists('get_static_page'))
{
  function get_static_page($slug=null)
  {
    $static_page = Staticpage::get();
     
    if(!empty($static_page))
    {
        
        return $static_page;
    }
    return '';
   }
} 

if(!function_exists('get_report'))
{
    function get_report($report_id=null)
    {
        $report =  TravelReports::where('id',$report_id)->first();
        if(!empty($report))
        {
          return $report;
        }
        return '';
    }
}

if(!function_exists('getCurrencySymbol')){
    function getCurrencySymbol($currency_id = null)  {
        $symbol = '';
        if(!empty($currency_id))
        {
            $currency = Currency::where('id', $currency_id)->first();
            if(!empty($currency))
            {
                $symbol = $currency->symbol;
            }
        }
        return $symbol;
    }
} 

if(!function_exists('get_sub_vectors')){
    function get_sub_vectors($parent_id = null)  {
        $sub_vectors = [];
        if(!empty($parent_id))
        {
            $sub_vectors = TravelVector::select('id', 'name')->where('parent_id', $parent_id)->pluck('name', 'id')->toArray();
            if(!empty($sub_vectors))
            {
                return $sub_vectors;
            }
            else{
                return $sub_vectors;
            }
        }
        return $sub_vectors;
    }
}



if (! function_exists('getUserdata')) {
    function getUserdata($user_id = null)
    { 
     $usernames='';
      if(!empty($user_id))
        {
        $username = User::where('id', $user_id)->first();
          if(!empty($username))
            {
                $usernames = $username->user_name;
            }
     }
     return  $usernames;

    }
} 
if (! function_exists('getUserEmail')) {
    function getUserEmail($user_id = null)
    { 
     $usernames='';
      if(!empty($user_id))
        {
        $username = User::where('id', $user_id)->first();
          if(!empty($username))
            {
                $usernames = $username->email;
            }
     }
     return  $usernames;

    }
}