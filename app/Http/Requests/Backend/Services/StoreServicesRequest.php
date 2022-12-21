<?php

namespace App\Http\Requests\Backend\Services;

use App\Models\ServicesModel;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
/**
 * Class StorePlanRequest.
 */
class StoreServicesRequest extends FormRequest
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
           'title' => ['required', 'max:255', Rule::unique('services')->ignore($this->id)],
            'page_description' => ['required'],
            //'slug' => ['required'],
            //'file_name' => ['mimes:jpeg,jpg,png,gif','max:10000'],
            'graphic_type' => ['required'],
            //'graphic_content' => ['required'],
        ];
    }
}
