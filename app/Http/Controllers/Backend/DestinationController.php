<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DestinationModel;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Http\Requests\Backend\Destination\StoreDestinationRequest;
use App\Repositories\Backend\Destination\DestinationRepository;
use App\Http\Controllers\Controller;

class DestinationController extends Controller
{

    protected $model;

    public function __construct(DestinationRepository $destination)
     {
       $this->destination = $destination;
     }


    public function index()
    {
        return view('backend.destination.index')->withdestination($this->destination->orderby('id','desc')->paginate(10));
    }


    public function create()
    {
         $country_arr = Country::get();
        return view('backend.destination.create', compact('country_arr'));
    }

    public function store(StoreDestinationRequest $request)
    {
        $data = new DestinationModel;

        $data->destination_id = $request->destination_id;
        $data->name = $request->name;
        $data->description = $request->page_description;
        $data->country_id = $this->getCountryId($request->country);
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->wheather = $request->wheather;
        $data->popular = $request->popular;
        $data->visits = $request->visits;
        $data->lattitude = $request->lattitude;
        $data->longitude = $request->longitude;
        $data->is_active = 'Y';

       $data->save();
       return redirect()->route('admin.destination')->withFlashSuccess(__('alerts.backend.destination.created'));

    }

    public function edit($id)
    {
        $destination = DestinationModel::where('id', $id)->first();
        $country_arr = Country::get();
        $states_arr = State::get();
        $city_arr = City::get();
        return view('backend.destination.edit', compact('destination','country_arr', 'states_arr', 'city_arr'));
    }

    public function update(StoreDestinationRequest $request, $id)
    {
        $data = DestinationModel::find($id);
        $data->destination_id = $request->destination_id;
        $data->name = $request->name;
        $data->description = $request->page_description;
        $data->country_id = $this->getCountryId($request->country);
        $data->country = $request->country;
        $data->state = $request->state;
        $data->city = $request->city;
        $data->wheather = $request->wheather;
        $data->popular = $request->popular;
        $data->visits = $request->visits;
        $data->lattitude = $request->lattitude;
        $data->longitude = $request->longitude;
        $data->is_active = 'Y';
        $data->save();
        return redirect()->route('admin.destination')->withFlashSuccess(__('alerts.backend.destination.updated'));
    }

    public function destroy($id)
    {
       $this->destination->delete($id);
       return redirect()->route('admin.destination')->withFlashDanger(__('alerts.backend.destination.deleted'));
    }

   //get the state for destination
    public function getallstate($id){
        $stateArr = State::where('country_id', $id)->get();
        return response()->json($stateArr);
    }

    //get the city for destination
    public function getallcity($id){
        $cityArr = City::where('state_id', $id)->get();
        return response()->json($cityArr);
    }

   //get the country code for destination
    public function getCountryId($id = null)
    {
        $country = Country::where('id', $id)->first();
        return $country->sortname;
    }

}
