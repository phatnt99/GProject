<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
                    //get old value
                    $auth = Auth::guard('admin')->user() ?? Auth::guard('user')->user();
                    if($value != $auth->login_id) {

                        //changing login_id
                        if (User::where('login_id', $value)->count() > 0 || Admin::where('login_id', $value)
                                                                                 ->count() > 0) {
                            //already had this login_id
                            $fail('Login ID has exists!');
                        }
                    }
                },
            ],
            "email"    => [
                "required",
                function ($attribute, $value, $fail) {
                    //get old value
                    $auth = Auth::guard('admin')->user() ?? Auth::guard('user')->user();
                    if($value != $auth->email) {
                        //changing login_id
                        if (User::where('email', $value)->count() > 0 || Admin::where('email', $value)
                                                                                 ->count() > 0) {
                            //already had this login_id
                            $fail('Email has exists!');
                        }
                    }
                },
            ],
            "birthday" => "nullable|date_format:d/m/Y|before:today",
        ];
    }

    public function messages()
    {
        return [
            "login_id.required" => __("validation.required"),
            "email.required"    => __("validation.required"),
            "birthday.before"   => __("validation.before")
        ];
    }
}
