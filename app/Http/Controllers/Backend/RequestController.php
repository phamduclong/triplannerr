<?php

namespace App\Http\Controllers\Backend;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserLevelRequest;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Auth\Role;
use File;
use Auth;
use App\Repositories\Backend\RequestRepository;

class RequestController extends Controller
{
   /**
     * @var tourCarrierRepository
     */
    protected $requestRepository;

    /**
     * TourCarrierRepository constructor.
     *
     * @param tourCarrierRepository $tourCarrierRepository
     */
    public function __construct(RequestRepository $requestRepository)
    {
        $this->requestRepository = $requestRepository;
    }  

    /**
     * @param ManageUserRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
    public function index() 
    {
        $user_level_request = UserLevelRequest::with('RoleName')->with('RoleNewName')->orderBy('id','desc')->paginate(10);
        return view('backend.user_level_request.index')
            ->withUserLevelRequest($this->requestRepository->getActivePaginated(2, 'id', 'asc'))->with('user_level_request',$user_level_request);
    }

    public function edit($id)
       {
        $data = UserLevelRequest::with('RoleName')->with('RoleNewName')->where('id', $id)->first();
      
        $role = Role::get();
        foreach($role as $role_name){
         $role_arr[] = $role_name->name;
         //dd($role_arr);
       }
       
        return view('backend.user_level_request.edit', compact('data', 'role', 'role_arr'));
    }   

    public function create()
    {  
        $user_level_request = UserLevelRequest::get();
        
        //dd($value1);
        return view('backend.user_level_request.create', compact('user_level_request'));
    }

    public function store(Request $request)
    { 
      
       $this->requestRepository->create($request->only(
            'current_role_id',
            'new_role_id',
            'status'
        ));
         // dd($escort);
        return redirect()->route('admin.user_level_request')->withFlashSuccess(__('alerts.backend.user_level_request.created'));
    }

    public function update(request $request, UserLevelRequest $user_level_request, $id = null)
    { //dd($request->all());

       $user_level_request = UserLevelRequest::where(['id' => $id])->first();

       $this->requestRepository->update($user_level_request, $request->only(
            'current_role_id',
            'new_role_id',
            'status'
        ));
      

        return redirect()->route('admin.user_level_request')->withFlashSuccess(__('alerts.backend.user_level_request.updated'));
      }

   
   public function destroy(Request $request, UserLevelRequest $user_level_request, $id)
    {
        UserLevelRequest::where('id', $id)->delete();
        $this->requestRepository->forceDelete($user_level_request);

        return redirect()->route('admin.user_level_request.deleted')->withFlashSuccess(__('alerts.backend.user_level_request.deleted'));
    }

   public function getPending()
    {

        $user_level_request = UserLevelRequest::where('status','pending')->orderBy('status','DESC')->paginate(10); 
        return view('backend.user_level_request.pending', compact('user_level_request'));
        
    }

    public function getApproved()
    {

        $user_level_request = UserLevelRequest::where('status','approved')->orderBy('status','DESC')->paginate(10); 
        return view('backend.user_level_request.approved', compact('user_level_request'));
        
    }

    public function getNotApproved()
    {

        $user_level_request = UserLevelRequest::where('status','not_approved')->orderBy('status','DESC')->paginate(10); 
        return view('backend.user_level_request.not_approved', compact('user_level_request'));
        
    }

    public function getCancelled()
    {

        $user_level_request = UserLevelRequest::where('status','cancelled')->orderBy('status','DESC')->paginate(10); 
        return view('backend.user_level_request.cancelled', compact('user_level_request'));
        
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted()
    {

        $user_level_request = UserLevelRequest::onlyTrashed()->orderBy('deleted_at','DESC')->paginate(10);
        return view('backend.user_level_request.deleted', compact('user_level_request'));
    }

     public function restore($id)
      {   
      
        $user_level_request= DB::table('user_level_requests')->where('id',$id)->whereNotNull('deleted_at')->update(['deleted_at'=>NULL]);
         return redirect()->to('admin/user-level-request/deleted');
      }
}
