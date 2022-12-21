
<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Tour\StoreTourRequest;
use App\Models\Tour;
use App\Models\TourImages;
use App\Http\Controllers\Controller;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tours = Tour::with('tour_images')->get();
        return view('backend.tour.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tour.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTourRequest $request)
    {
        $data = new Tour;

        $data->title = $request->title;
        $data->description = $request->tour_description;
        $data->rate = $request->rate;
        $data->rating = $request->cost;
        $data->review = $request->review;
        $data->status = 1;

        //for banner image insert
        if($request->hasFile('banner_image'))
        {
        $image = $request->file('banner_image'); //get the file
        $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
        $destinationPath = public_path('/img/backend/tour/banner');//public path
        $image->move($destinationPath, $img_name);//mve to destination you mentioned
        $data->banner = isset($img_name)?$img_name:'';
        }

        $data->save();

      //for multiple image insert
       if($request->hasfile('multiple_image'))
        {
            foreach($request->file('multiple_image') as $image)
            {
                $name= rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path().'/img/backend/tour/multiple_image', $name);
                $data->image = $name;

                $mulltipleArr = array(
                   'tour_id' => $data->id,
                   'img_name' => $data->image
                );

                TourImages::insert($mulltipleArr);
            }
         }
      return redirect()->route('admin.tour')->withFlashSuccess(__('alerts.backend.tour.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tour= Tour::with('tour_images')->where(['id'=> $id])->first();
        return view('backend.tour.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, $id)
    {
        $data = Tour::find($id) ;

        $data->title = $request->title;
        $data->description = $request->tour_description;
        $data->rate = $request->rate;
        $data->rating = $request->cost;
        $data->review = $request->review;
        $data->status = 1;

        //for banner image insert
        if($request->hasFile('banner_image'))
        {
        $image = $request->file('banner_image'); //get the file
        $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
        $destinationPath = public_path('/img/backend/tour/banner');//public path
        $image->move($destinationPath, $img_name);//mve to destination you mentioned
        $data->banner = isset($img_name)?$img_name:'';
        }

        $data->save();

      //for multiple image insert
       if($request->hasfile('multiple_image'))
        {
            foreach($request->file('multiple_image') as $image)
            {
                $name= rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path().'/img/backend/tour/multiple_image', $name);
                $data->image = $name;

                $mulltipleArr = array(
                   'tour_id' => $id,
                   'img_name' => $data->image
                );

                TourImages::insert($mulltipleArr);
            }
         }
      return redirect()->route('admin.tour')->withFlashSuccess(__('alerts.backend.tour.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      Tour::where('id', $id)->delete();
        return redirect()->route('admin.tour')->withFlashDanger(__('alerts.backend.tour.deleted'));
    }

    public function deleteimg($id){
        $ids = $_REQUEST['ids'];
        // $find_data = TourImages::where('id', $ids)->first();
        // $image_path = public_path("img/backend/tour/multiple_image/$find_data->img_name");

        // if (File::exists($image_path)) {
        //   unlink($image_path);
        // }
        TourImages::where('id', $ids)->delete();
    }

    public function countimg(request $request){
        // $array = array(
        //   'name'=>'durgesh'
        // );
        //echo json_encode($array);
        //dd($request->all());
        return 'durgesh';
    }

}
