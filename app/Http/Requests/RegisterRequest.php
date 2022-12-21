<?php

namespace App\Http\Requests;

use App\Models\Auth\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use LangleyFoxall\LaravelNISTPasswordRules\PasswordRules;

/**
 * Class RegisterRequest.
 */
class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $email = data_get($this->request->all(), 'email');
        $checkEmail = User::where([
            ['email', $email],
            ['confirmed', false]
        ])->first();
        if($checkEmail) {
            $checkEmail->forceDelete();
        }
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', Rule::unique('users')],
            'user_name'=>['required', 'string'],
            'role_type' =>['required'],
            'approval_status' =>['required'],
            'password' => PasswordRules::register($this->email),
            'g-recaptcha-response' => ['required_if:captcha_status,true', 'captcha'],
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'g-recaptcha-response.required_if' => __('validation.required', ['attribute' => 'captcha']),
        ];
    }
}
