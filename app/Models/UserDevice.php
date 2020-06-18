<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Base
{

    public $table = "user_device";
}
