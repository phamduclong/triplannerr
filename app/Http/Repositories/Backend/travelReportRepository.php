<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\TravelReports;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;


/**
 * Class TourCarrierRepository.
 */
class travelReportRepository extends BaseRepository 
{
    /**
     * travelReportRepository constructor.
     *
     * @param  User  $model
     */
    public function __construct(TravelReports $model)
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
    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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
    public function getInactivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->with('roles', 'permissions', 'providers')
            ->active(false)
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
    public function create(array $data,$image) : TourCarrier
    {
        $data['graphic_content']=$image;
        return DB::transaction(function () use ($data) { 

    // if($data['graphic_type']=='icone'){
    //     $data['graphic_content'] = $data['content']; 
    //   }

    //   if($data['graphic_type']=='Image'){
    //     if ($request->hasFile('carrier_file_name'))
    //     {

    //         $image = $request->file('carrier_file_name'); //get the file
    //         $img_name = rand(11111, 99999) . '.' . $image->getClientOriginalExtension(); //get
    //         $destinationPath = public_path('/img/backend/tour_carriers/image');//public path
    //          $image->move($destinationPath, $img_name);//mve to destination you mentioned
    //     }

    //      $data->graphic_content = isset($img_name)?$img_name:'';
    //    }

            $travelcarrier = $this->model::create([
                'title' => $data['title'],
                'description' => $data['description'],
                'graphic_type' => $data['graphic_type'],
                'graphic_content' => $data['graphic_content'],
                'status' => isset($data['active']) && $data['active'] === '1',
            ]);

            // See if adding any additional permissions

            return $travelcarrier;
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
    public function update(TourCarrier $tourcarrier, array $data) : TourCarrier
    {
        return DB::transaction(function () use ($tourcarrier, $data) {
            if ($tourcarrier->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'graphic_type' => $data['graphic_type'],
                'graphic_content' => 1,
            ])) {
                // Add selected roles/permissions
                return $tourcarrier;
            }
           
            //throw new GeneralException(__('exceptions.backend.access.users.update_error'));
        });
    }

   
    public function mark(TourCarrier $tourcarrier, $status) : TourCarrier
    {
        $thisuser=DB::table('tour_carriers')->where('id',$id)->first();
      if($thisuser->status==1)
       {
        $dstatus=array('status'=>0);
         DB::table('tour_carriers')->where('id',$id)->update($dstatus);
       }
        else
        {
        $dstatus=array('status'=>1);
         DB::table('tour_carriers')->where('id',$id)->update($dstatus);
        }
        
        return $travelreport;

    }

  
    public function forceDelete(User $user) : User
    {
        if ($user->deleted_at === null) {
            throw new GeneralException(__('exceptions.backend.access.users.delete_first'));
        }

        return DB::transaction(function () use ($user) {
            // Delete associated relationships
            $user->passwordHistories()->delete();
            $user->providers()->delete();

            if ($user->forceDelete()) {
                event(new UserPermanentlyDeleted($user));

                return $user;
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
