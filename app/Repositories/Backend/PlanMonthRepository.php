<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\PlanMonth;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use Auth;
use App\Exceptions\GeneralException;
use Validator;




/**
 * Class TravelReportRepository.
 */
class PlanMonthRepository extends BaseRepository 
{
    /**
     * AdvertisementRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(PlanMonth $model)
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

    public function mark(PlanMonth $plan_month, $id=null) : PlanMonth
    {
        $thisuser=DB::table('plan_months')->where('id',$id)->first();
      if($thisuser->status=='1')
       {
        
        $dstatus=array('status'=>'0');
        
         DB::table('plan_months')->where('id',$id)->update($dstatus);
        
       }
        else
        {
            
        $dstatus=array('status'=>'1');
         DB::table('plan_months')->where('id',$id)->update($dstatus);
        }
        
        return $plan_month;
    }


    /**
     * @param array $data 
     *
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */

     public function forceDelete(PlanMonth $plan_month) : PlanMonth
    {
        if ($plan_month->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.plan_month.deleted'));
        }

        return DB::transaction(function () use ($plan_month) {
            // Delete associated relationships
            $plan_month->passwordHistories()->delete();
            $plan_month->providers()->delete();

            if ($plan_month->forceDelete()) {
                event(new UserPermanentlyDeleted($plan_month));

                return $plan_month;
            }

            throw new GeneralException(__('exceptions.backend.access.plan_month.delete_error'));
        });
    }

    

    
    
}
