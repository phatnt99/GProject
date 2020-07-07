<?php

namespace App\Models;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserDevice extends Pivot

{
    use PrimaryKeyTrait;
    public $table = "user_device";
    protected $dateFormat = 'U';


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function device() {
        return $this->belongsTo(Device::class);
    }
}
