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

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_device')
                    ->using(UserDevice::class)->withPivot('is_using');;
    }

    public function userDevices()
    {
        return $this->hasMany(UserDevice::class);
    }

    //Accessors
    public function getStatusAttribute()
    {
        if (UserDevice::where('device_id', $this->id)->where('is_using', 1)->first() != null) {
            return 1;
        }

        return 0;
    }
}
