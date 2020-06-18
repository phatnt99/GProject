<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait PrimaryKeyTrait {
    public static function bootPrimaryKeyTrait() {
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
