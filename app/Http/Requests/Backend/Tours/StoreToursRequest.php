<?php

namespace App\Http\Requests\Backend\Tours;

use App\Models\ToursModel;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
/**
 * Class StorePlanRequest.
 */
class StoreToursRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        return [
           'title' => ['required', 'max:255', Rule::unique('tours')->ignore($this->id)],
            'departure_id' => ['required'],
            'page_description' => ['required'],
            'no_of_days' => ['required'],
            'no_of_nights' => ['required'],
            'currency' => ['required'],
            'cost' => ['required'],
            'start_date_time' => ['required'],
            'end_date_time' => ['required'],
            'meta_title' => ['required'],
            'meta_keywords' => ['required'],
            'meta_descirption' => ['required'],
        ];
    }
}
