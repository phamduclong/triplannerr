<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
// use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use App\Models\PlanMonth;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Events\Frontend\Auth\UserRegistered;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Models\PlanFeature;
//use App\Repositories\Backend\SubscriptionRepository;


/**
 * Class SubscriptionController.
 */
class SubscriptionController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */

    /**
     * @var SubscriptionRepository
     */
    //protected $SubscriptionRepository;

    /**
     * SubscriptionRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    // public function __construct(SubscriptionRepository $subscriptionRepository)
    // {
    //     $this->SubscriptionRepository = $subscriptionRepository;
    // }

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function redirectPath()
    {
        return route(home_route());
    }


    public function index($ids = null)
    {
        $plan_features = PlanFeature::where('status','1')->get();
        // $plandata = Plan::where('status','1')->get();
        $plandata = DB::table('plans')->where('status','1')->get();
        $plan_months = PlanMonth::where('status', '1')->get();
        //dd($plan_months);
        $subscriptions_plans = Subscription::where('status', '1')->get();
       
        return view('frontend.subscription.view',compact('plandata','ids','plan_months','subscriptions_plans', 'plan_features'));
    } 

    public function index1($ids = null)
    {
        return view('frontend.subscription.view-one');
    }


    public function purchasePlan($id = null, $slug = null, $userid=null)
    { 
    	$id = encrypt_decrypt('decrypt', $id); 
    	$plan = Plan::where('id', $id)->first();
        $plan_months = PlanMonth::where('id', $id)->first();
        //dd($plan_months);
       
    	$data['items'] = [
            [
                'name' => $plan->name.' : Travel maker',
                'price' => $plan->amount,
                'desc'  => $plan->desc,
                'qty' => 1
            ]
        ];

        $data['user_id'] = $userid;
        $data['invoice_id'] = time();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/plan/success/'.$id.'/'.$data['invoice_id']);
        $data['cancel_url'] = url('/plan/cancel');
        $data['total'] = $plan->amount;
        $data['plan_id'] = $plan->id;
       // $data['plan_month_id'] = $plan_months->id;
        
        $subdata = new Subscription;
        $subdata->user_id = $data['user_id'];
        $subdata->plan_id = $plan->id;
        $subdata->plan_month_id = !empty($plan_months->id)?$plan_months->id : 0;
        $subdata->plan_name = $plan->name;
        $subdata->plan_amount = $data['total'];
        $subdata->quantity = '1';
        $subdata->invoice_id = $data['invoice_id'];
        $subdata->invoice_description = $data['invoice_description'];
        $subdata->payment_status = 'pending';
        $subdata->status = '0';
        $subdata->save();
        
        // die('stop2');
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);
        return redirect($response['paypal_link']);
    }

    public function payment()
    {

        $data = [];
        $data['items'] = [
            [
                'name' => 'Basic plan : Travel maker',
                'price' => 100,
                'desc'  => 'Description for ItSolutionStuff.com',
                'qty' => 1
            ]
        ];
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 100;
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);
        return redirect($response['paypal_link']);

    }

    public function cancel()
    {
        dd('Your payment is canceled. You can create cancel page here.');
	}

    public function success(Request $request, $id = null, $invoice_id= null)
    {
       
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);
        $plan = Plan::where('id', $id)->first();
    	$data['items'] = [
            [
                'name' => $plan->name.' : Travel maker',
                'price' => $plan->amount,
                'desc'  => $plan->desc,
                'qty' => 1
            ]
        ];
        $data['invoice_id'] = time();
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = url('/purchase-plan/success/'.$id);
        $data['cancel_url'] = url('/purchase-plan/cancel');
        $data['total'] = $plan->amount;
        $response1 =$provider->DoExpressCheckoutPayment($data, $response['TOKEN'], $response['PAYERID']);
        if (in_array(strtoupper($response1['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) 
        {
            // dd('Your payment was successfully. You can create success page here.');
            if (config('access.users.confirm_email') || config('access.users.requires_approval')) {
                $updatesubdata=Subscription::where('invoice_id',$invoice_id)->first();
                if(!empty($updatesubdata)){
                    $updatesubdata->payment_status = 'success';
                    $updatesubdata->status = '1';
                    $updatesubdata->save();
                }
               
                $user=User::where('id',$updatesubdata->user_id)->first();
                   $user->notify(new UserNeedsConfirmation($user->confirmation_code));
        
                   return redirect($this->redirectPath())->withFlashSuccess(
                    config('access.users.requires_approval') ?
                        __('exceptions.frontend.auth.confirmation.created_pending') :
                        __('exceptions.frontend.auth.confirmation.created_confirm')
                );
            }
            else{
                return redirect()->route($this->redirectPath())->with('error', 'Your payment was failed!');
            }
        }
        dd('Something is wrong.');
    }

} 
