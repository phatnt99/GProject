<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditDeviceRequest;
use App\Http\Requests\NewDeviceRequest;
use App\Models\Company;
use App\Models\Device;
use App\Models\File;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
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

        $listDevice = Device::when($request->name, function ($query) use ($request) {
            return $query->where('name', 'LIKE', "%".$request->name."%");
        })->when($request->price, function ($query) use ($request) {
            return $query->where('price', $request->price);
        })->when($request->company_id, function ($query) use ($request) {
            return $query->where('company_id', $request->company_id);
        })->when($request->code, function ($query) use ($request) {
            return $query->where('code', $request->code);
        })->when($request->min_price, function ($query) use ($request) {
            return $query->where('price', '>=', $request->min_price);
        })->when($request->max_price, function ($query) use ($request) {
            return $query->where('price', '<=', $request->max_price);
        })->when($request->status != null, function ($query) use ($request) {
            if ($request->status == 1) {
                $query->whereIn('id', UserDevice::where('is_using', 1)->get()->pluck('device_id'));
            } else {
                $query->whereNotIn('id', UserDevice::where('is_using', 1)->get()->pluck('device_id'));
            }
        })
                            ->orderBy('devices.updated_at', 'desc')->paginate(5);

        $request->flash();

        return view('device', ['devices' => $listDevice, 'companies' => $listCompany]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $listCompany = Company::all();

        return view('new-device', ['companies' => $listCompany]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewDeviceRequest $request)
    {
        $device = new Device;

        $newImage = null;

        if ($request->hasFile('img')) {
            $newImage = File::createNewImage($request, 'device');
        }

        $device->fill($request->except('img'));
        $device->image = $newImage ? $newImage->id : null;

        $device->save();

        return redirect()->back()->with(["success" => $request->name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Device $device)
    {
        //
        $listCompany = Company::all();

        return view('edit-device', ["device" => $device, "companies" => $listCompany]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Device $device
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EditDeviceRequest $request)
    {
        //update
        $updateDevice = Device::findOrFail($request->id);

        if ($request->hasFile('img')) {
            $newImage = File::updateImage($request, $updateDevice, 'device');

            $updateDevice->fill($request->except('img'));
            $updateDevice->image = $newImage->id;
            $updateDevice->save();
        } else {
            $updateDevice->update($request->except('img'));
        }

        return redirect(route("device.edit", $updateDevice))->with('success', $updateDevice->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Device $device
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Device $device)
    {
        $device->delete();

        return redirect()->back()->with('success', $device->name);
    }
}
