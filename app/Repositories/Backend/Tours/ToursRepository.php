<?php

namespace App\Repositories\Backend\Tours;
use App\Repositories\Backend\Destination\ToursRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Models\ToursModel;


class ToursRepository extends BaseRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(ToursModel $model)
    {
        $this->model = $model;
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
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