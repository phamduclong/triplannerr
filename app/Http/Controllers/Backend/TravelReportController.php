<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Tour\StoreTourRequest;
use App\Models\TravelReport;
use App\Models\TravelReports\TravelReports;
use App\Models\Travelcategory;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Country;
use App\Models\TourCarrier;
use App\Models\BookInformation;
use File;
use Auth;
use App\Models\EmailDetails;
use App\Models\Currency;
use App\Repositories\Backend\TravelReportRepository; 
use App\Http\Requests\Backend\TravelReport\ManageTravelReportRequest;
use App\Models\TravelReportComponent;
use App\Models\TravelReportGallery;
use App\Models\TravelReportSlideshow;
use App\Models\TravelReportCarriers;
use App\Models\SliderAudio;
use Mail;
use App\Models\TravelAction;
use App\Models\TourReportFollowers;
use App\Models\TourReportShare;
use App\Models\TravelVector;
use App\Models\SameTrip;


class TravelReportController extends Controller
{
    /**
     * @var tourCarrierRepository
     */
    protected $travelReportRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(TravelReportRepository $travelReportRepository)
    {
        $this->travelReportRepository = $travelReportRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function index(Request $request)
    { 
       //dd('dsf');
        $travel_report = TravelReport::with('CategoryName')->with('CountryName')->with('UserName')->orderBy('id','desc')->get();
       
        //dd($travel_report);
        return view('backend.travel_report.index', compact('travel_report'));//->with('travel_report', $this->travelReportRepository->getActivePaginated(20, 'id', 'DESC'));
    }
 
    // *
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
     
    public function create()
    {
        $categories = Travelcategory::orderBy('id','asc')->get();
        $currency_arr = Currency::select('name', 'id')->pluck('name', 'id')->toArray();
        foreach ($categories as $value) {

            $categoriesArr[] = $value->name;       

         }
         //dd($categoriesArr);
         $slide_data=SliderAudio::select('slide_audio', 'id')
                       ->pluck('slide_audio', 'id')
                       ->toArray();

         $countries = Country::orderBy('id','asc')->get();

        foreach ($countries as $value) {

            $countriesArr[] = $value->name;       

         }

         $tour_carrier = TourCarrier::orderBy('id','asc')->get();

        foreach ($tour_carrier as $value) {

            $tour_carrierArr[] = $value->title;       

         }

        $carrier_categ= TourCarrier::orderby('id','asc')->get();
        foreach($carrier_categ as $carrier_categ_row){
         $carrierg_arr[] = $carrier_categ_row->title;
       }

        //dd($categories);
        return view('backend.travel_report.create', compact('slide_data','currency_arr','categories', 'categoriesArr', 'countries', 'countriesArr', 'carrier_categ', 'carrierg_arr'));
    }


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


    public function store(Request $request)
    {
        //dd('sdf');
    //    dd($request->hasFile('cover_photo'));
         if ($request->hasFile('cover_photo'))
            {
                $imgName = time().'.'.request()->cover_photo->getClientOriginalExtension();
                request()->cover_photo->move(public_path('img/backend/travel_report'), $imgName);
                $full_path = public_path('/img/backend/travel_report/').$imgName;
                if(File::exists($full_path))
                {
                   File::delete($full_path);
                }

               $request->cover_photo = $imgName;
            } 

            if(isset($request->image_audio)){
                if ($request->hasFile('image_audio'))
                {
                    // $audiofile = $request->file('image_audio'); echo $audiofile;die;
                    $filename = time().'.'.request()->image_audio->getClientOriginalExtension();
                    
                    $audiofile->move(public_path('/audio/backend/travel_report/'), $filename);
                    $request->image_audio = $filename;
                }
            }
            
        $data = new TravelReport;
        $user_id = Auth::User('id');
        $data->user_id = $user_id->id;
        $data->title = $request->title;
        $data->category_id = $request->category_id;
        $data->report_startdate = date('Y-m-d', strtotime($request->trip_start));
        $data->report_enddate = date('Y-m-d', strtotime($request->trip_end));
        $data->country_departure = $request->country_departure;
        $data->country_destination = $request->country_destination;
        $data->no_of_participants = $request->no_of_participants;
        $data->travel_time = $request->total_travel_time;
        $data->travel_cost = $request->total_cost_of_trip;
        $data->description = $request->description;
        $data->cover_photo = $imgName;
        $data->lattitude = $request->lattitude;
        $data->longitude = $request->longitude;
        $data->report_option = isset($request->report_option)?$request->report_option:'report';
        $data->no_of_carries= $request->no_of_carries;
        $data->security_option= $request->security_option;
        $data->currency_id= $request->currency_id;
        $data->status = '1';
        $data->image_audio = $request->image_audio;//$filename;
        $data->save();

        $this->travel_report_carrier_save($request->no_of_carriers_during_journey, $data->id);

        $this->travel_report_component_save($request->component_name, $request->individual_cost, $request->total_cost,$data->id);

        $galleryimgname = $request->file('gallery_photo'); //get the file
        $checkgalleryimg = $request->hasFile('gallery_photo');

        $this->travel_report_gallery_save($galleryimgname, $checkgalleryimg, $request->gallery_caption, $request->location_of_shot,  $request->sorting_in_gallery, $data->id);

        $slidename = $request->file('slideshow_with_audio'); //get the file
        $checkslide = $request->hasFile('slideshow_with_audio');

        $this->travel_report_slideshow_save($slidename, $checkslide, $data->id);
     
        return redirect()->route('admin.travel_report')->withFlashSuccess(__('alerts.backend.travel_report.created'));
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

     public function travel_report_carrier_update($carrier_name, $lastinsertId){
        if($carrier_name)
        {
             TravelReportCarriers::where(['travel_report_id'=> $lastinsertId])->delete();
            foreach($carrier_name as $carrier_name_value)
            {
                $mulltipleArr = array(
                   'travel_report_id' => $lastinsertId,
                   'carrier_name' => $carrier_name_value,
                );

                TravelReportCarriers::insert($mulltipleArr);
            }
         }

    }

   //Add travel report component
    public function travel_report_component_save($component_name, $component_cost, $lastinsertId){
        if($component_name && $component_cost)
        {

            foreach($component_name as $key=>$component_name_value)
            {
                $mulltipleArr_comp = array(
                    'travel_report_id' => $lastinsertId,
                    'component_name' => $component_name_value,
                    'individual_cost' => $individual_cost[$key],
                    'total_cost' => $total_cost[$key],
                    'status' =>'1'
                );
                TravelReportComponent::insert($mulltipleArr_comp);
            }
         }
    }

    public function travel_report_component_update($component_name, $component_cost,$total_cost, $id){
// dd($component_cost);
        if($component_name && $component_cost)
        {
             TravelReportComponent::where(['travel_report_id'=> $id])->delete();

            foreach($component_name as $key=>$component_name_value)
            {
                $mulltipleArr_comp = array(
                   'travel_report_id' => $id,
                   'component_name' => $component_name_value,
                   'individual_cost' => $component_cost[$key],
                   'total_cost' => $total_cost[$key],
                   'status' =>'1'
                );

                TravelReportComponent::insert($mulltipleArr_comp);
            }
         }
    }

    //Add travel report Gallery
    public function travel_report_gallery_save($galleryimgname, $checkgalleryimg, $gallery_caption, $location_of_shot,  $sorting_in_gallery, $lastinsertId){
        if($checkgalleryimg)
        {
             
            foreach($galleryimgname as $key=>$gallery_row)
            {
                $publicpath = (public_path().'/img/backend/travel_report/');
                $new_gallery_image = $this->UploadFileConfig($publicpath, $checkgalleryimg, $gallery_row);

                $mulltiplegalleryArr = array(
                   'travel_report_id' => $lastinsertId,
                   'gallery_image' => $new_gallery_image,
                   'image_caption' => $gallery_caption[$key],
                   'image_location' => $location_of_shot[$key],
                   'image_sorting' => $sorting_in_gallery[$key],
                   'status' => '1'
                );

                TravelReportGallery::insert($mulltiplegalleryArr);
            }
         }

    }

    public function travel_report_gallery_update($galleryimgname, $checkgalleryimg, $gallery_caption, $location_of_shot,  $sorting_in_gallery, $id){
        if($checkgalleryimg)
        {
           

            foreach($galleryimgname as $key=>$gallery_row)
            {
                $publicpath = (public_path().'/img/backend/travel_report/');
                $new_gallery_image = $this->UploadFileConfig($publicpath, $checkgalleryimg, $gallery_row);

                $mulltiplegalleryArr = array(
                   'travel_report_id' => $id,
                   'gallery_image' => $new_gallery_image,
                   'image_caption' => $gallery_caption[$key],
                   'image_location' => $location_of_shot[$key],
                   'image_sorting' => $sorting_in_gallery[$key],
                   'status' => '1'
                );

                TravelReportGallery::insert($mulltiplegalleryArr);
            }
         }

    }

    public function travel_report_slideshow_save($slidename, $checkslide, $lastinsertId){
        if($checkslide)
        {
            foreach($slidename as $slide_row)
            {
                $publicpath = (public_path().'/img/backend/travel_report/');
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

    public function travel_report_slideshow_update($slidename, $checkslide, $lastinsertId){
        if($checkslide)
        {
            foreach($slidename as $slide_row)
            {
                $publicpath = (public_path().'/img/backend/travel_report/');
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

    public function edit($id){

        $categories = Travelcategory::orderBy('id','asc')->get();

        $travelcateg_arr = $this->gettravelcateg();

        $carrierg_arr_vector=TravelVector::select('name', 'id')->where(['parent_id' => 0])->pluck('name', 'id')->toArray();
       
        $currency_arr = Currency::select('name', 'id')->pluck('name', 'id')->toArray();

        foreach ($categories as $value) {

            $categoriesArr[] = $value->name;       

         }
         //dd($categories);
         $slide_data=SliderAudio::select('slide_audio', 'id')
         ->pluck('slide_audio', 'id')
         ->toArray();
         
        $countries = Country::orderBy('id','asc')->get();
        $countries_name = Country::first();
        foreach ($countries as $value) {

            $countriesArr[] = $value->name;       

         }

        $tour_carrier = TourCarrier::orderBy('id','asc')->get();
        $tour_carrier_checked = TravelReportComponent::where('travel_report_id', $id)->get();

        foreach ($tour_carrier as $value) {

            $tour_carrierArr[] = $value->title;       

         }

        $travel_report_carrier= TravelReportCarriers::where('travel_report_id', $id)->get()->toArray();
         $travel=array();
         foreach ($travel_report_carrier as $key => $value) {
             $travel[]=$value['carrier_name'];
         }


        $carrier_categ= TourCarrier::orderby('id','asc')->get();
        
        foreach($carrier_categ as $carrier_categ_row){
         $carrierg_arr[] = $carrier_categ_row->title;
       }

        $travel_report_component = TravelReportComponent::where('travel_report_id', $id)->where(['travel_report_id'=>$id, 'status'=>'1'])->get();

       
    //echo  '<pre>'; print_r($travel); exit;

        $travel_report_gallery = TravelReportGallery::where('travel_report_id', $id)->where('status', 1)->get();
        // /dd($travel_report_gallery);

        $travel_report_slideshow = TravelReportSlideshow::where('travel_report_id', $id)->where('status', 1)->get();
        // /dd($travel_report_slideshow);

        $data= TravelReport::where(['id'=> $id])->first();

        return view('backend.travel_report.edit', compact('slide_data','currency_arr','data', 'categories', 'categoriesArr','countries', 'countriesArr', 'carrier_categ', 'carrierg_arr', 'countries_name', 'tour_carrier_checked', 'travel_report_component', 'travel_report_gallery', 'travel_report_slideshow', 'travel_report_carrier','travel', 'travelcateg_arr' ));
    }


    public function update(Request $request, $id = null)
    { 
       $travelreport = TravelReport::where(['id' => $id])->first();
       $form_data = $request->all();

     if ($request->hasFile('cover_photo'))
        {

            $imgName = time().'.'.request()->cover_photo->getClientOriginalExtension();
            request()->cover_photo->move(public_path('/img/backend/travel_report/'), $imgName);

            $full_path = public_path('/img/backend/travel_report/').$request->oldimage;
            if(File::exists($full_path))
            {
               File::delete($full_path);
            }
          
          }else{

              $imgName = $request->oldimage;
        }

        $data = TravelReport::find($id);
        $user_id = Auth::User('id');
        

        // $data->user_id = $user_id->id;
        // $data->title = $request->title;
        // $data->category_id = $request->category_id;
        // $data->trip_start = date('Y-m-d', strtotime($request->trip_start));
        // $data->trip_end = date('Y-m-d', strtotime($request->trip_end));
        // $data->report_country = $request->report_country;
        // $data->travel_time = $request->travel_time;
        // $data->description = $request->description;
        // $data->cover_photo = $imgName;
        // $data->lattitude = $request->lattitude;
        // $data->longitude = $request->longitude;
        // $data->travel_cost = $request->travel_cost;

        // $data->save();

        $travelcateg_arr = $this->gettravelcateg();
        //dd($data->components);
        $data->user_id = $user_id->id;
        $data->title = $request->title;
        $data->category_id = !empty($form_data['category_id']) ? implode(',', $form_data['category_id']) : '';
        $data->report_startdate = date('Y-m-d', strtotime($request->report_startdate));
        $data->report_enddate = date('Y-m-d', strtotime($request->report_enddate));
        $data->country_departure = $request->country_departure;
        $data->country_destination = !empty($form_data['country_destination']) ? implode(',', $form_data['country_destination']) : '';
        $data->no_of_participants = $request->no_of_participants;
        $data->travel_time = $request->travel_time;
        $data->travel_cost = $request->travel_cost;
        $data->description = $request->description;
        $data->cover_photo = $imgName;
        $data->lattitude = $request->lattitude;
        $data->longitude = $request->longitude;
        $data->report_option = isset($request->report_option)?$request->report_option:'report';
        $data->no_of_carries= $request->no_of_carries;
        $data->security_option= empty($request->security_option) ? $data->security_option : $request->security_option;
        $data->currency_id= $request->currency_id;
        $data->status = '1';
        $data->image_audio = $request->image_audio;//$filename;
        $data->save();

        $this->travel_report_carrier_update($request->no_of_carriers_during_journey, $id);

        $this->travel_report_component_update($request->component_name, $request->component_cost,$request->total_cost, $data->id);
        // die;
        $galleryimgname = $request->file('gallery_photo'); //get the file
        $checkgalleryimg = $request->hasFile('gallery_photo');

        $this->travel_report_gallery_update($galleryimgname, $checkgalleryimg, $request->gallery_caption, $request->location_of_shot,  $request->sorting_in_gallery, $data->id);

        $slidename = $request->file('slideshow_with_audio'); //get the file
        $checkslide = $request->hasFile('slideshow_with_audio');

        $this->travel_report_slideshow_update($slidename, $checkslide, $data->id);
          
        $userdata = $this->getUserdetail($id);
          
        $this->basic_email($userdata['email'], $userdata['user_name']);

        //$this->warning($userdata['email'], $userdata['user_name']);

        return redirect()->route('admin.travel_report')->withFlashSuccess(__('alerts.backend.travel_report.updated'));
      }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request, TravelReport $travelreport, $id)
    {
        TravelReport::where('id', $id)->delete();
        $this->travelReportRepository->forceDelete($travelreport);

        return redirect()->route('admin.travel_report.deleted')->withFlashSuccess(__('alerts.backend.travel_report.deleted'));
    }


     public function status(Request $request, TravelReport $travelreport, $status)
    {
        $this->travelReportRepository->mark($travelreport, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'admin.travel_report' :
            'admin.travel_report'
        )->withFlashSuccess(__('alerts.backend.travel_report.updated'));
    }

     
    public function getDeactivated()
    {

        $travel_report = TravelReport::where('status',0)->orderBy('status','DESC')->get(); 
        return view('backend.travel_report.deactivated', compact('travel_report'));
        
    }

   
    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted()
    {

        $travel_report = TravelReport::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('backend.travel_report.deleted', compact('travel_report'));
    }

    public function gettravelcateg()
    {
        $travelcateg_arr[] = 'Select Category';
        $travel_categ= Travelcategory::where(['status'=>'1'])->orderby('name','asc')->pluck('name', 'id')->toArray();
        return ($travel_categ)?$travel_categ:"";
    }

    

     public function restore($id)
      {   
      
        $travel_report= DB::table('travel_reports')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/travel_report/deleted');
      }

      public function deletetravelimg($id){
        $ids = $_REQUEST['ids'];
        TravelReportSlideshow::where('id', $ids)->delete();
    }

    public function deletegalleryimg($id){
        $ids = $_REQUEST['ids'];
        TravelReportGallery::where('id', $ids)->delete();
    }

    public function deletecomponent($id){
        $ids = $_REQUEST['ids'];
        TravelReportComponent::where('id', $ids)->delete();
    }

    public function getUserdetail($tour_report_id){
        if($tour_report_id){
        $userdetail = TravelReport::where(['id'=>$tour_report_id])->first();

         $resultArr = $this->getuserdata($userdetail['user_id']);

         return ($resultArr)?$resultArr:'';
       } 
        
    }

    public function getuserdata($user_id){
         if($user_id){
            $resultArr = User::where(['id'=>$user_id])->first();
            return ($resultArr)?$resultArr:'';
         }
    }

    public function basic_email($email, $user_name){

      $data = array('name'=>$user_name,'email'=>$email);

      $email_address = array('user_email'=>$email,'main_user_name'=>$user_name);

      Mail::send(['text'=>'frontend.mail.create-report'],$data, function($message) use($email_address) {
        // dd($message);
         $message->to($email_address['user_email'], 'Traveler Maker')->subject
            ('Update Report');

         $message->from($email_address['user_email'], $email_address['main_user_name']);
      });
    }


    public function warning(Request $request){
           $id = $request->warning_id;
           $data=User::select('id','email','user_name')->where('id',$id)->first();
           //dd($data->email);
           $msg = $request->warning_massage;
           $user_email = array('name'=>$data->user_name,'email'=>$data->email, 'msg'=>$msg);

            $email_address = $data->email;
            
            
            Mail::send('backend.mail.create-report', $user_email, function($msg) use($email_address,$request){
            
            $msg->to($email_address, 'Traveler Maker')
                 ->subject('Warning Massage');

       });
            return redirect()->back()->withFlashSuccess(__('Massage Send Successfully'));
    } 

    public function book_information(){

       
        $bookdata=BookInformation::orderby('id','asc')->get();
         //dd($bookdata);
        if(count($bookdata)=='7'){
             $user_email=User::select('id','email','user_name')->where('id','1')->first();
           
              $email_address = $user_email->email;

              $mail_text=EmailDetails::where('type','Triggered Alert')->first();
              $sub=$mail_text->subject;
              
              $data = array('name'=>"Traveler Maker",'content' =>$mail_text->content);
              Mail::send('frontend.mail.alert', $data, function($message) use($email_address,$sub){
                $message->to($email_address, 'Traveler Maker')
                 ->subject($sub);
               });

               if (Mail::failures()) {
                  
                   return response()->Fail('Sorry! Please try again latter');
                 }else{
                     
                    return view('backend.book_information.index',compact('bookdata'));   
           }
        } 
       return view('backend.book_information.index',compact('bookdata'));      
    }


    public function travel_report_trip_page(){
        
       
        $report_data = TravelReports::withCount('supers', 'fbshare', 'follow')->withCount('alerts', 'twshare')->get();
        
        $user_id = User::first();
        $report_id = TravelReports::first();
        $id = $report_id->id;
        //dd($id);

        $countsuper = TravelAction::where('action','super')->count();
        $countalert = TravelAction::where('action','alert')->count();

        $followcount=TourReportFollowers::where('user_id', $user_id)->where('status','1')->count();

        return view ('backend.travel_report_trip_page.index', compact('report_data', 'countsuper', 'countalert', 'followcount', 'report_id'));
    }

     public function trip_page($id=null){
        $trip_id = $id;
        $sametrip_data= SameTrip::with('report', 'sametrip')->where('report_id',$id)->orwhere('same_trip_id',$id)->get();
        dd($sametrip_data);
        return view ('backend.travel_report.trip_page', compact('sametrip_data', 'trip_id'));
    }

    public function show(){
        
        return view ('backend.travel_report_trip_page.show');
    }


    public function status_book($id = null){
        if(!empty($id)){
            $book = BookInformation::where(['id' => $id])->first();
            if(!empty($book)){
                $status = ($book->status == '1') ? '0' : '1' ;
                
                if(BookInformation::where(['id' => $id])->update(['status' => $status])){
                    return redirect()->route('admin.book_information')->withFlashSuccess('Status has been updated');
                }
                else{
                    return redirect()->back()->withFlashWarning(__('There is some problem in updating status'));  
                }
            } 
            else{
                return redirect()->back()->withFlashWarning(__('Selected Book Information does not exists with us. Please try again'));  
            }
        }
        else{
            return redirect()->back()->withFlashWarning(__('Selected book Information does not exists with us. Please try again'));
        }
    }

     
     public function getDeactivated_book()
    {

        $travel_report = BookInformation::where('status','0')->get(); 
        return view('backend.book_information.deactivated', compact('travel_report'));
        
    }

    public function listBookInformation(Request $request)
    {
        
        try {
            $bookdata=BookInformation::orderby('id','asc');

            if(!empty($request->travel)){
                $travel = $request->travel;
                $bookdata = $bookdata
                ->whereHas('reportuser', function ($q) use ($travel)
                {
                    $q->where('role_type', $travel);
;                });
            }

            if(!empty($request->budget)){
                $budget = $request->budget;
                $bookdata = $bookdata
                ->whereHas('reportuser', function ($q) use ($budget)
                {
                    $q->where('preferred_travel_budget', $budget);
;                });
            }

            if(!empty($request->destination)){
                $destination = $request->destination;
                $bookdata = $bookdata
                ->whereHas('reportuser', function ($q1) use ($destination)
                {
                    $q1->whereHas('des_country', function ($q2) use ($destination){
                        $q2->where('name', 'like', '%'.$destination.'%');
                    });
;                });
            }

            if(!empty($request->category)){
                $category = $request->category;
                $bookdata = $bookdata
                ->whereHas('reportuser', function ($q1) use ($category)
                {
                    $q1->whereHas('category', function ($q2) use ($category){
                        $q2->where('name', 'like', '%'.$category.'%');
                    });
;                });
            }
 
            $bookdata = $bookdata->get();

            $html = view('includes.not-found')->render();

            if(count($bookdata)){
                $html = view('backend.book_information.includes.fetch_table', ['bookdata' => $bookdata])->render();
            }      
            
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'html' => $html
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'failed',
                'e' => $e->getMessage()
            ], 500);
        }
    }

}
