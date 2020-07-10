<?php

namespace App\Models;

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

    public static function createNewImage($request, $auth)
    {
        $path = $request->file('img')->store($auth, 'public');

        //get information and save to array
        $infoImage = [
            'name'        => $request->file('img')->getClientOriginalName(),
            'upload_name' => $request->file('img')->hashName(),
            'mime_type'   => $request->file('img')->getMimeType(),
            'size'        => $request->file('img')->getSize(),
            'disk'        => 'public',
            'path'        => 'storage/'.$path,
        ];

        return File::create($infoImage);
    }

    public static function updateImage($request, $user, $auth)
    {
        //delete old avatar
        if ($user != null && $user->file) {
            Storage::disk("public")->delete($auth."/".$user->file->upload_name);
        }

        //create new file
        $path = $request->file('img')->store($auth, 'public');
        //get information and save to array
        $infoImage = [
            'name'        => $request->file('img')->getClientOriginalName(),
            'upload_name' => $request->file('img')->hashName(),
            'mime_type'   => $request->file('img')->getMimeType(),
            'size'        => $request->file('img')->getSize(),
            'model_type'  => $request->file('img')->getClientOriginalExtension(),
            'disk'        => 'public',
            'path'        => 'storage/'.$path,
        ];

        return File::create($infoImage);
    }
}
