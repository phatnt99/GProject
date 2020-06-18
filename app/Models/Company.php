<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    use PrimaryKeyTrait, FreshTimestampTrait;
}
