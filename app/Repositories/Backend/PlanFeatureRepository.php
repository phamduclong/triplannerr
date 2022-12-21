<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\PlanFeature;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;





/**
 * Class TravelReportRepository.
 */
class PlanFeatureRepository extends BaseRepository 
{
    /**
     * TravelReportRepository constructor.
     *
     * @param  User  $model
     */
    public function __construct(PlanFeature $model) 
    {
        $this->model = $model;
    }

 
    public function getActivePaginated($paged = 10, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model            
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }

  
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
    public function create(array $data) : PlanFeature
    {

        return DB::transaction(function () use ($data) {  
            
                $plan_feature = $this->model::create([
                    'feature_name' => $data['feature_name'],
                    'plan_privilege_id' => $data['plan_privilege_id'],
                    'occurence' => $data['occurence'],
                    'status' => '1',
                ]);

            return $plan_feature;
        });

    }

   
    public function update(PlanFeature $planfeature, array $data) : PlanFeature
    {
        return DB::transaction(function () use ($planfeature, $data) {
            
            if ($planfeature->update([
                'feature_name' => $data['feature_name'],
                'plan_privilege_id' => $data['plan_privilege_id'],
                'occurence' => $data['occurence'],
            ]))

             {
              
                return $planfeature;
            } 
 
        });
    }

    
     public function mark(PlanFeature $planfeature, $id=null) : PlanFeature
    {
      $thisuser=DB::table('plan_features')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>'0');
         DB::table('plan_features')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>'1');
         DB::table('plan_features')->where('id',$id)->update($dstatus);
        }
        
        return $planfeature;
    }
   
    public function forceDelete(planfeature $planfeature) : User
    {
        if ($planfeature->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.plan_feature.delete_first'));
        }

        return DB::transaction(function () use ($planfeature) {
            // Delete associated relationships
            $planfeature->passwordHistories()->delete();
            $planfeature->providers()->delete();

            if ($planfeature->forceDelete()) {
                event(new UserPermanentlyDeleted($planfeature));

                return $planfeature;
            }

            throw new GeneralException(__('exceptions.backend.access.plan_feature.delete_error'));
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
