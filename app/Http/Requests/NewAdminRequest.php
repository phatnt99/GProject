<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class NewAdminRequest extends FormRequest
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
            "login_id" => [
                "required",
                function ($attribute, $value, $fail) {
                    if (User::where('login_id', $value)->count() > 0 || Admin::where('login_id', $value)->count() > 0) {
                        $fail('Login ID has exists!');
                    }
                },
            ],
            "email"    => "required|unique:admins,email",
            "password" => "required",
            "birthday" => "date_format:d/m/Y|before:today",
        ];
    }

    public function messages()
    {
        return [
            "login_id.required" => __("validation.required"),
            "email.required"    => __("validation.required"),
            "email.unique"      => __("validation.unique"),
            "password.required" => __("validation.required"),
            "birthday.before"   => __("validation.before")
        ];
    }
}
