<?php

namespace App\Models;

use App\Traits\FreshTimestampTrait;
use App\Traits\PrimaryKeyTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as Author;

class User extends Auth
{
    use Notifiable;

    protected $guard = 'user';

    protected $fillable = [
        'login_id', 'email', 'password', 'first_name', 'last_name', 'gender', 'address', 'birthday', 'code', 'company_id', 'position',
        'start_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $model->created_by = Author::guard('admin')->user()->getId();
            $model->updated_by = Author::guard('admin')->user()->getId();

        });
    }

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

}
