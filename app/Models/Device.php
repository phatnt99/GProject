<?php

namespace App\Models;

class Device extends BaseModel
{
    //
    protected $table = 'devices';

    protected $guarded = [];

    //Business logic
    public function createDevice($request)
    {
        $newImage = null;

        if ($request->hasFile('img')) {
            $newImage = File::createNewImage($request, 'device');
        }

        $this->fill($request->except('img'));
        $this->image = $newImage ? $newImage->id : null;

        $this->save();
    }

    public function updateDevice($request)
    {
        //detect if user change image device
        if ($request->hasFile('img')) {
            $newImage = File::updateImage($request, $this, 'device');

            $this->fill($request->except('img'));
            $this->image = $newImage->id;
            $this->save();
        } else {
            $this->update($request->except('img'));
        }
    }

    public function file()
    {
        return $this->belongsTo(File::class, "image");
    }

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id");
    }

    /*
 * For soft-delete, we cant use pivot, so treat UserDevice as actual Eloquent and using
 * one-to-many in Device.
 */
    public function userDevices()
    {
        return $this->hasMany(UserDevice::class);
    }
}
