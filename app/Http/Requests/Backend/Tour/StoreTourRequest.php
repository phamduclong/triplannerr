<?php

namespace App\Http\Requests\Backend\Tour;

use App\Models\Tour;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
/**
 * Class StorePlanRequest.
 */
class StoreTourRequest extends FormRequest
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
           'title' => ['required', 'max:255', Rule::unique('tour')->ignore($this->id)],
            'tour_description' => ['required'],
            'rate' => ['required'],
            'banner_image' => ['required', 'mimes:jpeg,jpg,png,gif','max:10000'],
            'multiple_image' => ['required'],
            'cost' => ['required'],
            'review' => ['required'],
        ];
    }
}
