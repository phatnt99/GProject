<?php

namespace App\Traits;


use Illuminate\Support\Facades\Auth as Author;

trait CrudEvent {
    public static function bootCrudEvent() {
        static::creating(function ($model) {

            $model->created_by = Author::guard('admin')->user() ? Author::guard('admin')->user()->id : null;
            $model->updated_by = Author::guard('admin')->user() ? Author::guard('admin')->user()->id : null;
        });

        static::updating(function ($model) {
            $model->updated_by = Author::guard('admin')->user() ? Author::guard('admin')->user()->id : null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Author::guard('admin')->user() ? Author::guard('admin')->user()->id : null;
            $model->save(); //will not fire if not use it
        });
    }
}
