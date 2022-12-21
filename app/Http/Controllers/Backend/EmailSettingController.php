<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\EmailDetails;
use App\Models\Auth\User;
use File;
use Auth;
use App\Repositories\Backend\EmailSettingRepository;


 
class EmailSettingController extends Controller
{
   /**
     * @var tourCarrierRepository
     */
    protected $emailsettingRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(EmailSettingRepository $emailsettingRepository)
    {
        $this->emailsettingRepository = $emailsettingRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
    public function index()
    {
           $emaildetail = EmailDetails::orderBy('id','desc')->paginate(10);
        return view('backend.emailsettings.index',compact('emaildetail'));
       
      
    }

    public function edit($id)
    {
        $data = EmailDetails::where('id', $id)->first();
        return view('backend.emailsettings.edit', compact('data'));
    }

    public function create()
    {  
        $emailsetting = EmailDetails::get();
        
        //dd($value1);
        return view('backend.emailsettings.create', compact('emailsetting'));
    }

    public function store(Request $request)
    { 
     
       $this->emailsettingRepository->create($request->only(
            'type',
            'subject',
            'content'
        ));
        
        return redirect()->route('admin.emailsettings')->withFlashSuccess(__('alerts.backend.emailsettings.created'));
    }

    public function update(request $request, EmailDetails $emaildetails, $id = null)
    { //dd($request->all());

       $emaildetails = EmailDetails::where(['id' => $id])->first();

       $this->emailsettingRepository->update($emaildetails, $request->only(
            'type',
            'subject',
            'content'
        ));
      

        return redirect()->route('admin.emailsettings')->withFlashSuccess(__('alerts.backend.emailsettings.updated'));
      }

 
    public function destroy(Request $request, EmailDetails $emaildetails, $id)
    {
        EmailDetails::where('id', $id)->delete();
        $this->emailsettingRepository->forceDelete($emaildetails);

        return redirect()->route('admin.emailsettings.deleted')->withFlashSuccess(__('alerts.backend.emailsettings.deleted'));
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted()
    {
        $emailsettings = EmailDetails::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.emailsettings.deleted', compact('emailsettings'));
    }

     public function restore($id)
      {  
      
        $emailsettings= DB::table('emaildetails')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/emailsettings/deleted');
      }

      public function ads_details()
      {   

         // $ad_data = AdsData::orderBy('deleted_at','DESC')->with('ads')->get();


          return view('backend.advertisements.ad_data', compact('ad_data'));
      }
}
