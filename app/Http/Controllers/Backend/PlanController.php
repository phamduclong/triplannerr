<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Tour\StoreTourRequest;
use App\Models\TravelReport;
use App\Models\Plan;
use App\Models\PlanFeature;
use App\Models\PlanFeatureId;
use App\Models\PlanPrivilege;
use App\Models\PlanFeatureDetail;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use File;
use Auth;
use App\Models\Subscription;
use App\Repositories\Backend\PlanRepository;

  
class PlanController extends Controller
{
   /**
     * @var tourCarrierRepository
     */
    protected $planRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
    public function index()
    { 
        $plan_featuresArr = $this->getplanfeature();

        $plan_privilege = PlanPrivilege::orderBy('id','asc')->where('status', '1')->pluck('name', 'id')->toArray();

        $plan = Plan::with('PrivilegeName')->orderBy('id','desc')->paginate(10);
        return view('backend.plan.index', compact('plan'));
            
    }
     
    public function create()
    {
        $plan_featuresArr = $this->getplanfeature();
        
        $plan_privilege = PlanPrivilege::orderBy('id','asc')->where('status', '1')->pluck('name', 'id')->toArray();

        return view('backend.plan.create', compact('plan_features','plan_privilege','plan_featuresArr'));
    }

   public function store(Request $request)
    { 
         $form_data = $request->all();
       //dd($request->all()); 
        $data = new Plan;
        $data->name = $request->name;
        $data->description = $request->description;
        $data->plan_type = $request->plan_type;
        $data->privilege_ids = $request->privilege_ids;
        $data->feature_ids = !empty($form_data['feature_ids']) ? implode(',', $form_data['feature_ids']) : '';
        $data->amount = $request->amount;
        $data->status = '1';
        $data->save();

        $this->plan_feature_detail_save($request->plan_feature, $data->id);

        // $plan_features = $request['plan_feature'];
        //   if(isset($plan_features) && count($plan_features)>0) {

        //       foreach ($plan_features as $plan_features_id) 
        //       {
        //           $PlanArr   = array(
        //           'plan_id' => $data->id,
        //           'plan_feature_id' => $plan_features_id,
        //           );

        //           DB::table('plan_feature_detail')->insert($PlanArr);
        //       }

        //     }
           //dd($plan_features);
        return redirect()->route('admin.plan')->withFlashSuccess(__('alerts.backend.plan.created'));
    }

    public function getplanfeature()
    {
        $plan_featuresArr[] = 'Select Plan Feature';
        $plan_features= PlanFeature::where(['status'=>'1'])->orderby('feature_name','asc')->pluck('feature_name', 'id')->toArray();
        return ($plan_features)?$plan_features:"";
    }


 public function plan_feature_detail_save($feature_name, $lastinsertId){
        if($feature_name)
        {
            foreach($feature_name as $feature_name_value)
            {
                $mulltipleArr = array(
                   'plan_id' => $lastinsertId,
                   'plan_feature_id' => $feature_name_value,
                   
                );
                PlanFeatureDetail::insert($mulltipleArr);
            }
         }
    }
    public function edit($id)
    {
        $plan_featuresArr = $this->getplanfeature();
        //dd($planfeature_arr);
        $data= Plan::where(['id'=> $id])->first();

        $plan_features = PlanFeature::orderBy('id','asc')->where('status', '1')->get();

        $plan_privilege = PlanPrivilege::orderBy('id','asc')->where('status', '1')->pluck('name', 'id')->toArray();

        // $plan_features_id = PlanFeatureDetail::orderBy('id','asc')->where('plan_id',$id)->get();

        //   dd($plan_features_id);
       //   foreach($plan_features as $value){
       //   $plan_arr[] = $value->feature_name;
       // }

        $plan_features_detail = PlanFeatureDetail::orderBy('id','asc')->where('plan_id',$id)->get();

         foreach($plan_features_detail as $plan){
         $plan_arr[] = $plan->plan_feature_id;
       }
       //dd($plan_arr);
      
      
        return view('backend.plan.edit', compact('data', 'plan_features','plan_privilege','plan_arr', 'plan_featuresArr'));
    }

     public function update(Request $request, Plan $plan, $id = null)
    { //dd($request->all());
        $form_data = $request->all();

        $data = Plan::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->plan_type = $request->plan_type;
        $data->privilege_ids = $request->privilege_ids;
        $data->feature_ids = !empty($form_data['feature_ids']) ? implode(',', $form_data['feature_ids']) : '';
        $data->amount = $request->amount;
        
        $data->save();

         $plan_features = $request['plan_feature'];

          PlanFeatureDetail::where(['plan_id'=> $data->id])->delete();
          if(isset($plan_features) && count($plan_features)>0) {

              foreach ($plan_features as $plan_features_id) 
              {
                  $PlanArr   = array(
                  'plan_id' => $data->id,
                  'plan_feature_id' => $plan_features_id,
                  );
                
                  DB::table('plan_feature_detail')->insert($PlanArr);
              }

            }
            //dd($PlanArr);

        return redirect()->route('admin.plan')->withFlashSuccess(__('alerts.backend.plan.updated'));
      }

        public function destroy(Request $request, Plan $plan, $id)
    {
        Plan::where('id', $id)->delete();
        $this->planRepository->forceDelete($plan);

        return redirect()->route('admin.plan.deleted')->withFlashSuccess(__('alerts.backend.plan.deleted'));
    }

    public function status(Request $request, Plan $plan, $status)
    {
        $this->planRepository->mark($plan, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'admin.plan' :
            'admin.plan'
        )->withFlashSuccess(__('alerts.backend.plan.updated'));
    }

    public function getDeactivated()
    {

        $plan = Plan::where('status',0)->orderBy('status','DESC')->paginate(10); 
        return view('backend.plan.deactivated', compact('plan'));
        
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted()
    {

        $plan = Plan::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.plan.deleted', compact('plan'));
    }

    public function restore($id){   
      
        $plan= DB::table('plans')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/plan/deleted');
      }

    public function subscription() {  
  
        $travelPros = User::where('role_type', 'travel_agency')->get();
        $subscription_data=Subscription::orderby('id','asc')->with('getuser')->get(); 
        
         return view('backend.subscription.index', compact('subscription_data', 'travelPros'));
    }

    public function listSubscription(Request $request)
    {
        try {
            $subscription_data=Subscription::orderby('id','asc')->with('getuser');

            if(!empty($request->travel_pro)){
                $subscription_data = $subscription_data
                ->where('user_id', $request->travel_pro);
            }
 
            $subscription_data = $subscription_data->get();

            $html = view('includes.not-found')->render();

            if(count($subscription_data)){
                $html = view('backend.subscription.includes.fetch-table', ['subscription_data' => $subscription_data])->render();
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
            ], 500);
        }
    }

    public function show($id)
    {  

       $user =  Subscription::where('id', $id)->first();

        return view('backend.subscription.show', compact('user'));
    }

}
