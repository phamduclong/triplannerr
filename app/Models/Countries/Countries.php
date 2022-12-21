<?php

namespace App\Models\Countries;

use App\Models\Countries\Traits\Attribute\CountriesAttribute;
use App\Models\Countries\Traits\Relationship\CountriesRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Countries extends BaseModel
{
    use SoftDeletes,
        CountriesAttribute,
        CountriesRelationship {
            // BlogCategoryAttribute::getEditButtonAttribute insteadof ModelTrait;
        }

    protected $table;

    protected $fillable = [
                'id',
                'country',
                'name',
                'area',
                'created_at',
                'updated_at',
                'deleted_at',
            ];
    protected $appends = [
        'country_link',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('module.countries.table');
    }
   
}