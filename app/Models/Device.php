<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Base
{
    //

    public function fromDateTime($value)
    {
        return $value; // Don't mutate our (int) on INSERT!
    }

    public function file() {
        $this->belongsTo(File::class, "image");
    }

    public function company() {
        $this->belongsTo(Company::class);
    }

    /*
 * For soft-delete, we cant use pivot, so treat UserDevice as actual Eloquent and using
 * one-to-many in Device.
 */
    public function user_device() {
        return $this->hasMany(UserDevice::class);
    }
}
