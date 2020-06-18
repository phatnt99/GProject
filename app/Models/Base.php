<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    //
    use PrimaryKeyTrait, FreshTimestampTrait;
    protected $dateFormat = 'U';
    public $incrementing = false;
}
