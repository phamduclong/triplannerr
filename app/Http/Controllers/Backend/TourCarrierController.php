<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\TourCarrier\StoreTourCarrierRequest;
use App\Models\TravelReport;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\PlanFeatureId;
use App\Http\Controllers\Controller;
use App\Models\TourCarrier;
use File;
use Auth;
use App\Repositories\Backend\TourCarrierRepository; 
use App\Http\Requests\Backend\TourCarrier\ManageTourCarrierRequest;

/**
 * Class TourCarrierRepository.
 */
class TourCarrierController  extends Controller
{
    /**
     * @var tourCarrierRepository
     */
    protected $tourCarrierRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(TourCarrierRepository $tourCarrierRepository)
    {
        $this->tourCarrierRepository = $tourCarrierRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageTourCarrierRequest $request)
    {
        $tour_carrier = TourCarrier::orderBy('id','desc')->get();
        return view('backend.tour_carriers.index')
            ->withTourCarrier($this->tourCarrierRepository->getActivePaginated(2, 'id', 'asc'))->with('tour_carrier',$tour_carrier);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        return view('backend.tour_carriers.create');
    }

    /**
     * @param StoreUserRequest $request
     *
     * @throws \Throwable
     * @return mixed
     */
    public function store1(StoreTourCarrierRequest $request) 
    {

        if($request->graphic_type=='Icon'){
        $graphic_content = $request->content; 
      }

      if($request->graphic_type=='Image'){
        if ($request->hasFile('carrier_file_name'))
        {

            $image = $request->file('carrier_file_name'); //get the file
            $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
            $destinationPath = public_path('/img/backend/tour_carriers/image');//public path
            $image->move($destinationPath, $img_name);//mve to destination you mentioned
        }

         $graphic_content = isset($img_name)?$img_name:'';
       }
      // if ($request->hasFile('carrier_file_name'))
      //         {

      //             $imgName = time().'.'.request()->carrier_file_name->getClientOriginalExtension();
      //             request()->carrier_file_name->move(public_path('/img/backend/tour_carriers/image'), $imgName);

      //             $full_path = public_path('/img/backend/tour_carriers/image').$request->oldimage;
      //             if(File::exists($full_path))
      //             {
      //                File::delete($full_path);
      //             }
      //         }
      //         else
      //         {
      //             $imgName = $request->oldimage;
      //         }

        // dd($request->all());
        $this->tourCarrierRepository->create($request->only(
            'title',
            // 'last_name',
            'description',
            'graphic_type',
            'carrier_file_name',
            'status'
        ),$graphic_content);

        return redirect()->route('admin.tour_carriers')->withFlashSuccess(__('alerts.backend.tour_carrier.created'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @return mixed
     */
    public function show(ManageUserRequest $request, User $user)
    {
        return view('backend.auth.user.show')
            ->withUser($user);
    }

    /**
     * @param ManageUserRequest    $request
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param User                 $user
     *
     * @return mixed
     */
    public function edit($id)
    {
        $data= TourCarrier::where(['id'=> $id])->first();

       
       //dd($feature_arr);
        return view('backend.tour_carriers.edit', compact('data'));
           
    }

    /**
     * @param UpdateUserRequest $request
     * @param User              $user
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function update(Request $request, TourCarrier $tourcarrier, $id = null)
    { //$graphic_content='';
            if(ucfirst($request->graphic_type)=='Icon'){
                $graphic_content = $request->content; 
            }
    
            if(ucfirst($request->graphic_type)=='Image'){
                if ($request->hasFile('carrier_file_name'))
                {
        
                    $image = $request->file('carrier_file_name'); //get the file
                    $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
                    $destinationPath = public_path('/img/backend/tour_carriers/image');//public path
                    $image->move($destinationPath, $img_name);//mve to destination you mentioned
                }
    
                 $graphic_content = isset($img_name)?$img_name:'';
           }
        //    echo  $graphic_content ;
        $tourcarrier = TourCarrier::where(['id' => $id])->first();

        $this->tourCarrierRepository->update($tourcarrier, $request->only(
            'title',
            // 'last_name',
            'description',
            'graphic_type'
            // 'graphic_content'
        ),$graphic_content);

        return redirect()->route('admin.tour_carriers')->withFlashSuccess(__('alerts.backend.tour_carriers.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }
}
