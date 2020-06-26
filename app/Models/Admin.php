<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class Admin extends Auth
{
    //
    use Notifiable;

    protected $guard = 'admin';

    protected $guarded = [];

    public function getId()
    {
        return $this->id;
    }

    //Business logic
    public function createAdminWithAvatar($request)
    {
        $newAvatar = null;

        if ($request->hasFile('avatar')) {
            $newAvatar = File::createNewImage($request, 'admin');
        }

        $this->fill($request->all());
        $this->avatar = $newAvatar ? $newAvatar->id : null;

        $this->save();
    }

    public function updateAdminWithAvatar($request)
    {
        //detect if user change avatar
        if ($request->hasFile('avatar')) {
            $newAvatar = File::updateImage($request, $this, "admin");

            $this->fill($request->all());
            $this->avatar = $newAvatar->id;
            $this->save();
        } else {
            $this->update($request->except('avatar'));
        }
    }

    //Relationship
    public function file()
    {
        return $this->belongsTo(File::class, "avatar", "id");
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setBirthdayAttribute($value)
    {
        if ($value != null) {
            $this->attributes['birthday'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        } else {
            $this->attributes['birthday'] = null;
        }
    }

    //Accessors
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getBirthdayAttribute()
    {
        return $this->attributes['birthday'] ? Carbon::createFromFormat('Y-m-d', $this->attributes['birthday'])
                                                     ->format('d/m/Y') : null;
    }
}
