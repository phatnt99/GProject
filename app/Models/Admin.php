<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Auth
{
    //
    use Notifiable, HasRoles;

    protected $guard = 'admin';

    protected $guarded = [];

    public $guard_name = 'admin';

    protected $appends = ['name'];

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

    public function getGenderAttribute()
    {
        return $this->attributes["gender"] == 0 ? "Male" : "Female";
    }
}
