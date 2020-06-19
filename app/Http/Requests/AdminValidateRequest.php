<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class AdminValidateRequest extends FormRequest
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
            'login_id' => ['required','string', function ($attribute, $value, $fail) {
                //check if login_id in admin or user table
                if(!(User::where('login_id', $value)->count() > 0 || Admin::where('login_id', $value)->count() > 0)) {
                    $fail($attribute.' is invalid.');
                }
            }],
            'password' => 'required|string',
        ];
    }
}
