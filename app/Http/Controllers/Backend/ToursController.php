<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Auth;
use Image;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Models\ToursModel;
use App\Models\ServicesModel;
use App\Models\DestinationModel;
use App\Models\CurrencyModel;
use App\Models\TourGraphicModel;
use App\Models\TourServicesModel;
use App\Models\TourDestinationModel;
use App\Http\Requests\Backend\Tours\StoreToursRequest;
use App\Repositories\Backend\Tours\ToursRepository;
use App\Http\Controllers\Controller;

class ToursController extends Controller
{
    protected $model;

    public function __construct(ToursRepository $tours)
     {
       $this->tours = $tours;
     }

    public function index()
    {
        return view('backend.tours.index')->withtours($this->tours->paginate(10));
    }

    public function create()
    {
       $service = ServicesModel::get();
       $destination = DestinationModel::get();
       $currency = CurrencyModel::get();
       return view('backend.tours.create',compact('service','destination','currency'));
    }

    public function store(StoreToursRequest $request)
    {
        $userid = Auth::user('id');
        $data = new ToursModel;

        $data->user_id = $userid->id;
        $data->departure_id = $request->departure_id;
        $data->title = $request->title;
        $data->description = $request->page_description;
        $data->no_of_days = $request->no_of_days;
        $data->no_of_nights = $request->no_of_nights;
        $data->cost = $request->currency.' '.$request->cost;

        $slug = $this->slugify($request->title);
        $data->slug = $slug;

        $data->start_date_time = $request->start_date_time;
        $data->end_date_time = $request->end_date_time;
        $data->meta_title = $request->meta_title;
        $data->meta_keywords = $request->meta_keywords;
        $data->meta_descirption = $request->meta_descirption;
        $data->status = 'pending';

       //for banner image insert
        if($request->hasFile('banner'))
        {
           //get the file
           $image = $request->file('banner');
           //get
           $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          //public path
          $destinationPath = public_path('/img/backend/tours/banner');
          $image->move($destinationPath, $img_name);
          //mve to destination you mentioned
           $data->banner = isset($img_name)?$img_name:'';
        }

        $data->save();

      //for multiple image insert
      if($request->hasfile('other_image'))
      {
        foreach($request->file('other_image') as $image)
        {

          //get image file name
          $uploadedFile = $image;

          $sourceProperties = getimagesize($uploadedFile);

          $newFileName = rand(11111, 99999);

          $newFileName1 =  rand(11111, 99999) . '.' . $image->getClientOriginalExtension();

          $dirPath = public_path("/img/backend/tours/other_image/");
          $ext = $image->getClientOriginalExtension();

          $imageType = $sourceProperties[2];

          switch ($imageType) {

            case IMAGETYPE_PNG:
                $imageSrc = imagecreatefrompng($uploadedFile);
                $tmp = $this->imageResize($imageSrc,$sourceProperties[0],
                  $sourceProperties[1]);
                imagepng($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;

            case IMAGETYPE_JPEG:
                $imageSrc = imagecreatefromjpeg($uploadedFile);
                $tmp = $this->imageResize($imageSrc,$sourceProperties[0],
                  $sourceProperties[1]);
                imagejpeg($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;

            case IMAGETYPE_GIF:
                $imageSrc = imagecreatefromgif($uploadedFile);
                $tmp = $this->imageResize($imageSrc,$sourceProperties[0],
                  $sourceProperties[1]);
                imagegif($tmp,$dirPath. $newFileName. "_thump.". $ext);
                break;

            default:
                echo "Invalid Image type.";
                exit;
                break;
          }


            move_uploaded_file($uploadedFile, $dirPath. $newFileName. ".". $ext);

            $mulltipleArr = array(
                   'tour_id' => $data->id,
                   'original_image' => $newFileName. ".". $ext,
                   'thumb_image' => $newFileName. "_thump.". $ext,
                   'middle_size_image' => $newFileName. "". $ext
            );

                TourGraphicModel::insert($mulltipleArr);
            }
         }

       //for multiple destination  insert
       if($request->destination)
        {
            foreach($request->destination as $desti_row)
            {
                $mulltipledestiArr = array(
                   'tour_id' => $data->id,
                   'destination_id' => $desti_row,
                );

                TourDestinationModel::insert($mulltipledestiArr);
            }
         }

       //for multiple services  insert
       if($request->services)
        {
            foreach($request->services as $service_row)
            {
                $mulltipleserviceArr = array(
                   'tour_id' => $data->id,
                   'service_id' => $service_row,
                );

                TourServicesModel::insert($mulltipleserviceArr);
            }
         }

      return redirect()->route('admin.tours')->withFlashSuccess(__('alerts.backend.tours.created'));

    }

    public function edit($id)
    {
       $service = ServicesModel::get();
       $destination = DestinationModel::get();
       $currency = CurrencyModel::get();

       $tour_edit = ToursModel::with('tour_destination','tour_services','tour_other_image')->where(['id'=>$id])->first();


       foreach($tour_edit->tour_destination as $tour_desti){
            $desti_arr[] = ($tour_desti->destination_id)?$tour_desti->destination_id:"null";
       }
       //dd($desti_arr);

       foreach($tour_edit->tour_services as $tour_service){
            $service_arr[] = $tour_service->service_id;
       }

        return view('backend.tours.edit',compact('tour_edit', 'desti_arr', 'service_arr', 'service','destination','currency'));
    }


    public function update(request $request, $id)
    {
        $data = ToursModel::find($id) ;

        $userid = Auth::user('id');
        $data->user_id = $userid->id;
        $data->departure_id = $request->departure_id;
        $data->title = $request->title;
        $data->description = $request->page_description;
        $data->no_of_days = $request->no_of_days;
        $data->no_of_nights = $request->no_of_nights;
        $data->cost = $request->currency.' '.$request->cost;

        $slug = $this->slugify($request->title);
        $data->slug = $slug;

        $data->start_date_time = $request->start_date_time;
        $data->end_date_time = $request->end_date_time;
        $data->meta_title = $request->meta_title;
        $data->meta_keywords = $request->meta_keywords;
        $data->meta_descirption = $request->meta_descirption;
        $data->status = 'pending';

       //for banner image insert
        if($request->hasFile('banner'))
        {
           //get the file
           $image = $request->file('banner');
           //get
           $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
          //public path
          $destinationPath = public_path('/img/backend/tours/banner');
          $image->move($destinationPath, $img_name);
          //mve to destination you mentioned
           $data->banner = isset($img_name)?$img_name:'';
        }

        //dd($data);

        $data->save();

      //for multiple image insert
       if($request->hasfile('other_image'))
        {
            foreach($request->file('other_image') as $image)
            {
                $name= rand(11111, 99999) . '.' . $image->getClientOriginalExtension();

                $image->move(public_path().'/img/backend/tours/other_image', $name);

                $data->image = $name;

                $mulltipleArr = array(
                   'tour_id' => $data->id,
                   'original_image' => $data->image,
                   'thumb_image' => $data->image,
                   'middle_size_image' =>$data->image
                );

                TourGraphicModel::insert($mulltipleArr);
            }
         }

       //for multiple destination  insert
       if($request->destination)
        {
            TourDestinationModel::where('tour_id', $id)->delete();
            foreach($request->destination as $desti_row)
            {
                $mulltipledestiArr = array(
                   'tour_id' => $data->id,
                   'destination_id' => $desti_row,
                   'updated_at' => date('Y-m-d h:i:s')
                );
                TourDestinationModel::insert($mulltipledestiArr);
            }
         }

       //for multiple services  insert
       if($request->services)
        {
            TourServicesModel::where('tour_id', $id)->delete();
            foreach($request->services as $service_row)
            {
                $mulltipleserviceArr = array(
                   'tour_id' => $data->id,
                   'service_id' => $service_row,
                   'updated_at' => date('Y-m-d h:i:s')
                );
           TourServicesModel::insert($mulltipleserviceArr);
            }
         }

      return redirect()->route('admin.tours')->withFlashSuccess(__('alerts.backend.tours.updated'));
    }

    public function destroy($id)
    {
       $this->tours->delete($id);
       return redirect()->route('admin.tours')->withFlashDanger(__('alerts.backend.tours.deleted'));
    }


    //custom function for create the page slug
    public static function slugify($text)
    {
       // replace non letter or digits by -
       $text = preg_replace('~[^\pL\d]+~u', '_', $text);
       // transliterate
       $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      // remove unwanted characters
       $text = preg_replace('~[^-\w]+~', '', $text);
      // trim
      $text = trim($text, '-');
      // remove duplicate -
      $text = preg_replace('~-+~', '_', $text);

      // lowercase
      $text = strtolower($text);
      if (empty($text)) {
       return 'n-a';
      }
       return $text;
    }


   public function deletetourimg($id){
        $ids = $_REQUEST['ids'];
        TourGraphicModel::where('id', $ids)->delete();
    }


  //custom function for image resize (code by durgesh (02-03-2020))
  public function imageResize($imageSrc,$imageWidth,$imageHeight){
    $newImageWidth =200; //set new image width
    $newImageHeight =200; //set new image height

    //new image layer
    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);

    //image copy resampled
    imagecopyresampled($newImageLayer, $imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
  }



}
