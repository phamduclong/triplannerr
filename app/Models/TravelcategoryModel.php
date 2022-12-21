<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelcategoryModel extends Model
{
    use SoftDeletes;
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
}
