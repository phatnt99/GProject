<?php

namespace App\Models;

use App\Traits\CrudEvent;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseModel extends Model
{
    //
    use PrimaryKeyTrait, CrudEvent, SoftDeletes;

    protected $dateFormat = 'U';

    public $incrementing = false;
}
