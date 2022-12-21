<?php

namespace App\Repositories\Backend\TravelCategory;
use Illuminate\Http\Request;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use App\Models\TravelcategoryModel;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TravelCategoryRepository extends BaseRepository
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(TravelcategoryModel $model)
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
    public function create(array $data,$image)
    {
        //dd($data['graphic_content']);
        $data['graphic_content']=$image;
        return DB::transaction(function () use ($data) {
            $travel_categ = $this->model::create([
                'name' => $data['name'],
                'graphic_type' => $data['graphic_type'],
                'description' => $data['description'],
                'graphic_content' => $data['graphic_content'],
                'meta_title' => $data['meta_title'],
                'meta_description' => $data['meta_description'],
                'meta_keywords' => $data['meta_keyword'],
                'status' => '1',
            ]);
        });
    }

    //update record in the database TravelcategoryModel
    public function update(array $data,$image, $id)
    {
        $data['graphic_content']=$image; 
       
        $tourcarrier= $this->model->where('id', $id)->update(array(
                    'name'              => $data['name'],
                    'graphic_type'      => $data['graphic_type'],
                    'description'       => $data['description'],
                    'graphic_content'   => $data['graphic_content'],
                    'meta_title'        => $data['meta_title'],
                    'meta_description'  => $data['meta_description'],
                    'meta_keywords'     => $data['meta_keyword'],
                    'status'            => '1',));
       
                return $tourcarrier;

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