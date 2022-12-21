<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PlanFeature;
use App\Models\PlanPrivilege;
use App\Models\Plan;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\PlanFeatureRepository; 

class PlanFeatureController extends Controller 
{
    /**
     * @var tourCarrierRepository
     */
    protected $planFeatureRepository;

    /**
     * planPrivilegeRepository constructor.
     *
     * @param planPrivilegeRepository $planPrivilegeRepository
     */
    public function __construct(PlanFeatureRepository $planFeatureRepository)
    {
        $this->planFeatureRepository = $planFeatureRepository;
    }

    public function index()
    { 
        $plan_feature = PlanFeature::orderBy('id','desc')->paginate(10);
          return view('backend.plan_feature.index')
            ->withPlanFeature($this->planFeatureRepository->getActivePaginated(10, 'id', 'asc'))->with('plan_feature',$plan_feature);
    }

    
    public function create()
    {
 
        $plan_privilege = PlanPrivilege::orderBy('id','asc')->where('status', '1')->pluck('name', 'id')->toArray();
       
        //dd($value1);
        return view('backend.plan_feature.create', compact('plan_privilege'));
    }

    public function store(Request $request)
    { 
       
       $this->planFeatureRepository->create($request->only(
            'feature_name',
            'plan_privilege_id',
            'occurence',
            'status'
        ));
         // dd($escort);
        return redirect()->route('admin.plan_feature')->withFlashSuccess(__('alerts.backend.plan_feature.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
    {
        $plan_privilege = PlanPrivilege::orderBy('id','asc')->where('status', '1')->pluck('name', 'id')->toArray();

        $data = PlanFeature::where('id', $id)->first();
        return view('backend.plan_feature.edit', compact('data', 'plan_privilege'));
    }

    public function update(request $request, PlanFeature $planfeature, $id = null)
    { //dd($request->all());

       $planfeature = PlanFeature::where(['id' => $id])->first();

       $this->planFeatureRepository->update($planfeature, $request->only(
            'feature_name',
            'plan_privilege_id',
            'occurence',
            'status'
        ));
      

        return redirect()->route('admin.plan_feature')->withFlashSuccess(__('alerts.backend.plan_feature.updated'));
      }

    public function destroy(Request $request, PlanFeature $planfeature, $id)
    {
        PlanFeature::where('id', $id)->delete();
        $this->planFeatureRepository->forceDelete($planfeature);

        return redirect()->route('admin.plan_feature.deleted')->withFlashSuccess(__('alerts.backend.plan_feature.deleted'));
    }

    public function status(Request $request, PlanFeature $planfeature, $status)
    {
        $this->planFeatureRepository->mark($planfeature, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'admin.plan_feature' :
            'admin.plan_feature'
        )->withFlashSuccess(__('alerts.backend.plan_feature.updated'));
    }

    public function getDeactivated()
    {

        $plan_feature = PlanFeature::where('status','0')->orderBy('status','DESC')->get(); 
        return view('backend.plan_feature.deactivated', compact('plan_feature'));
        
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted()
    {

        $plan_feature = PlanFeature::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('backend.plan_feature.deleted', compact('plan_feature'));
    }

     public function restore($id)
      {      
      
        $plan_feature= DB::table('plan_features')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
     
         return redirect()->to('admin/plan-feature/deleted');
      
      }
}
