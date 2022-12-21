<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Tour\StoreTourRequest;
use App\Models\TravelReport;
use App\Models\Advertisement;
use App\Models\AdsData;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use File;
use Auth;
use App\Repositories\Backend\AdvertisementRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\TravelFormula;
use App\Models\TravelBudget;
use App\Models\Country;

 
class AdvertisementController extends Controller
{
   /**
     * @var tourCarrierRepository
     */
    protected $advertisementRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(AdvertisementRepository $advertisementRepository)
    {
        $this->advertisementRepository = $advertisementRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
    public function index()
    {
        $advertisement = Advertisement::orderBy('id','desc')->paginate(10);
        return view('backend.advertisements.index', compact('advertisement'));
    }

    public function edit($id)
    {
        $data = Advertisement::where('id', $id)->first();
        $categories = Category::orderBy('id', 'asc')->pluck('name', 'id')->toArray();
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

        $travel_pro = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')->where([['role_type', 'travel_agency'], ['security_user', null]])->orderBy('display_name')->pluck('display_name', 'id')->toArray();
        return view('backend.advertisements.edit', compact('data', 'categories', 'travel_ages', 'travel_types', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'travel_formula', 'travel_mealtype', 'travel_budget','country_arr', 'travel_pro'));
    }

    public function create()
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
        $travel_pro = User::select(DB::raw("CONCAT(last_name, ' ', first_name) AS display_name"), 'id')->where([['role_type', 'travel_agency'], ['security_user', null]])->orderBy('display_name')->pluck('display_name', 'id')->toArray();
        
        return view('backend.advertisements.create', compact('advertisement', 'categories', 'travel_ages', 'travel_types', 'travel_vectors', 'travel_accommodations', 'travel_participates', 'travel_formula', 'travel_mealtype', 'travel_budget','country_arr', 'travel_pro')); 
    }

    public function store(Request $request)
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
            'status',
            'travel_pro'
        ));
        
        return redirect()->route('admin.advertisements')->withFlashSuccess(__('alerts.backend.advertisements.created'));
    }

    public function update(request $request, Advertisement $advertisement, $id = null)
    { 
       $advertisement = Advertisement::where(['id' => $id])->first();
       

       $this->advertisementRepository->update($advertisement, $request->only(
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
            'status',
            'travel_pro'
        ));

        return redirect()->route('admin.advertisements')->withFlashSuccess(__('alerts.backend.advertisements.updated'));
      }

    public function status(Request $request, Advertisement $advertisement, $status, $id=null)
    { 
        
        $this->advertisementRepository->mark($advertisement, (int) $status);

        return redirect()->route(
            (int) $status === '1' ?
            'admin.advertisements' :
            'admin.advertisements'
        )->withFlashSuccess(__('alerts.backend.advertisements.status_update'));

     return redirect()->back()->withFlashSuccess(__('alerts.backend.advertisements.status_update'));
    }

    public function destroy(Request $request, Advertisement $advertisement, $id)
    {
        Advertisement::where('id', $id)->delete();
        $this->advertisementRepository->forceDelete($advertisement);

        return redirect()->route('admin.advertisements.deleted')->withFlashSuccess(__('alerts.backend.advertisements.deleted'));
    }

   public function getDeactivated()
    {

        $advertisement = Advertisement::where('status','0')->orderBy('status','DESC')->paginate(10); 
        return view('backend.advertisements.deactivated', compact('advertisement'));
        
    }

    public function getDeleted()
    {

        $advertisement = Advertisement::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.advertisements.deleted', compact('advertisement'));
    }

     public function restore($id)
      {   
      
        $advertisement= DB::table('advertisements')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/advertisements/deleted');
      }

      public function ads_details()
      {   

         $ad_data = AdsData::orderBy('deleted_at','DESC')->with('ads')->get();


          return view('backend.advertisements.ad_data', compact('ad_data'));
      }

       public function show($id)
    {  
        $user = Advertisement::where('id', $id)->first();

        $ad_data = AdsData::orderBy('deleted_at','DESC')->where('id', $id)->with('ads')->get();
       
        return view('backend.advertisements.show', compact('user', 'ad_data'));
    }

}
