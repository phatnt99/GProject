<?php

namespace App\Http\Controllers;

use App\Models\UserDevice;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    //
    public function exportUserLoan()
    {
        $userDevice = UserDevice::all();

        $data = $userDevice->reduce(function ($carry, $item) {

            $carry[$item['id']] = [
                'user' => $item->user->name,
                'device' => $item->device->name,
                'company' => $item->user->company->name,
                'status' => $item->is_using ? 'using' : 'returned',
                'loan_date' => $item->loan_date,
                'return_date' => $item->return_date
            ];
            return $carry;
        });

        return (new FastExcel($data))->download('user_device.csv');

    }
}
