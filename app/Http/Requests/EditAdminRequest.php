<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
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
                function ($value, $attribute , $fail) {
                    if ($value != User::where('id', $this->user)->first()) { //if change login_id
                        if (User::where('login_id', $value)->count() > 0 || Admin::where('login_id', $value)
                                                                                 ->count() > 0) {
                            $fail('Login ID has exists!');
                        }
                    }
                },
            ],
            "email"    => "required|unique:admins,email,".$this->admin,
            "birthday" => "nullable|date_format:d/m/Y|before:today",
        ];
    }

    public function messages()
    {
        return [
            "login_id.required" => __("validation.required"),
            "email.required"    => __("validation.required"),
            "email.unique"      => __("validation.unique"),
            "birthday.before"   => __("validation.before")
        ];
    }
}
