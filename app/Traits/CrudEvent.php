<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth as Author;

trait CrudEvent
{
    public static function bootCrudEvent()
    {
        static::creating(function ($model) {
            /*
             * In case UserDevice: This will be create by both user and admin, so the solution is
             * check both guard
             */
            if (Author::guard('admin')->check())
            {
                $model->created_by = Author::guard('admin')->user() ? 'admins.'.Author::guard('admin')->user()->id : null;
                $model->updated_by = Author::guard('admin')->user() ? 'admins.'.Author::guard('admin')->user()->id : null;
            } else
            {
                //User create
                $model->created_by = Author::guard('user')->user() ? 'users.'.Author::guard('user')->user()->id : null;
                $model->updated_by = Author::guard('user')->user() ? 'users.'.Author::guard('user')->user()->id : null;
            }
        });

        static::updating(function ($model) {
            $model->updated_by = Author::guard('admin')->user() ? 'admins.'.Author::guard('admin')->user()->id : null;
        });

        static::deleting(function ($model) {
            $model->deleted_by = Author::guard('admin')->user() ? 'admins.'.Author::guard('admin')->user()->id : null;
            $model->save(); //will not fire if not use it
        });
    }
}
