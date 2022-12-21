<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Events\Backend\Auth\User\UserDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Http\Requests\Backend\Auth\User\StoreUserRequest;
use App\Http\Requests\Backend\Auth\User\UpdateUserRequest;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use App\Repositories\Backend\Auth\UserRepository;
use App\Models\UserDetails; 
use App\Models\Auth\Role;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request as HttpRequest;

class UserController extends Controller
{
    protected $userRepository;

   
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
   
    // public function index(HttpRequest $request)
    // {

    //     return view('backend.auth.user.index')->with('role_name')->withUsers($this->userRepository->orderBy('id','asc')->get());
    // }

    public function index(HttpRequest $request)
    {
        $users = User::orderBy('id','asc');
    
        if (!empty($request->invitation)) {
            if($request->invitation == 'notAccept') {
                $users = $users->whereNull('request_active_invitation')
                ->orWhere('request_active_invitation', 'notAccept');
            } else {
                $users = $users->where('request_active_invitation', $request->invitation);
            }
        }

        if(!empty($request->type)){
            $users = $users->where('role_type', $request->type);
        }

        $users = $users->get();
            
        return view('backend.auth.user.index')->with('role_name')->withUsers($users);
    }

    public function first(){
        //dd('sfd');
        return view('backend.auth.user.tabs.first_step');
    }
  

    public function create(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository)
        {

        $role = Role::select('id', 'name')->orderBy('id','asc')->pluck('name','name')->toArray();
        //dd($roleArr);
         
        return view('backend.auth.user.create', compact('role'))
            ->withRoles($roleRepository->with('permissions' )->get(['id', 'name']))
            ->withPermissions($permissionRepository->get(['id', 'name']));
    }

  
    public function store(StoreUserRequest $request, User $user)
    { 


        $this->userRepository->create($request->all( 
            'first_name',
            'last_name',
            'user_name',
            'email',
            'password',
            'travel_agency',
            'active',
            'confirmed',
            'confirmation_email',
            'roles',
            'permissions',
            'content'
        ));

     
        // dd($user);
        //   $add_userdata = new UserDetails;

        //     $add_userdata->user_id = $id;

        //     $add_userdata->save();
        
        return redirect()->route('admin.auth.user.index', compact('data', 'id', 'add_userdata' ))->withFlashSuccess(__('alerts.backend.users.created'));
    }

    
    public function show(ManageUserRequest $request, User $user)
    {
        $id = $user->id;
        //dd($role_data->role_type);
        $data = UserDetails::where('user_id', $id)->first();

        
        return view('backend.auth.user.show', compact('data'))->withUser($user);
    }

    public function showUserProfile($id)
    {
        $user = User::where('id', $id)->first();
        $first_name = $user->first_name;
        $last_name = $user->last_name;
        $role_type = $user->role_type;
        $link = 'profile/'. $role_type . '/' . strtolower($first_name.$last_name) . '/' . $id;
        return redirect()->to($link);
    }

    public function editUserProfile($id)
    {
        $user = User::where('id', $id)->first();
        Auth::user()->impersonate($user);
        return redirect()->route('frontend.user.account');
    }

   // public function show($id)
   //  {  
   //      $data = User::where('id', $id)->first();
   //      return view('backend.auth.user.show', compact($data));
   //  }

    
    public function edit(ManageUserRequest $request, RoleRepository $roleRepository, PermissionRepository $permissionRepository, User $user)
        {

        $role = Role::select('id', 'name')->orderBy('id','asc')->pluck('name','name')->toArray();
        
       // echo "<pre>"; print_r($role); exit;

        return view('backend.auth.user.edit', compact('role'))
            ->withUser($user)
            ->withRoles($roleRepository->get())
            ->withUserRoles($user->roles->pluck('name')->all())
            ->withPermissions($permissionRepository->get(['id', 'name']))
            ->withUserPermissions($user->permissions->pluck('name')->all());
    }

    public function update(UpdateUserRequest $request, User $user)
    {//dd($request->all());
        $this->userRepository->update($user, $request->all());

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.updated'));
    }

   
    public function destroy(ManageUserRequest $request, User $user)
    {
        $this->userRepository->deleteById($user->id);

        event(new UserDeleted($user));

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted'));
    }

    public function requestInvitation(HttpRequest $request, User $user)
    {
        try {
            $date = Carbon::now();
            $user->update([
                'request_active_invitation' => $request->invitation,
                'accept_invitation_date' => $request->invitation == 'accept' ? $date : null
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'failed',
            ], 500);
        }

    }

    public function invitationInterval(HttpRequest $request, User $user)
    {
        try {
            $user->update([
                'invitation_interval' => $request->dates,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'failed',
            ], 500);
        }
    }

    public function updateTrialDate(HttpRequest $request, User $user)
    {
        try {
            $date = Carbon::createFromFormat('d/m/Y', $request->date)->format('Y/m/d');
            $user->update([
                'trial_date' => $date,
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'failed',
            ], 500);
        }
    }

}
