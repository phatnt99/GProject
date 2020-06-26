<?php

namespace App\Models;

class Device extends BaseModel
{
    //

    public function file()
    {
        $this->belongsTo(File::class, "image");
    }

    public function company()
    {
        $this->belongsTo(Company::class);
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
