<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\TravelReport;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;




/**
 * Class TravelReportRepository.
 */
class TravelReportRepository extends BaseRepository 
{
    /**
     * TravelReportRepository constructor.
     *
     * @param  TravelReport  $model
     */
    public function __construct(TravelReport $model) 
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
    public function create(array $data) : TravelReport
    {

        return DB::transaction(function () use ($data) {  
             $userid = Auth::user('id');
              $id = $userid->id;
                $travel_report = $this->model::create([
                    'user_id' => $id,
                    'title' => $data['title'],
                    'category_id' => $data['category_id'],
                    'report_date' => $data['report_date'],
                    'report_country' => $data['report_country'],
                    'travel_time' => $data['travel_time'],
                    'cover_photo' => $data['cover_photo'],
                    'lattitude' => $data['lattitude'],
                    'longitude' => $data['longitude'],
                    'travel_cost' => $data['travel_cost'],
                    'status' => isset($data['active']) && $data['active'] === '1',
                ]);

            // See if adding any additional permissions
                //dd($travel_report);
            return $travel_report;
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
    public function update(TravelReport $travelreport, array $data) : TravelReport
    {
        return DB::transaction(function () use ($travelreport, $data) {
            if ($travelreport->update([
                    'title' => $data['title'],
                    'category_id' => $data['category_id'],
                    'report_date' => $data['report_date'],
                    'report_country' => $data['report_country'],
                    'travel_time' => $data['travel_time'],
                    'cover_photo' => $imgName,
                    'lattitude' => $data['lattitude'],
                    'longitude' => $data['longitude'],
                    'travel_cost' => $data['travel_cost'],
            ])) {
               
                // Add selected roles/permissions
                return $travelreport;
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
    public function mark(TravelReport $travelreport, $id=null) : TravelReport
    {
        $thisuser=DB::table('travel_reports')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>0);
         DB::table('travel_reports')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>1);
         DB::table('travel_reports')->where('id',$id)->update($dstatus);
        }
        
        return $travelreport;

        //throw new GeneralException(__('exceptions.backend.access.travelreport.mark_error'));
    }
    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function confirm(User $user) : User
    {
        if ($user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.already_confirmed'));
        }

        $user->confirmed = true;
        $confirmed = $user->save();

        if ($confirmed) {
            event(new UserConfirmed($user));

            // Let user know their account was approved
            if (config('access.users.requires_approval')) {
                $user->notify(new UserAccountActive);
            }

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_confirm'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function unconfirm(User $user) : User
    {
        if (! $user->confirmed) {
            throw new GeneralException(__('exceptions.backend.access.users.not_confirmed'));
        }

        if ($user->id === 1) {
            // Cant un-confirm admin
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_admin'));
        }

        if ($user->id === auth()->id()) {
            // Cant un-confirm self
            throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm_self'));
        }

        $user->confirmed = false;
        $unconfirmed = $user->save();

        if ($unconfirmed) {
            event(new UserUnconfirmed($user));

            return $user;
        }

        throw new GeneralException(__('exceptions.backend.access.users.cant_unconfirm'));
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @throws \Exception
     * @throws \Throwable
     * @return User
     */
    public function forceDelete(TravelReport $travelreport) : TravelReport
    {
        if ($travelreport->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.travel_report.delete_first'));
        }

        return DB::transaction(function () use ($travelreport) {
            // Delete associated relationships
            $travelreport->passwordHistories()->delete();
            $travelreport->providers()->delete();

            if ($travelreport->forceDelete()) {
                event(new UserPermanentlyDeleted($travelreport));

                return $travelreport;
            }

            throw new GeneralException(__('exceptions.backend.access.travel_report.delete_error'));
        });
    }

    /**
     * @param User $user
     *
     * @throws GeneralException
     * @return User
     */
    public function restore(TravelReport $travelreport) : TravelReport
    {
        if ($travelreport->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.travel_report.cant_restore'));
        }

        if ($travelreport->restore()) {
            event(new UserRestored($travelreport));

            return $travelreport;
        }

        throw new GeneralException(__('exceptions.backend.access.travel_report.restore_error'));
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
