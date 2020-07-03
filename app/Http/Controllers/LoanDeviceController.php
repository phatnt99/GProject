<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewLoanRequest;
use App\Models\Company;
use App\Models\Device;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;

class LoanDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        //
        $listCompany = Company::all();

        $loanDevices = UserDevice::when($request->user_code, function ($query) use ($request) {
            return $query->join('users', 'users.id', '=', 'user_device.user_id')->where('users.code', $request->user_code);
        })->when($request->user_name, function ($query) use ($request) {
            return $query->join('users', 'users.id', '=', 'user_device.user_id')->where('users.first_name','LIKE',"%".$request->user_name."%");
        })->when($request->device_code, function ($query) use ($request) {
            return $query->join('devices', 'devices.id', '=', 'user_device.device_id')->where('devices.code', $request->device_code);
        })->when($request->device_name, function ($query) use ($request) {
            return $query->join('devices', 'devices.id', '=', 'user_device.device_id')->where('devices.name','LIKE',"%".$request->device_name."%");
        })->when($request->company_id, function ($query) use ($request) {
            return $query->join('users', 'users.id', '=', 'user_device.user_id')->where('users.company_id',$request->company_id);
        })->orderBy('user_device.updated_at', 'desc')->paginate(5);

        $request->flash();

        return view('loandevice', ['loanDevices' => $loanDevices, "companies" => $listCompany]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        //
        $users = User::all();
        $devices = Device::all();

        return view('new-loandevice', ['users' => $users, 'devices' => $devices]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewLoanRequest $request)
    {
        //
        $user = User::where('id', $request->user_id)->first();
        $user->devices()->attach($request->device_id);

        return redirect()->back()->with(["success" => ["user" => $user->name, "device" => Device::where('id', $request->device_id)->first()->name]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(UserDevice $loanDevice)
    {
        //
        $user = $loanDevice->user;
        $user->devices()->detach($loanDevice->device->id);

        return redirect()->back();
    }
}
