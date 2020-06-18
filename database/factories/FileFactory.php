<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\File;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

$factory->define(File::class, function (Faker $faker, $attributes) {
    //fake upload file
    $file = UploadedFile::fake()->image('avatar.jpg');
    $fileName = $attributes["path"].rand().$file->getClientOriginalName();
    $file->storeAs($attributes["path"], $fileName);

    // miss understanding about what upload_name, name
    return [
        //
        'name' => $fileName,
        'upload_name' => $file->getFilename(),
        'mime_type' => $file->getMimeType(),
        'model_type' => $file->getExtension(),
        'is_public' => $faker->boolean(),
        'size' => $file->getSize(),
        'disk' => 'local',
    ];
});
