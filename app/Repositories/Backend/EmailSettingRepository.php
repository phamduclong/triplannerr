<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\EmailDetails;
use Illuminate\Http\Request;
use App\Models\Auth\User;
use Auth;
use App\Exceptions\GeneralException;
use Validator;




/**
 * Class TravelReportRepository.
 */
class EmailSettingRepository extends BaseRepository 
{
    /**
     * AdvertisementRepository constructor.
     *
     * @param  Plan  $model
     */
    public function __construct(EmailDetails $model)
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

    public function create(array $data) : EmailDetails
    {

        return DB::transaction(function () use ($data) {  
            
               $emailsetting = $this->model::create([
                    'type' => $data['type'],
                    'subject' => $data['subject'],
                    'content' => $data['content'],
                    // 'sent_to' => $data['sent_to'],
                    // 'sent_from' => $data['sent_from'],
                ]);
              
            return $emailsetting;
        });

    }

     public function update(EmailDetails $emaildetails, array $data) : EmailDetails
    {
        return DB::transaction(function () use ($emaildetails, $data) {
             
             
            if ($emaildetails->update([
                   'type' => $data['type'],
                    'subject' => $data['subject'],
                    'content' => $data['content'],
                    // 'sent_to' => $data['sent_to'],
                    // 'sent_from' => $data['sent_from'],
            ]))

             {
              
                return $emaildetails;
            } 
 
        });
    }

    // public function mark(EmailDetails $emaildetails, $id=null) : EmailDetails
    // {
    //     $thisuser=DB::table('emaildetails')->where('id',$id)->first();
    //   if($thisuser->status=='1')
    //    {
        
    //     $dstatus=array('status'=>'0');
        
    //      DB::table('emaildetails')->where('id',$id)->update($dstatus);
        
    //    }
    //     else
    //     {
            
    //     $dstatus=array('status'=>'1');
    //      DB::table('advertisements')->where('id',$id)->update($dstatus);
    //     }
        
    //     return $advertisement;
    // }

     public function forceDelete(EmailDetails $emaildetails) : EmailDetails
    {
        if ($emaildetails->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.emailsettings.deleted'));
        }

        return DB::transaction(function () use ($emaildetails) {
            // Delete associated relationships
            $emaildetails->passwordHistories()->delete();
            $emaildetails->providers()->delete();

            if ($emaildetails->forceDelete()) {
                event(new UserPermanentlyDeleted($emaildetails));

                return $emaildetails;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }
    
}
