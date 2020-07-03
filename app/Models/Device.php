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

    //Accessors
    public function getStatusAttribute()
    {
        //get all related user with this device
        $allRelatedUser = $this->users;
        foreach ($allRelatedUser as $user) {
            if ($user->pivot->is_using) {
                return 1;
            } //this user is using this device, so it now has status 1
        }

        return 0; //not find any user use this device at time so it has status 0
    }
}
