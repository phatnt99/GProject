<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewUserValidateRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "login_id" => "required|unique:users,login_id",
            "email" => "required|unique:users,email",
            "password" => "required",
            "start_at" => "required",
        ];
    }

    public function messages()
    {
        return [
            "login_id.required" => __("validation.required"),
            "login_id.unique" => __("validation.unique"),
            "email.required" => __("validation.required"),
            "email.unique" => __("validation.unique"),
            "password.required" => __("validation.required"),
            "start_at.required" => __("validation.required"),
            "code.required" => __("validation.required")
        ];
    }
}
