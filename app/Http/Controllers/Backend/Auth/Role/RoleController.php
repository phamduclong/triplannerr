<?php

namespace App\Http\Controllers\Backend\Auth\Role;

use App\Events\Backend\Auth\Role\RoleDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Auth\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Auth\Role\UpdateRoleRequest;
use App\Models\Auth\Role;
use App\Repositories\Backend\Auth\PermissionRepository;
use App\Repositories\Backend\Auth\RoleRepository;
use File;
use Illuminate\Http\Request;
/**
 * Class RoleController.
 */
class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @param RoleRepository       $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function index(ManageRoleRequest $request)
    {
        return view('backend.auth.role.index')
            ->withRoles($this->roleRepository
            ->with('users', 'permissions')
            ->orderBy('id')
            ->paginate(10));
    }

    /**
     * @param ManageRoleRequest $request
     *
     * @return mixed
     */
    public function create(ManageRoleRequest $request)
    {
        return view('backend.auth.role.create')
            ->withPermissions($this->permissionRepository->get());
    }

    /**
     * @param  StoreRoleRequest  $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function store(StoreRoleRequest $request)
    {

        if ($request->hasFile('image'))
              {

                  $imgName = time().'.'.request()->image->getClientOriginalExtension();
                  request()->image->move(public_path('img/backend/traveler_image'), $imgName);

                  $full_path = public_path('/img/backend/traveler_image').$request->oldimage;
                  if(File::exists($full_path))
                  {
                     File::delete($full_path);
                  }
              }
        
            $data = new Role;
            $data->name = $request->name;
            $data->image = $imgName;
            $data->save();
        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.roles.created'));
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @return mixed
     */
    public function edit(ManageRoleRequest $request, Role $role)
    {
        if ($role->isAdmin()) {
            return redirect()->route('admin.auth.role.index')->withFlashDanger('You can not edit the administrator role.');
        }

        return view('backend.auth.role.edit')
            ->withRole($role)
            ->withRolePermissions($role->permissions->pluck('name')->all())
            ->withPermissions($this->permissionRepository->get());
    }

    /**
     * @param  UpdateRoleRequest  $request
     * @param  Role  $role
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
       // dd($request->all());
        if ($request->hasFile('image'))
              {

                  $imgName = time().'.'.request()->image->getClientOriginalExtension();
                  request()->image->move(public_path('img/backend/traveler_image'), $imgName);

                  $full_path = public_path('/img/backend/traveler_image').$request->oldimage;
                  if(File::exists($full_path))
                  {
                     File::delete($full_path);
                  }
              }
        $role = Role::find($id);
        $role->name = $request->name;
        $role->image = $imgName;
        //for banner image insert
        $role->save();

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.roles.updated'));
    }

    /**
     * @param ManageRoleRequest $request
     * @param Role              $role
     *
     * @throws \Exception
     * @return mixed
     */
    public function destroy(ManageRoleRequest $request, Role $role)
    {
        if ($role->isAdmin()) {
            return redirect()->route('admin.auth.role.index')->withFlashDanger(__('exceptions.backend.access.roles.cant_delete_admin'));
        }

        $this->roleRepository->deleteById($role->id);

        event(new RoleDeleted($role));

        return redirect()->route('admin.auth.role.index')->withFlashSuccess(__('alerts.backend.roles.deleted'));
    }

     public function travel_image_index(ManageRoleRequest $request)
    {
        $travel_image = Role::orderBy('id','desc')->get();
        return view('backend.traveler_image.index')
            ->withRoles($this->roleRepository
            ->with('users', 'permissions')
            ->orderBy('id')
            ->paginate()); 
    }

     public function travel_image_create()
    {
       
        return view('backend.traveler_image.create');
    }

   
}
