<?php

namespace App\Http\Requests\Backend\Destination;

use App\Models\DestinationModel;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
/**
 * Class StorePlanRequest.
 */
class StoreDestinationRequest extends FormRequest
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
          'destination_id' => ['required', 'max:255', Rule::unique('destinations')->ignore($this->id)],
           'name' => ['required', 'max:255', Rule::unique('destinations')->ignore($this->id)],
            'page_description' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'wheather' => ['required'],
            'popular' => ['required'],
            'visits' => ['required'],
            'lattitude' => ['required'],
            'longitude' => ['required'],
        ];
    }
}
