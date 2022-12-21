<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\PlanPrivilege;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;




/**
 * Class TravelReportRepository.
 */
class PlanPrivilegeRepository extends BaseRepository 
{
    /**
     * TravelReportRepository constructor.
     *
     * @param  User  $model
     */
    public function __construct(PlanPrivilege $model) 
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getUnconfirmedCount() : int
    {
        return $this->model
            ->where('confirmed', false)
            ->count();
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return mixed
     */
    public function getActivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getInactivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
         

        return $this->model
            ->where('status', 0)
            ->orderBy($orderBy, $sort)
            ->paginate($paged);

            return $travel_report;
    }

    /**
     * @param int    $paged
     * @param string $orderBy
     * @param string $sort
     *
     * @return LengthAwarePaginator
     */
    public function getDeletedPaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->onlyTrashed()
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function create(array $data) : PlanPrivilege
    {

        return DB::transaction(function () use ($data) {  
                $data = $this->model::create([
                    'name' => $data['name'],
                    'controller' => $data['controller'],
                    'action' => $data['action'],
                    'status' => '1',
                ]);

            // See if adding any additional permissions
                //dd($travel_report);
            return $data;
            //throw new GeneralException(__('exceptions.backend.access.users.create_error'));
        });
    }

    /**
     * @param User  $user
     * @param array $data
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function update(PlanPrivilege $planprivilege, array $data) : PlanPrivilege
    {
        return DB::transaction(function () use ($planprivilege, $data) {
            if ($planprivilege->update([
                     'name' => $data['name'],
                    'controller' => $data['controller'],
                    'action' => $data['action'],
            ])) {
               
                // Add selected roles/permissions
                return $planprivilege;
            }
            
            //throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }



    /**
     * @param User $user
     * @param      $input
     *
     * @throws GeneralException
     * @return User
     */

    /**
     * @param User $user
     * @param      $status
     *
     * @throws GeneralException
     * @return User
     */
    public function mark(PlanPrivilege $planprivilege, $id=null) : PlanPrivilege
    {
     $thisuser=DB::table('plan_privileges')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>'0');
         DB::table('plan_privileges')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>'1');
         DB::table('plan_privileges')->where('id',$id)->update($dstatus);
        }
        
        return $planprivilege;

        //throw new GeneralException(__('exceptions.backend.access.travelreport.mark_error'));
    }
   
  
    public function forceDelete(PlanPrivilege $planprivilege) : PlanPrivilege
    {
        if ($planprivilege->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($planprivilege) {
            // Delete associated relationships
            $planprivilege->passwordHistories()->delete();
            $planprivilege->providers()->delete();

            if ($planprivilege->forceDelete()) {
                event(new UserPermanentlyDeleted($planprivilege));

                return $planprivilege;
            }

            //throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function restore(User $user) : User
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.cant_restore'));
        }

        if ($user->restore()) {
            event(new UserRestored($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.restore_error'));
    }

    /**
     * @param User $user
     * @param      $email
     *
     * @throws GeneralException
     */
    protected function checkUserByEmail(User $user, $email)
    {
        // Figure out if email is not the same and check to see if email exists
        if ($user->email !== $email && $this->model->where('email', '=', $email)->first()) {
            throw new GeneralException(trans('exceptions.backend.access.users.email_error'));
        }
    }
}
