<?php
namespace App\Repositories\Backend\Services;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\GeneralException;
use App\Models\ServicesModel;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;


class ServiceRepository extends BaseRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(ServicesModel $model)
    {
        $this->model = $model;
    }


    public function getActivePaginated($paged = 25, $orderBy = 'created_at', $sort = 'desc') : LengthAwarePaginator
    {
        return $this->model
            ->orderBy($orderBy, $sort)
            ->paginate($paged);
    }


    // create a new record in the database
    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $travel_categ = $this->model::create([
                'title' => $data['title'],
                'graphic_type' => $data['graphic_type'],
                'description' => $data['page_description'],
                'graphic_content' => $data['graphic_content'],
                'status' => '1',
            ]);
        });
    }

    // update record in the database
    public function update(array $data, $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}