<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth as Author;
use Illuminate\Support\Facades\Storage;

class File extends BaseModel
{
    //
    protected $fillable = [
        'name',
        'upload_name',
        'mime_type',
        'model_type',
        'is_public',
        'size',
        'disk',
        'path',
        'additional',
    ];

    public static function createNewImage($request, $guard)
    {
        $path = $request->file('avatar')->store($guard, 'public');

        //get information and save to array
        $infoImage = [
            'name'        => $request->file('avatar')->getClientOriginalName(),
            'upload_name' => $request->file('avatar')->hashName(),
            'mime_type'   => $request->file('avatar')->getMimeType(),
            'size'        => $request->file('avatar')->getSize(),
            'disk'        => 'public',
            'path'        => 'storage/'.$path,
        ];

        return File::create($infoImage);
    }

    public static function updateImage($request, $user, $guard)
    {
        //delete old avatar
        if ($user->file) {
            Storage::disk("public")->delete($guard."/".$user->file->upload_name);
        }

        //create new file
        $path = $request->file('avatar')->store($guard, 'public');
        //get information and save to array
        $infoImage = [
            'name'        => $request->file('avatar')->getClientOriginalName(),
            'upload_name' => $request->file('avatar')->hashName(),
            'mime_type'   => $request->file('avatar')->getMimeType(),
            'size'        => $request->file('avatar')->getSize(),
            'disk'        => 'public',
            'path'        => 'storage/'.$path,
        ];

        return File::create($infoImage);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_by = Author::guard('admin')->user() ? Author::guard('admin')->user()->id : null;
            $model->updated_by = Author::guard('admin')->user() ? Author::guard('admin')->user()->id : null;
        });
    }
}
