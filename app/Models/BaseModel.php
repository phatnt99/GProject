<?php

namespace App\Models;

use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    //
    use PrimaryKeyTrait;

    protected $dateFormat = 'U';

    public $incrementing = false;
}
