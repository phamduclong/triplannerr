<?php

namespace App\Http\Requests\Backend\Travelcategory;

use App\Models\TravelcategoryModel;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
/**
 * Class StorePlanRequest.
 */
class UpdateTravelcategoryRequest extends FormRequest
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
            'name' => ['required', 'max:255', Rule::unique('categories')->ignore($this->id)],
            'graphic_type' => ['required'],
            'description' => ['required'],
            'meta_title' => ['required'],
            'meta_description' => ['required'],
            'meta_keyword' => ['required'],
        ];
    }
}
