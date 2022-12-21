<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public static function getFormOptions() {
        
        try {
            // $values = self::select('name', 'id')->orderBy('name')->get();
            $values = self::select('name', 'id')->get();
        } catch(\Exception $e) {
            return [];
        }

        // $valuesArray = [
        //     0 => [
        //         'label' => '',
        //         'value' => '',
        //     ]
        // ];   
        foreach($values as $value) {
            $valuesArray[$value->id] = [
                'label' => $value->name,
                'value' => $value->id
            ];
        }
  
        return $valuesArray;
    }
}
