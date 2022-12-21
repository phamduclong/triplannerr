<?php

namespace App\Repositories\Backend;

use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\Models\SliderAudio;
use Illuminate\Http\Request;
use Auth;
use App\Exceptions\GeneralException;




/**
 * Class SliderAudioRepository.
 */
class SliderAudioRepository extends BaseRepository 
{
    /**
     * SliderAudioRepository constructor.
     *
     * @param  SliderAudio  $model
     */
    public function __construct(SliderAudio $model) 
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
    public function getActivePaginated($paged = 1, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
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

            return $audiodata;
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

    public function forceDelete(SliderAudio $slider_audio) : SliderAudio
    {
        if ($slider_audio->deleted_at === null) {
            throw new GeneralException(__('alerts.backend.slider_audio.deleted'));
        }

        return DB::transaction(function () use ($slider_audio) {
            // Delete associated relationships
            $slider_audio->passwordHistories()->delete();
            $slider_audio->providers()->delete();

            if ($slider_audio->forceDelete()) {
                event(new UserPermanentlyDeleted($slider_audio));

                return $slider_audio;
            }

            throw new GeneralException(__('exceptions.backend.access.users.delete_error'));
        });
    }
  
}
