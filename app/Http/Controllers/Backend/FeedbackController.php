<?php
 
namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Tour\StoreTourRequest;
use App\Models\TravelReport;
use App\Models\Feedback;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use File;
use Auth;
use App\Repositories\Backend\FeedbackRepository;

class FeedbackController extends Controller
{
   /**
     * @var tourCarrierRepository
     */
    protected $feedbackRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(FeedbackRepository $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
    public function index()
    {
        $feedback = Feedback::orderBy('id','desc')->paginate(10);
        return view('backend.feedback.index')
            ->withFeedback($this->feedbackRepository->getActivePaginated(1, 'id', 'asc'))->with('feedback',$feedback);
    }

    public function edit($id)
    {
        $data = Feedback::where('id', $id)->first();
        return view('backend.feedback.edit', compact('data', 'feedback'));
    }

    public function create()
    {  
        $feedback = Feedback::get();
        
        //dd($value1);
        return view('backend.feedback.create', compact('feedback'));
    }

    public function store(Request $request)
    { 
      
       $this->feedbackRepository->create($request->only(
            'feedback_type',
            'feedback_id',
            'content',
            'rating_type1',
            'rating_type2',
            'rating_type3',
            'rating_type4',
            'rating_type5',
            'rating_type6',
            'rating_type7',
            'status'
        ));
         // dd($escort);
        return redirect()->route('admin.feedback')->withFlashSuccess(__('alerts.backend.feedback.created'));
    }

    public function update(request $request, Feedback $feedback, $id = null)
    { //dd($request->all());

       $feedback = Feedback::where(['id' => $id])->first();

       $this->feedbackRepository->update($feedback, $request->only(
            'feedback_type',
            'content',
            'rating_type1',
            'rating_type2',
            'rating_type3',
            'rating_type4',
            'rating_type5',
            'rating_type6',
            'rating_type7',
            'status'
        ));
      

        return redirect()->route('admin.feedback')->withFlashSuccess(__('alerts.backend.feedback.updated'));
      }

    public function status(Request $request, Feedback $feedback, $status, $id=null)
    { 

        $this->feedbackRepository->mark($feedback, (int) $status);

        return redirect()->route(
            (int) $status === 1 ?
            'admin.feedback' :
            'admin.feedback'
        )->withFlashSuccess(__('alerts.backend.feedback.status_update'));

     return redirect()->back()->withFlashSuccess(__('alerts.backend.feedback.status_update'));
    }

    public function destroy(Request $request, Feedback $feedback, $id)
    {
        Feedback::where('id', $id)->delete();
        $this->feedbackRepository->forceDelete($feedback);

        return redirect()->route('admin.feedback.deleted')->withFlashSuccess(__('alerts.backend.feedback.deleted'));
    }

   public function getDeactivated()
    {

        $feedback = Feedback::where('status',0)->orderBy('status','DESC')->get(); 
        return view('backend.feedback.deactivated', compact('feedback'));
        
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted()
    {

        $feedback = Feedback::onlyTrashed()->orderBy('deleted_at','DESC')->get();
        return view('backend.feedback.deleted', compact('feedback'));
    }

     public function restore($id)
      {   
      
        $feedback= DB::table('feedbacks')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/feedback/deleted');
      }

  
}
