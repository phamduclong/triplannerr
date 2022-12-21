<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\PlanMonth;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use File;
use Auth;
use App\Repositories\Backend\PlanMonthRepository;

class PlanMonthController extends Controller
{
     /**
     * @var tourCarrierRepository
     */
    protected $planMonthRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(PlanMonthRepository $planMonthRepository)
    {
        $this->planMonthRepository = $planMonthRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
   
    public function index()
    { 

        $plan_month = PlanMonth::orderBy('id','desc')->paginate(10);
        return view('backend.plan_month.index', compact('plan_month'));
            
    }

    public function create()
    {
        
        $plan_month = PlanMonth::where('status', '1')->get();

        return view('backend.plan_month.create', compact('plan_month'));
    }

    public function store(Request $request)
    { 
        
        $data = new PlanMonth;
        //dd($data);
        $data->name = $request->name;
        $data->no_of_month  = $request->no_of_month;
        $data->discount = $request->discount;
        $data->status = '1';
        $data->save();

        return redirect()->route('admin.plan_month')->withFlashSuccess(__('alerts.backend.plan_month.created'));
    }

    public function edit($id)
    {
      
        $data= PlanMonth::where(['id'=> $id])->first();

        return view('backend.plan_month.edit', compact('data'));
    }

    public function update(Request $request, $id = null)
    { 
        $data = PlanMonth::find($id);
        //dd($data);

        $data->name = $request->name;
        $data->no_of_month  = $request->no_of_month;
        $data->discount = $request->discount;
        $data->status = '1';
        $data->save();

        return redirect()->route('admin.plan_month')->withFlashSuccess(__('alerts.backend.plan_month.updated'));
      }

       public function getDeactivated()
      {

        $plan_month = PlanMonth::where('status',0)->orderBy('status','DESC')->paginate(10); 
        return view('backend.plan_month.deactivated', compact('plan_month'));
        
     }

     public function destroy(Request $request, PlanMonth $plan_month, $id)
    {
        PlanMonth::where('id', $id)->delete();
        $this->planMonthRepository->forceDelete($plan_month);

        return redirect()->route('admin.plan_month.deleted')->withFlashSuccess(__('alerts.backend.plan_month.deleted'));
    }

  
    public function getDeleted()
    {

        $plan_month = PlanMonth::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.plan_month.deleted', compact('plan_month'));
    }
    
    public function status(Request $request, PlanMonth $plan_month, $status, $id=null)
    { 
        
        $this->planMonthRepository->mark($plan_month, (int) $status);

        return redirect()->route(
            (int) $status === '1' ?
            'admin.plan_month' :
            'admin.plan_month'
        )->withFlashSuccess(__('alerts.backend.plan_month.status_update'));

     return redirect()->back()->withFlashSuccess(__('alerts.backend.plan_month.status_update'));
    }

    public function restore($id)
      {   
      
        $plan_month= DB::table('plan_months')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/plan-month/deleted');
      }


}
