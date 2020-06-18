<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
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
        return $this->belongsTo("App\Models\File", "logo");
    }

    public function users() {
        return $this->hasMany("App\Models\User", "company_id");
    }
}
