<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\File;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

$factory->define(File::class, function (Faker $faker, $attributes) {
    //
    $url = "https://cdn.iconscout.com/icon/free/png-512/avatar-372-456324.png";
    $contents = file_get_contents($url);
    $name = substr($url, strrpos($url, '/') + 1);
    $upload_name = rand(0,9999).$name;
    $path = Storage::disk('public')->put($attributes["additional"].'/'.$upload_name, $contents);

    return [
        //
        'name' => $name,
        'upload_name' => $upload_name,
        'mime_type' => "image/png",
        'model_type' => "png",
        'is_public' => 1,
        'size' => "1000",
        'disk' => 'public',
        'path' => 'storage/'. $attributes["additional"].'/'.$upload_name
    ];
});
