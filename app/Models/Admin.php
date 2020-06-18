<?php

namespace App\Models;


use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Base
{
    //

    public function fromDateTime($value)
    {
        return $value; // Don't mutate our (int) on INSERT!
    }

    public function file() {
        return $this->belongsTo(File::class, "avatar", "id");
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
