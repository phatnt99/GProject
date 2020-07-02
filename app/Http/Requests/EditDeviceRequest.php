<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDeviceRequest extends FormRequest
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
            //
            "code" => "required|unique:devices,code",
        ];
    }

    public function messages()
    {
        return [
            "code.required" => __("validation.required"),
        ];
    }
}
