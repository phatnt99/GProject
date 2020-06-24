<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as Author;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class User extends Auth
{
    use Notifiable, SoftDeletes;

    protected $guard = 'user';

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //Business logic
    public function createUserWithAvatar($request) {
        $newFile = null;

        if($request->hasFile('avatar')) {
            //store image
            $path = $request->file('avatar')->store('user', 'public');

            //get information and save to array
            $infoImage = [
                'name' => $request->file('avatar')->getClientOriginalName(),
                'upload_name' => $request->file('avatar')->hashName(),
                'mime_type' => $request->file('avatar')->getMimeType(),
                'size' => $request->file('avatar')->getSize(),
                'disk' => 'public',
                'path' => 'storage/'.$path
            ];

            //save in File model
            $newFile = File::create($infoImage);
        }

        $this->fill($request->all());
        $this->avatar = $newFile->id;

        $this->save();
    }

    public function updateUserWithAvatar($request) {
        //detect if user change avatar
        if($request->hasFile('avatar')) {
            //delete old avatar
            Storage::disk("public")->delete("user/".$this->file->upload_name);

            //create new file
            $path = $request->file('avatar')->store('user', 'public');
            //get information and save to array
            $infoImage = [
                'name' => $request->file('avatar')->getClientOriginalName(),
                'upload_name' => $request->file('avatar')->hashName(),
                'mime_type' => $request->file('avatar')->getMimeType(),
                'size' => $request->file('avatar')->getSize(),
                'disk' => 'public',
                'path' => 'storage/'.$path
            ];

            //save in File model
            $newFile = File::create($infoImage);

            //
            $this->fill($request->all());
            $this->avatar = $newFile->id;
            $this->save();
        }
        else
            $this->update($request->except('avatar'));
    }

    //Event
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_by = Author::guard('admin')->user()? Author::guard('admin')->user()->getId() : null;
            $model->updated_by = Author::guard('admin')->user()? Author::guard('admin')->user()->getId() : null;

        });
    }

    //Relationships
    public function file() {
        return $this->belongsTo(File::class, "avatar", "id");
    }

    public function company() {
        return $this->belongsTo(Company::class, "company_id", "id");
    }

    /*
     * For soft-delete, we cant use pivot, so treat UserDevice as actual Eloquent and using
     * one-to-many in User.
     */
    public function userDevices() {
        return $this->hasMany(UserDevice::class);
    }

    //Mutators
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setBirthdayAttribute($value) {
        if($value != null)
            $this->attributes['birthday'] =\Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        else
            $this->attributes['birthday'] = null;
    }

    public function setStartAtAttribute($value) {
        $this->attributes['start_at'] =\Carbon\Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }


    //Accessors
    public function getNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getBirthdayAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['birthday'])->format('d/m/Y');
    }

    public function getStartAtAttribute() {
        return Carbon::createFromFormat('Y-m-d', $this->attributes['start_at'])->format('d/m/Y');
    }

}
