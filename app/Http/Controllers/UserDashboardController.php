<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Device;
use App\Models\UserDevice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    //

    public function showCompanyInformation()
    {
        //get company_id of current user
        $companyId = Auth::guard('user')->user()->company_id;
        $company = Company::where('id', $companyId)->first();

        return view('show-company', ['company' => $company]);
    }

    public function showListEmployee(Request $request)
    {
        //get company_id of current user
        $companyId = Auth::guard('user')->user()->company_id;
        $company = Company::where('id', $companyId)->first();
        //list user
        $listUser = $company->users()->when($request->login_id, function ($query) use ($request) {
            return $query->where('login_id', $request->login_id);
        })->when($request->email, function ($query) use ($request) {
            return $query->where('email', $request->email);
        })->when($request->first_name, function ($query) use ($request) {
            return $query->where('first_name', 'LIKE', '%'.$request->first_name.'%');
        })->when($request->last_name, function ($query) use ($request) {
            return $query->where('last_name', 'LIKE', '%'.$request->last_name.'%');
        })->when($request->age, function ($query) use ($request) {
            return $query->whereYear('birthday', Carbon::now()->year - $request->age);
        })->when($request->address, function ($query) use ($request) {
            return $query->where('address', 'LIKE', '%'.$request->address.'%');
        })->when($request->gender !== null, function ($query) use ($request) {
            return $query->where('gender', $request->gender);
        })->orderBy('updated_at', 'desc')->paginate(5);
        //list company
        $listCompany = Company::all();

        return view('employees-company', ['users' => $listUser, 'companies' => $listCompany]);
    }

    public function showDeviceForUserLoan()
    {
        //get list all available device in current company of user
        $listUsingDeviceId = UserDevice::where('is_using', 1)->pluck('device_id');
        $listDevice = Device::where('company_id', Auth::guard('user')->user()->company_id)
                            ->whereNotIn('id', $listUsingDeviceId)
                            ->paginate(5);

        return view('show-loandevice', ['devices' => $listDevice]);
    }

    public function createLoanForUser(Request $request)
    {
        $user = Auth::guard('user')->user();
        $user->userDevices()->create([
            'user_id' => $user->id,
            'device_id' => $request->device_id,
            'is_using' => 1
        ]);

        return redirect()->back()->with(['success' => Device::where('id', $request->device_id)]);
    }

    public function showLoanDeviceHistory()
    {

        $listHistoryDevice = UserDevice::with(['device'])->where('user_id', Auth::guard('user')->user()->id)->paginate(5);
        return view('history-loandevice',['userDevices' => $listHistoryDevice]);
    }
}
