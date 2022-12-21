<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;
/**
 * Class TravelReportRepository.
 */
class FeedbackRepository extends BaseRepository 
{
    /**
     * FeedbackRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(Feedback $model)
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

    public function create(array $data) : Feedback
    {

        return DB::transaction(function () use ($data) {  
                $user_id = Auth::User('id');
                $id = $user_id->id;
                $feedback = $this->model::create([
                    'feedback_type' => $data['feedback_type'],
                    'feedback_id' => $id,
                    'content' => $data['content'],
                    'rating_type1' => $data['rating_type1'],
                    'rating_type2' => $data['rating_type2'],
                    'rating_type3' => $data['rating_type3'],
                    'rating_type4' => $data['rating_type4'],
                    'rating_type5' => $data['rating_type5'],
                    'rating_type6' => $data['rating_type6'],
                    'rating_type7' => $data['rating_type7'],
                    'status' => '1',
                ]);

            return $feedback;
        });

    }

     public function update(Feedback $feedback, array $data) : Feedback
    {
        return DB::transaction(function () use ($feedback, $data) {
            
            if ($feedback->update([
                'feedback_type' => $data['feedback_type'],
                'content' => $data['content'],
                'rating_type1' => $data['rating_type1'],
                'rating_type2' => $data['rating_type2'],
                'rating_type3' => $data['rating_type3'],
                'rating_type4' => $data['rating_type4'],
                'rating_type5' => $data['rating_type5'],
                'rating_type6' => $data['rating_type6'],
                'rating_type7' => $data['rating_type7'],
            ]))

             {
              
                return $feedback;
            } 
 
        });
    }

    public function mark(Feedback $feedback, $id=null) : Feedback
    {
        $thisuser=DB::table('feedbacks')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>0);
         DB::table('feedbacks')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>1);
         DB::table('feedbacks')->where('id',$id)->update($dstatus);
        }
        
        return $feedback;
    }

     public function forceDelete(Feedback $feedback) : Feedback
    {
        if ($feedback->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.feedback.deleted'));
        }

        return DB::transaction(function () use ($feedback) {
            // Delete associated relationships
            $feedback->passwordHistories()->delete();
            $feedback->providers()->delete();

            if ($feedback->forceDelete()) {
                event(new UserPermanentlyDeleted($feedback));

                return $feedback;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }
    
}
