<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PlanPrivilege;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\PlanPrivilegeRepository; 

class PlanPrivilegeController extends Controller
{ /**
     * @var tourCarrierRepository
     */
    protected $planPrivilegeRepository;

    /**
     * planPrivilegeRepository constructor.
     *
     * @param planPrivilegeRepository $planPrivilegeRepository
     */
    public function __construct(PlanPrivilegeRepository $planPrivilegeRepository)
    {
        $this->planPrivilegeRepository = $planPrivilegeRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $plan_privilege = PlanPrivilege::orderBy('id','desc')->paginate(10);
        return view('backend.plan_privilege.index', compact('plan_privilege'));
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		 return view('backend.plan_privilege.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //dd($request->all());
        $this->planPrivilegeRepository->create($request->only(
            'name',
            'controller',
            'action',
            'status'
        ));

        return redirect()->route('admin.plan_privilege')->withFlashSuccess(__('alerts.backend.plan_privilege.created'));
    }

    
    public function edit($id)
    {
        $data = PlanPrivilege::where('id', $id)->first();
        return view('backend.plan_privilege.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(request $request, PlanPrivilege $planprivilege, $id = null)
    {
        $planprivilege = PlanPrivilege::where(['id' => $id])->first();
      
         $this->planPrivilegeRepository->update($planprivilege, $request->only(
            'name',
            'controller',
            'action',
            'status'
        ));

        return redirect()->route('admin.plan_privilege')->withFlashSuccess(__('alerts.backend.plan_privilege.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
 
    public function destroy(Request $request, PlanPrivilege $planprivilege, $id)
    {
        PlanPrivilege::where('id', $id)->delete();
        $this->planPrivilegeRepository->forceDelete($planprivilege);

        return redirect()->route('admin.plan_privilege.deleted')->withFlashSuccess(__('alerts.backend.plan_privilege.deleted'));
    }

    public function status_plan_privilege(Request $request, PlanPrivilege $planprivilege, $status, $id=null)
    { 

     $this->planPrivilegeRepository->mark($planprivilege, (int) $status);

    return redirect()->route(
        (int) $status === 1 ?
        'admin.plan_privilege' :
        'admin.plan_privilege'
    )->withFlashSuccess(__('alerts.backend.plan_privilege.status_update'));

    }

    public function getDeactivated()
    {

        $plan_privilege = PlanPrivilege::where('status',0)->orderBy('status','DESC')->get(); 
        return view('backend.plan_privilege.deactivated', compact('plan_privilege'));
        
    } 

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted() 
    { 

        $plan_privilege = PlanPrivilege::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('backend.plan_privilege.deleted', compact('plan_privilege'));
    }

     public function restore($id)
      {      
      
        $plan_privilege= DB::table('plan_privileges')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
     
         return redirect()->to('admin/plan-privilege/deleted');
      
      }
   
}
