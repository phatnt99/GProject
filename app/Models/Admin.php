<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admin extends Model
{
    //
    use PrimaryKeyTrait, FreshTimestampTrait;
    protected $dateFormat = 'U';
    public $incrementing = false;

    public function fromDateTime($value)
    {
        return $value; // Don't mutate our (int) on INSERT!
    }

    public function file() {
        return $this->belongsTo("App\Models\File", "avatar", "id");
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
