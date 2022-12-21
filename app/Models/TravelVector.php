<?php

namespace App\Models;

use App\Models\State;
use App\Models\BaseModel;

class TravelVector extends BaseModel
{
    protected $table = 'travel_vectors';
   
    protected $fillable = [
        'name',
        'parent_id',
        'vector_type',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function parent() {
        return $this->belongsTo(TravelVector::class,'parent_id');
    }

    public static function getFavouriteMealsFormOptions() {
        
        try {
            $values = self::select('name', 'id')->where('parent_id','!=','0')->where('vector_type','meals')->get();
        } catch(\Exception $e) {
            return [];
        }

        $valuesArray = [];   
        foreach($values as $value) {
            $valuesArray[$value->id] = [
                'label' => $value->name,
                'value' => $value->id
            ];
        }

        return $valuesArray;
    }

    public static function getTravelVectorFormOptions() {
        
        try {
            $values = self::select('name', 'id')->where('parent_id',1)->get();
        } catch(\Exception $e) {
            return [];
        }

        $valuesArray = [];   
        foreach($values as $value) {
            $valuesArray[$value->id] = [
                'label' => $value->name,
                'value' => $value->id
            ];
        }

        return $valuesArray;
    }

}
