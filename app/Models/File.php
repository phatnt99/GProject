<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth as Author;

class File extends BaseModel
{
    //
    protected $fillable = [
        'name', 'upload_name', 'mime_type', 'model_type',
        'is_public', 'size', 'disk', 'path', 'additional',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_by = Author::guard('admin')->user()? Author::guard('admin')->user()->getId() : null;
            $model->updated_by = Author::guard('admin')->user()? Author::guard('admin')->user()->getId() : null;

        });
    }

}
