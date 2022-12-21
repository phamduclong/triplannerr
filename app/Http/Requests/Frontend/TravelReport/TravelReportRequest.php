<?php

namespace App\Http\Requests\Frontend\TravelReport;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
/**
 * Class TravelReportRequest.
 */
class TravelReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'travel_report_name' => ['required'],

            'travel_report_category' => ['required'],

            'travel_report_date' => ['required'],

            'travel_report_country' => ['required'],

            'total_travel_time' => ['required'],
            'total_cost_of_trip' => ['required'],

            'no_of_carriers_during_journey' => ['required'],

            'extendeddescriptive' => ['required'],

            'cover_photo_trip' => ['required'],

            'component_name' => ['required'],
            'component_cost' => ['required'],

            'gallery_photo' => ['required'],
            'gallery_caption' => ['required'],
            'location_of_shot' => ['required'],
            'sorting_in_gallery' => ['required'],

            'slideshow_with_audio' => ['required'],
            'title' => ['required', Rule::unique('travel_reports')],
        ];
    }

}
