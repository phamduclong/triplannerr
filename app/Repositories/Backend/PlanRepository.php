<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Plan;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;





/**
 * Class TravelReportRepository.
 */
class PlanRepository extends BaseRepository 
{
    /**
     * PlanRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(Plan $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
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
    public function create(array $data) : Plan
    {

        return DB::transaction(function () use ($data) {  
           //dd($data);
                $plan = $this->model::create([
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'plan_type' => $data['plan_type'],
                    'amount' => $data['amount']?$data['amount']:'NULL',
                    'privilege_ids' => $data['privilege_ids'],
                    'status' => '1',
                ]);

            if(isset($plan_features) && count($plan_features)>0) {

              foreach ($plan_features as $plan_features_id) 
              {
                  $PlanArr   = array(
                  'plan_id' => $data->id,
                  'feature_id' => $plan_features_id,
                  );
                  DB::table('plan_feature_id')->insert($PlanArr);
              }

            }
           
                
            return $plan;
        });

    }

    public function update(Plan $plan, array $data) : Plan
    {
        return DB::transaction(function () use ($plan, $data) {
            
            if ($plan->update([
                'name' => $data['name'],
                'description' => $data['description'],
                'plan_type' => $data['plan_type'],
                'amount' => $data['amount'],
                'privilege_ids' => $data['privilege_ids'],
            ]))


             {
              
                return $plan;
            } 
 
        });
    }


    public function mark(Plan $plan, $id=null) : Plan
    {
      $thisuser=DB::table('plans')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>0);
         DB::table('plans')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>1);
         DB::table('plans')->where('id',$id)->update($dstatus);
        }
        
        return $plan;
    }
   
    public function forceDelete(plan $plan) : Plan
    {
        if ($plan->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.plan.deleted'));
        }

        return DB::transaction(function () use ($planfeature) {
            // Delete associated relationships
            $planfeature->passwordHistories()->delete();
            $planfeature->providers()->delete();

            if ($planfeature->forceDelete()) {
                event(new UserPermanentlyDeleted($planfeature));

                return $planfeature;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
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
