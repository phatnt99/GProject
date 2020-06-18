<?php


namespace App\Traits;


trait FreshTimestampTrait
{
    public function freshTimestamp()
    {
        return time(); // (int) instead of '2000-00-00 00:00:00'
    }
}
