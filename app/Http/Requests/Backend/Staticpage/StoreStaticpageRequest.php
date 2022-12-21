<?php

namespace App\Http\Requests\Backend\Staticpage;

use App\Models\StaticpageModel;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
/**
 * Class StorePlanRequest.
 */
class StoreStaticpageRequest extends FormRequest
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
        //dd($request->all());
        return [
            'name' => ['required', 'max:255', Rule::unique('static_pages')->ignore($this->id)],
            'page_url' => ['required'],
            'page_description' => ['required'],
            'meta_title' => ['required'],
            'meta_description' => ['required'],
            'meta_keyword' => ['required'],
        ];
    }
}
