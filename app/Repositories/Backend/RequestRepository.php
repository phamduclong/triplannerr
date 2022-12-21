<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\UserLevelRequest;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;

/**
 * Class TravelReportRepository.
 */
class RequestRepository extends BaseRepository 
{
    /**
     * FeedbackRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(UserLevelRequest $model)
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

    public function create(array $data) : UserLevelRequest
    {

        return DB::transaction(function () use ($data) {  
                $user_id = Auth::User('id');
                $id = $user_id->id;
                $user_level_request = $this->model::create([
                    'current_role_id ' => $data['current_role_id '],
                    'new_role_id' => $data['new_role_id'],
                    'status' => '1',
                ]);

            return $user_level_request;
        });

    }

    public function update(UserLevelRequest $user_level_request, array $data) : UserLevelRequest
    {
        return DB::transaction(function () use ($user_level_request, $data) {
            
            if ($user_level_request->update([
                'current_role_id' => $data['current_role_id'],
                'new_role_id' => $data['new_role_id'],
                'status' =>$data['status'],
            ]))
            
            {
              
                return $user_level_request;
            } 
 
        });
    }

    public function mark(UserLevelRequest $user_level_request, $id=null) : UserLevelRequest
    {
        $thisuser=DB::table('user_level_requests')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>0);
         DB::table('user_level_requests')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>1);
         DB::table('user_level_requests')->where('id',$id)->update($dstatus);
        }
        
        return $user_level_request;
    }

     public function forceDelete(UserLevelRequest $user_level_request) : UserLevelRequest
    {
        if ($user_level_request->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.user_level_request.deleted'));
        }

        return DB::transaction(function () use ($user_level_request) {
            // Delete associated relationships
            $user_level_request->passwordHistories()->delete();
            $user_level_request->providers()->delete();

            if ($user_level_request->forceDelete()) {
                event(new UserPermanentlyDeleted($user_level_request));

                return $user_level_request;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }
    
}
