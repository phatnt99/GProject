<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class User extends Auth
{
    use Notifiable, HasRoles;

    protected $guard = 'user';

    protected $guarded = [];

    public $guard_name = 'user';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $appends = ['name'];

    //Relationships
    public function file()
    {
        return $this->belongsTo(File::class, "avatar", "id");
    }

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id", "id");
    }

    public function userDevices()
    {
        return $this->hasMany(UserDevice::class);
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

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = \Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
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

    public function getStartAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['start_at'])->format('d/m/Y');
    }

    public function getGenderAttribute()
    {
        return $this->attributes['gender'] == 0 ? "Male" : "Female";
    }
}
