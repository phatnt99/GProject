<?php

namespace App\Http\Requests;

use App\Models\Auth;
use App\Models\Device;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class NewLoanRequest extends FormRequest
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
            "user_id"   => "required",
            "device_id" => [
                "required",
                function ($attribute, $value, $fail) {
                    //reuse in case user is actor who borrow
                    $userId = $this->user_id ?? Auth::guard('user')->user()->id;
                    $userCompany = User::where('id', $userId)->first()->company_id;
                    $deviceCompany = Device::where('id', $value)->first()->company_id;
                    if ($userCompany != $deviceCompany) {
                        $fail('User and Device must be same company!');
                    }

                    if(Device::where('id', $value)->first()->status == 1) {
                        $fail('Device is being borrowed!');
                    }
                },
            ],
        ];
    }
}
