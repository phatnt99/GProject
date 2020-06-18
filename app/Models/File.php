<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;

class File extends Base
{
    //

    public function fromDateTime($value)
    {
        return $value; // Don't mutate our (int) on INSERT!
    }
}
