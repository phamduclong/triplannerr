<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TravelVector;

class TravelReportComponent extends Model
{
   protected $table = 'travel_report_component';

   protected $appends = ['component', 'sub_component'];

   protected $fillable = [
        'travel_report_id',
        'component_name',
        'sub_component_id',
        'component_cost',
        'individual_cost',
        'total_exp',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'travel_pro',
        'travel_pro_name'
    ];

    public function getComponentAttribute()
    {
        if(!empty($this->component_name)){
            $vector = TravelVector::where('id', $this->component_name)->select('id', 'name')->first();
            if(!empty($vector)){
                return $vector->name;
            }
        }
        return null;
    }

    public function getSubComponentAttribute()
    {
        if(!empty($this->sub_component_id)){
            $vector = TravelVector::where('id', $this->sub_component_id)->select('id', 'name')->first();
            if(!empty($vector)){
                return $vector->name;
            }
        }
        return null;
    }

    /*public function report_vector(){
        return $this->belongsTo(TravelVector::class, 'component_name');
    }*/
}
