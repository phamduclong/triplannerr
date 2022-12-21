<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Travelcategory extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'graphic_type',
        'graphic_content',
        'categ_file_name',
        'description',
        'status',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public static function getFormOptions() {

        $values = self::select('name', 'id')->orderBy('name')->get();
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
