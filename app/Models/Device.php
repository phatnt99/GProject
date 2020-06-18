<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
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
        $this->belongsTo("App\Models\File", "image");
    }

    public function company() {
        $this->belongsTo("App\Models\Company", "company_id");
    }

    /*
 * For soft-delete, we cant use pivot, so treat UserDevice as actual Eloquent and using
 * one-to-many in Device.
 */
    public function user_device() {
        return $this->hasMany("App\Models\UserDevice", "device_id");
    }
}
