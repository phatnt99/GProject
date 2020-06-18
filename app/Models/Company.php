<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Company extends Base
{
    //

    public function file() {
        return $this->belongsTo(File::class, "logo");
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
