<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    //
    use PrimaryKeyTrait, FreshTimestampTrait;
}
