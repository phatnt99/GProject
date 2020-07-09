<?php

namespace App\Models;

class Device extends BaseModel
{
    //
    protected $table = 'devices';

    protected $guarded = [];

    protected $appends = ['image_link'];

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

    public function getImageLinkAttribute()
    {
        return $this->file->path;
    }
}
