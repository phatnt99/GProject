<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        $listSetting = Setting::all();
        $structuredListSetting = $listSetting->reduce(function ($carry, $item) {
            $carry[$item['key']] = $item['value'];

            return $carry;
        });

        return view('setting', ['settings' => $structuredListSetting]);
    }

    public function update(Request $request)
    {
        if ($request->hasFile('img')) {
            $newAvatar = File::createNewImage($request, "general");

            Setting::where('key', 'logo')->first()->update(['value' => $newAvatar->path]);
        }

        Setting::where('key', 'name')->first()->update(['value' => $request->name]);
        Setting::where('key', 'footer')->first()->update(['value' => $request->footer]);

        return redirect()->back()->with('success', 'Update setting successfully!');
    }
}
